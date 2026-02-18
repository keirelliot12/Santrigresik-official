<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $portfolios = Portfolio::with(['category', 'images'])
            ->when($request->category, function ($query, $category) {
                return $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category);
                });
            })
            ->when($request->search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return response()->json([
            'data' => $portfolios,
            'categories' => PortfolioCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->get(['id', 'name', 'slug']),
        ]);
    }

    public function show($slug)
    {
        $portfolio = Portfolio::with(['category', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment view count
        $portfolio->increment('views_count');

        return response()->json([
            'data' => $portfolio,
            'related_portfolios' => Portfolio::with(['category'])
                ->where('category_id', $portfolio->category_id)
                ->where('id', '!=', $portfolio->id)
                ->limit(4)
                ->get(),
        ]);
    }
}
