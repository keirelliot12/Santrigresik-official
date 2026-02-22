<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $leads = Message::with('assignedUser')
            ->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->source, function ($query, $source) {
                return $query->where('source', $source);
            })
            ->when($request->search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('company', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($leads);
    }

    public function show($id)
    {
        $lead = Message::with(['notes.user', 'assignedUser'])->findOrFail($id);
        return response()->json($lead);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'company' => 'nullable|string|max:255',
            'service_interest' => 'nullable|string|max:255',
            'source' => 'nullable|in:web,whatsapp,direct,referral',
            'utm_source' => 'nullable|string|max:255',
            'utm_medium' => 'nullable|string|max:255',
            'utm_campaign' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $lead = Message::create(array_merge(
            $request->validated(),
            ['status' => 'new']
        ));

        // Record analytics
        \App\Models\AnalyticsSummary::record('leads', $request->source ?? 'web', 0, 1);

        return response()->json([
            'message' => 'Lead created successfully',
            'data' => $lead
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $lead = Message::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'status' => 'sometimes|in:new,contacted,qualified,converted,lost',
            'assigned_to' => 'sometimes|exists:users,id',
            'notes' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $lead->update($request->validated());

        return response()->json([
            'message' => 'Lead updated successfully',
            'data' => $lead
        ]);
    }

    public function destroy($id)
    {
        $lead = Message::findOrFail($id);
        $lead->delete();

        return response()->json([
            'message' => 'Lead deleted successfully'
        ]);
    }
}