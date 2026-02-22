<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'payment_number',
        'quotation_id',
        'client_id',
        'amount',
        'fee',
        'net_amount',
        'status',
        'method',
        'provider_reference',
        'provider_response',
        'paid_at',
        'expired_at',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'net_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
        'provider_response' => 'array',
    ];

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public static function generatePaymentNumber(): string
    {
        $prefix = 'PYM';
        $date = now()->format('Ymd');
        $lastPayment = self::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();

        $sequence = $lastPayment ? 
            intval(substr($lastPayment->payment_number, -4)) + 1 : 1;

        return $prefix . $date . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function markAsPaid(array $providerResponse = null): void
    {
        $this->update([
            'status' => 'paid',
            'paid_at' => now(),
            'provider_response' => $providerResponse,
        ]);

        // Record analytics
        AnalyticsSummary::record('payment', $this->method, $this->amount, 1, [
            'quotation_id' => $this->quotation_id,
            'client_id' => $this->client_id,
        ]);
    }

    public function markAsFailed(string $reason = null): void
    {
        $this->update([
            'status' => 'failed',
            'notes' => $reason,
        ]);
    }
}