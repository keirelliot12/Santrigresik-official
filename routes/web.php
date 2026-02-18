<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

// Health check for Docker/Coolify
Route::get('/up', function () {
    return response()->json(['status' => 'ok', 'service' => 'santrigresik']);
});

Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now()->toIso8601String(),
        'version' => config('app.version', '1.0.0')
    ]);
});

Route::get('/', [HomeController::class, 'index'])->name('home');

// Detail pages
Route::get('/portfolio/{slug}', [PageController::class, 'portfolioDetail'])->name('portfolio.detail');
Route::get('/produk/{slug}', [PageController::class, 'productDetail'])->name('product.detail');
Route::get('/antidietclub', function () {
    return redirect('/antidietclub/');
});
