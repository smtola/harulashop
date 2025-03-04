<?php
// app/Http/Controllers/ReviewController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index($product_id)
    {
        $product = Product::findOrFail($product_id);
        $reviews = $product->reviews()->with('user')->get();
        $averageRating = $product->average_rating;

        return view('reviews.index', compact('product', 'reviews'));
    }

    public function create($product_id)
    {
        $product = Product::findOrFail($product_id);
        $averageRating = $product->average_rating;
        
        return view('reviews.create', compact('product'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create([
            'user_id' => Auth::user()->user_id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('reviews.index', $request->product_id)->with('success', 'Review submitted.');
    }
}