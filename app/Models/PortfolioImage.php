<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioImage extends Model
{
    use HasFactory;

    protected $table = 'portfolio_images';

    protected $fillable = [
        'portfolio_id',
        'image_url',
        'caption',
        'display_order',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}