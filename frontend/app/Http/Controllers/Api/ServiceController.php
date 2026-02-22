<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::with('category')
            ->where('is_active', true)
            ->when($request->category, function ($query, $category) {
                return $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category);
                });
            })
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12);

        return response()->json([
            'data' => $services,
            'categories' => ServiceCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->get(['id', 'name', 'slug', 'icon']),
        ]);
    }

    public function show($slug)
    {
        $service = Service::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Increment view count
        $service->increment('views_count');

        return response()->json([
            'data' => $service,
            'related_services' => Service::with('category')
                ->where('category_id', $service->category_id)
                ->where('id', '!=', $service->id)
                ->where('is_active', true)
                ->limit(4)
                ->get(),
        ]);
    }
}