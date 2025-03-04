<?php
// app/Http/Controllers/OrderController.php (Updated)
namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Auth::user()->orders()->with('orderItems.product')->get();
        return view('orders.index', compact('orders'));
    }

    public function show($order_id)
    {
        $order = Order::with('orderItems.product')->findOrFail($order_id);
        if ($order->user_id !== Auth::user()->user_id) {
            return redirect()->route('orders.index')->with('error', 'Unauthorized.');
        }
        return view('orders.show', compact('order'));
    }

    public function create()
    {
        $cart = Auth::user()->cart;
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }
        $addresses = Auth::user()->addresses()->where('type', 'shipping')->get();
        return view('orders.create', compact('cart', 'addresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address_id' => 'required|exists:addresses,address_id',
        ]);

        $cart = Auth::user()->cart;
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }

        $total = $cart->cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $order = Order::create([
            'user_id' => Auth::user()->user_id,
            'total_amount' => $total,
            'status' => 'pending',
            'shipping_address_id' => $request->shipping_address_id,
        ]);

        foreach ($cart->cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price_at_time' => $item->product->price,
            ]);
            $item->product->decrement('stock_quantity', $item->quantity);
        }

        $cart->cartItems()->delete();
        return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
    }
}