<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Clear all routes
Route::any('{any}', function () {
    return view('welcome');
})->where('any', '.*');