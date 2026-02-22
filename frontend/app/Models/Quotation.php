<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'quote_number',
        'client_id',
        'message_id',
        'title',
        'description',
        'valid_until',
        'subtotal',
        'discount',
        'tax',
        'total',
        'status',
        'notes',
        'access_token',
        'sent_at',
        'viewed_at',
        'accepted_at',
        'created_by',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'valid_until' => 'date',
        'sent_at' => 'datetime',
        'viewed_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function payment(): BelongsTo
    {
        return $this->hasOne(Payment::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function generateQuoteNumber(): string
    {
        $prefix = 'QT';
        $date = now()->format('Ymd');
        $lastQuote = self::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();

        $sequence = $lastQuote ? 
            intval(substr($lastQuote->quote_number, -4)) + 1 : 1;

        return $prefix . $date . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function generateAccessToken(): string
    {
        return bin2hex(random_bytes(32));
    }
}