<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'category',
        'description',
        'content',
        'image',
        'thumbnail',
        'client',
        'client_name',
        'client_industry',
        'client_website',
        'url',
        'project_url',
        'year',
        'completion_date',
        'challenge',
        'solution',
        'results',
        'tags',
        'technologies',
        'color',
        'sort_order',
        'is_featured',
        'is_active',
        'views_count',
    ];

    protected $casts = [
        'tags' => 'array',
        'technologies' => 'array',
        'results' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'completion_date' => 'date',
        'views_count' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PortfolioCategory::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class)->orderBy('display_order');
    }
}
