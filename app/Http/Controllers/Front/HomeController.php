<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // return $categories =Category::where('parent_id', 1)->select('name')->get();
        $categories = Category::where('parent_id', null)->get();
        $products = Product::with('category')->active()->latest()->take(8)->get();
        return view('front.home', compact('products', 'categories'));
    }
}
