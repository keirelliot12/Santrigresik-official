<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AffiliateProduct;
use App\Models\ProductCategory;
use App\Models\Message;
use App\Models\AnalyticsSummary;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = AffiliateProduct::with('category')
            ->where('is_available', true)
            ->when($request->category, function ($query, $category) {
                return $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category);
                });
            })
            ->when($request->search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('short_description', 'like', "%{$search}%");
                });
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12);

        return response()->json([
            'data' => $products,
            'categories' => ProductCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->get(['id', 'name', 'slug', 'icon']),
        ]);
    }

    public function show($slug)
    {
        $product = AffiliateProduct::with('category')
            ->where('slug', $slug)
            ->where('is_available', true)
            ->firstOrFail();

        // Increment view count
        $product->increment('views_count');

        return response()->json([
            'data' => $product,
            'related_products' => AffiliateProduct::with('category')
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->where('is_available', true)
                ->limit(4)
                ->get(),
        ]);
    }

    public function inquiry(Request $request, $slug)
    {
        $product = AffiliateProduct::where('slug', $slug)
            ->where('is_available', true)
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        // Create message for product inquiry
        $message = Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company' => $request->company,
            'subject' => "Inquiry: {$product->name}",
            'message' => $validated['message'],
            'service_interest' => 'Product Inquiry',
            'source' => 'product_page',
            'status' => 'new',
        ]);

        // Record analytics
        AnalyticsSummary::record('product_inquiry', $product->category->slug, 0, 1, [
            'product_id' => $product->id,
            'product_name' => $product->name,
        ]);

        return response()->json([
            'message' => 'Inquiry sent successfully',
            'data' => $message,
            'whatsapp_link' => "https://wa.me/{$product->whatsapp_number}?text=" . urlencode($product->whatsapp_message_template),
        ]);
    }
}
