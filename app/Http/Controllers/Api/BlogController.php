<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = BlogPost::with(['category', 'author'])
            ->published()
            ->when($request->category, function ($query, $category) {
                return $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category);
                });
            })
            ->when($request->search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return response()->json([
            'data' => $posts,
            'categories' => BlogCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->get(['id', 'name', 'slug']),
        ]);
    }

    public function show($slug)
    {
        $post = BlogPost::with(['category', 'author'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment view count
        $post->increment('views_count');

        return response()->json([
            'data' => $post,
            'related_posts' => BlogPost::with(['category', 'author'])
                ->published()
                ->where('category_id', $post->category_id)
                ->where('id', '!=', $post->id)
                ->limit(4)
                ->get(),
        ]);
    }
}
