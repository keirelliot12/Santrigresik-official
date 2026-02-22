<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Quotation;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::with(['quotation.client', 'client'])
            ->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->method, function ($query, $method) {
                return $query->where('method', $method);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($payments);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'quotation_id' => 'required|exists:quotations,id',
            'method' => 'required|in:midtrans,ovo,gopay,bank_transfer,cash',
            'amount' => 'required|numeric|min:0',
        ]);

        $quotation = Quotation::findOrFail($validated['quotation_id']);
        
        $payment = Payment::create([
            'payment_number' => Payment::generatePaymentNumber(),
            'quotation_id' => $quotation->id,
            'client_id' => $quotation->client_id,
            'amount' => $validated['amount'],
            'fee' => 0,
            'net_amount' => $validated['amount'],
            'status' => 'pending',
            'method' => $validated['method'],
            'expired_at' => now()->addHours(24),
        ]);

        return response()->json([
            'message' => 'Payment created successfully',
            'data' => $payment,
            'payment_url' => route('payment.process', ['reference' => $payment->payment_number]),
        ], 201);
    }

    public function status($reference)
    {
        $payment = Payment::with(['quotation.client'])
            ->where('payment_number', $reference)
            ->firstOrFail();

        return response()->json([
            'data' => $payment,
            'is_expired' => $payment->expired_at && $payment->expired_at->isPast(),
        ]);
    }

    public function callback(Request $request, $reference)
    {
        $payment = Payment::where('payment_number', $reference)->firstOrFail();
        
        // Validate callback signature (implementation depends on payment provider)
        // This is a basic implementation
        
        $status = $request->input('status');
        $providerReference = $request->input('provider_reference');
        
        if ($status === 'success') {
            $payment->markAsPaid([
                'provider' => $request->input('provider'),
                'reference' => $providerReference,
                'raw_data' => $request->all(),
            ]);
        } elseif ($status === 'failed') {
            $payment->markAsFailed($request->input('failure_reason', 'Payment failed'));
        }

        return response()->json(['message' => 'Callback processed']);
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'sometimes|in:pending,paid,failed,refunded',
            'notes' => 'nullable|string',
        ]);

        $payment->update($validated);

        return response()->json([
            'message' => 'Payment updated successfully',
            'data' => $payment,
        ]);
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json([
            'message' => 'Payment deleted successfully',
        ]);
    }
}
