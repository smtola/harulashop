<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['seller', 'category'])->take(8)->get(); 
        $categories = Category::all();
        return view('home', compact('products', 'categories'));
    }
}