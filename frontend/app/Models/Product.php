<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'content',
        'image',
        'gallery',
        'price',
        'price_note',
        'is_available',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
    ];
}
