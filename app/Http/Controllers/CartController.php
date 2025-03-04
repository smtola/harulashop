<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $cart = Auth::user()->cart ?? Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cartItems = $cart->cartItems()->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        if ($product->stock_quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock.');
        }

        $cart = Auth::user()->cart ?? Cart::firstOrCreate(['user_id' => Auth::id()]);
        
        $cartItem = $cart->cartItems()->where('product_id', $request->product_id)->first();
        
        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($product->stock_quantity < $newQuantity) {
                return redirect()->back()->with('error', 'Insufficient stock.');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            $cart->cartItems()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        
        $cartItem = CartItem::findOrFail($id);
        if ($cartItem->cart->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized.');
        }
        
        if ($cartItem->product->stock_quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock.');
        }
        
        $cartItem->update(['quantity' => $request->quantity]);
        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);
        if ($cartItem->cart->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized.');
        }
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}