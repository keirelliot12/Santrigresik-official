<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function welcome()
    {
        $services = DB::table('services')->get()->map(function($service) {
            $service->features = json_decode($service->features);
            return $service;
        });
        
        $portfolios = DB::table('portfolios')->get()->map(function($portfolio) {
            $portfolio->technologies = json_decode($portfolio->technologies);
            return $portfolio;
        });
        
        $products = DB::table('products')->get()->map(function($product) {
            $product->features = json_decode($product->features);
            return $product;
        });

        return view('welcome', compact('services', 'portfolios', 'products'));
    }

    public function portfolioDetail($slug)
    {
        $portfolio = DB::table('portfolios')->where('slug', $slug)->first();
        
        if (!$portfolio) {
            abort(404);
        }
        
        $portfolio->technologies = json_decode($portfolio->technologies);

        return view('portfolio-detail', compact('portfolio'));
    }

    public function productDetail($slug)
    {
        $product = DB::table('products')->where('slug', $slug)->first();
        
        if (!$product) {
            abort(404);
        }
        
        $product->features = json_decode($product->features);

        return view('product-detail', compact('product'));
    }
}
