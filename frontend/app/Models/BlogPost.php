<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image_url',
        'category_id',
        'author_id',
        'status',
        'published_at',
        'views_count',
        'reading_time',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'reading_time' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->content));
        return max(1, ceil($words / 200)); // 200 words per minute
    }
}