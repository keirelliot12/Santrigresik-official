<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AffiliateProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'short_description',
        'full_description',
        'specifications',
        'price_min',
        'price_max',
        'images',
        'whatsapp_number',
        'whatsapp_message_template',
        'is_available',
        'sort_order',
        'views_count',
    ];

    protected $casts = [
        'specifications' => 'array',
        'images' => 'array',
        'is_available' => 'boolean',
        'views_count' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        if ($this->price_min && $this->price_max) {
            return "Rp " . number_format($this->price_min, 0, ',', '.') . " - Rp " . number_format($this->price_max, 0, ',', '.');
        } elseif ($this->price_min) {
            return "Rp " . number_format($this->price_min, 0, ',', '.') . "+";
        } else {
            return "Hubungi Kami";
        }
    }
}