<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)->take(6)->get();
        return view('home', compact('featuredProducts'));
    }
}
