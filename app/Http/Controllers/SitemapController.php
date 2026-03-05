<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        // Get active products
        $products = Product::active()->get();

        // Static pages
        $staticUrls = [
            route('home'),
            route('catalog.index'),
            route('cart.index'),
            route('checkout.index'),
            route('refund.policy'),
            route('refund.create'),
            route('tracking.index'),
        ];

        return response()
            ->view('sitemap', [
                'products' => $products,
                'staticUrls' => $staticUrls,
                'xmlHeader' => '<?xml version="1.0" encoding="UTF-8"?>',
            ])
            ->header('Content-Type', 'text/xml');
    }
}
