<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Detail pages
Route::get('/portfolio/{slug}', [PageController::class, 'portfolioDetail'])->name('portfolio.detail');
Route::get('/produk/{slug}', [PageController::class, 'productDetail'])->name('product.detail');
Route::get('/antidietclub', function () {
    return redirect('/antidietclub/');
});
