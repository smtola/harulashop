<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProductController extends Controller
{
    // Display all products
    public function index(Request $request)
    {
        $categories = Category::withCount('products')->get();
        $products = Product::when($request->category, fn($query, $category) => $query->where('category_id', $category))->get();
        return view('products.index', compact('products', 'categories'));
    }

    // Show a single product
    public function show($product_id)
    {
        $product = Product::with('category', 'seller', 'reviews.user')->findOrFail($product_id);
        return view('products.show', compact('product'));

    }

    // Show form to create a product (seller only)
    public function create()
    {
        if (!Auth::user() || Auth::user()->role !== 'seller') {
            return redirect()->route('products.index')->with('error', 'Only sellers can create products.');
        }
        return view('products.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,category_id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock_quantity' => $request->stock,
            'category_id' => $request->category_id,
            'seller_id' => auth()->id(), // Assuming authenticated user is the seller
            'image_path' => $imagePath
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

}