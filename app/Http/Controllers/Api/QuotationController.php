<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index(Request $request)
    {
        $quotations = Quotation::with(['client', 'items', 'creator'])
            ->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->client_id, function ($query, $clientId) {
                return $query->where('client_id', $clientId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($quotations);
    }

    public function show($token)
    {
        $quotation = Quotation::with(['client', 'items'])
            ->where('access_token', $token)
            ->firstOrFail();

        // Record view
        if (!$quotation->viewed_at) {
            $quotation->update(['viewed_at' => now()]);
        }

        return response()->json([
            'data' => $quotation,
            'is_expired' => $quotation->valid_until->isPast(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'valid_until' => 'required|date|after:today',
            'items' => 'required|array|min:1',
            'items.*.service_name' => 'required|string|max:255',
            'items.*.description' => 'nullable|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.total' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $quotation = Quotation::create([
            'quote_number' => Quotation::generateQuoteNumber(),
            'client_id' => $validated['client_id'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'valid_until' => $validated['valid_until'],
            'discount' => $validated['discount'] ?? 0,
            'tax' => $validated['tax'] ?? 0,
            'notes' => $validated['notes'] ?? null,
            'access_token' => bin2hex(random_bytes(32)),
            'created_by' => auth()->id() ?? 1,
            'status' => 'draft',
        ]);

        foreach ($validated['items'] as $item) {
            $quotation->items()->create($item);
        }

        // Calculate totals
        $subtotal = collect($validated['items'])->sum('total');
        $total = $subtotal - ($validated['discount'] ?? 0) + ($validated['tax'] ?? 0);
        
        $quotation->update([
            'subtotal' => $subtotal,
            'total' => $total,
        ]);

        return response()->json([
            'message' => 'Quotation created successfully',
            'data' => $quotation->load(['client', 'items']),
            'public_url' => url("/quotation/{$quotation->access_token}"),
        ], 201);
    }

    public function accept(Request $request, $token)
    {
        $quotation = Quotation::where('access_token', $token)->firstOrFail();

        if ($quotation->valid_until->isPast()) {
            return response()->json([
                'message' => 'Quotation has expired'
            ], 422);
        }

        if ($quotation->status !== 'sent') {
            return response()->json([
                'message' => 'Quotation cannot be accepted'
            ], 422);
        }

        $quotation->update([
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        return response()->json([
            'message' => 'Quotation accepted successfully',
            'data' => $quotation,
        ]);
    }

    public function update(Request $request, $id)
    {
        $quotation = Quotation::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'sometimes|in:draft,sent,viewed,accepted,rejected,expired',
            'notes' => 'nullable|string',
        ]);

        $quotation->update($validated);

        return response()->json([
            'message' => 'Quotation updated successfully',
            'data' => $quotation,
        ]);
    }

    public function destroy($id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotation->delete();

        return response()->json([
            'message' => 'Quotation deleted successfully',
        ]);
    }
}
