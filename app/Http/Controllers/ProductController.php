<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the public catalog page.
     */
    public function index()
    {
        $categories = Category::all();
        // Eager load category and images to avoid N+1 query problems
        $products = Product::with(['category', 'images'])->latest()->get();
        $setting = Setting::getSolo();

        return view('welcome', compact('categories', 'products', 'setting'));
    }
}
