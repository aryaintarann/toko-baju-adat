<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->with('category')
            ->take(6)
            ->get();

        $categories = Category::withCount([
            'products' => function ($query) {
                $query->where('is_active', true);
            }
        ])->get();

        $latestProducts = Product::where('is_active', true)
            ->with('category')
            ->latest()
            ->take(4)
            ->get();

        return view('home', compact('featuredProducts', 'categories', 'latestProducts'));
    }
}
