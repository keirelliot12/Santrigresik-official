<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnalyticsController;
use App\Http\Controllers\Api\ChatbotController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\QuotationController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth Routes
Route::prefix('v1')->group(function () {
    Route::post('/auth/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('/auth/request-otp', [\App\Http\Controllers\Api\AuthController::class, 'requestOtp']);
    Route::post('/auth/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/auth/user', [\App\Http\Controllers\Api\AuthController::class, 'user'])->middleware('auth:sanctum');
});

// Public API Routes
Route::prefix('v1')->group(function () {
    
    // Analytics
    Route::get('/analytics/dashboard', [AnalyticsController::class, 'dashboard']);
    Route::get('/analytics/leads', [AnalyticsController::class, 'leadsAnalytics']);
    Route::get('/analytics/revenue', [AnalyticsController::class, 'revenueAnalytics']);
    
    // Leads
    Route::post('/leads', [LeadController::class, 'store']);
    Route::get('/leads/{id}', [LeadController::class, 'show']);
    
    // Quotations
    Route::post('/quotations', [QuotationController::class, 'store']);
    Route::get('/quotations/{token}', [QuotationController::class, 'show']);
    Route::post('/quotations/{token}/accept', [QuotationController::class, 'accept']);
    
    // Payments
    Route::post('/payments', [PaymentController::class, 'create']);
    Route::get('/payments/{reference}', [PaymentController::class, 'status']);
    Route::post('/payments/{reference}/callback', [PaymentController::class, 'callback']);
    
    // Services
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/{slug}', [ServiceController::class, 'show']);
    
    // Portfolio
    Route::get('/portfolio', [PortfolioController::class, 'index']);
    Route::get('/portfolio/{slug}', [PortfolioController::class, 'show']);
    
    // Blog
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/{slug}', [BlogController::class, 'show']);
    
    // Affiliate Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{slug}', [ProductController::class, 'show']);
    Route::post('/products/{slug}/inquiry', [ProductController::class, 'inquiry']);

    // Chatbot
    Route::post('/chatbot', [ChatbotController::class, 'chat']);
});

// Protected API Routes
Route::prefix('v1/admin')->middleware('auth:sanctum')->group(function () {
    
    // Admin Analytics
    Route::get('/analytics/detailed', [AnalyticsController::class, 'detailed']);
    Route::get('/analytics/export', [AnalyticsController::class, 'export']);
    
    // Admin Leads
    Route::get('/leads', [LeadController::class, 'index']);
    Route::put('/leads/{id}', [LeadController::class, 'update']);
    Route::delete('/leads/{id}', [LeadController::class, 'destroy']);
    
    // Admin Quotations
    Route::get('/quotations', [QuotationController::class, 'index']);
    Route::put('/quotations/{id}', [QuotationController::class, 'update']);
    Route::delete('/quotations/{id}', [QuotationController::class, 'destroy']);
    
    // Admin Payments
    Route::get('/payments', [PaymentController::class, 'index']);
    Route::put('/payments/{id}', [PaymentController::class, 'update']);
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);
});