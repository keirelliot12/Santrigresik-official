<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\Stat;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $featuredServices = Service::where('is_active', true)->where('is_featured', true)->get();
        
        $portfolios = Portfolio::where('is_active', true)->orderBy('sort_order')->get();
        
        $products = Product::where('is_available', true)->orderBy('sort_order')->get();
        
        $stats = Stat::all();
        
        return view('welcome', compact('services', 'portfolios', 'products', 'stats'));
    }
}
