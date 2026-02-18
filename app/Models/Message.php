<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'subject',
        'message',
        'service_interest',
        'source',
        'status',
        'assigned_to',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'contacted_at',
        'converted_at',
    ];

    protected $casts = [
        'contacted_at' => 'datetime',
        'converted_at' => 'datetime',
    ];

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(InquiryNote::class, 'message_id');
    }

    public function markAsContacted(): void
    {
        $this->update([
            'status' => 'contacted',
            'contacted_at' => now()
        ]);
    }

    public function markAsConverted(): void
    {
        $this->update([
            'status' => 'converted',
            'converted_at' => now()
        ]);
    }
}