<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'content',
        'image',
        'thumbnail',
        'client',
        'url',
        'year',
        'tags',
        'technologies',
        'sort_order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'tags' => 'array',
        'technologies' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];
}
