<?php
// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    // Show user's orders
    public function index()
    {
        $orders = Auth::user()->orders()->with('items.product')->get();
        return view('orders.index', compact('orders'));
    }

    // Show checkout form
    public function create()
    {
        // Get the user's cart
        $cart = Auth::user()->cart;

        // Check if the cart is empty
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }

        // Get shipping addresses for the user
        $addresses = Auth::user()->addresses()->where('type', 'shipping')->get();

        // Get the cart items
        $cartItems = $cart->cartItems;

        // Pass cartItems to the view
        return view('orders.create', compact('cart', 'addresses', 'cartItems'));
    }

    public function show($id)
    {
        // Find the order by ID or fail
        $order = Order::findOrFail($id);

        // Return the view with the order data
        return view('orders.show', compact('order'));
    }

    // Store a new order
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address_id' => 'required|exists:addresses,address_id',
        ]);
        
        $cart = Auth::user()->cart;
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }

        // Calculate total amount
        $total = $cart->cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Create the order
        $order = Order::create([
            'user_id' => Auth::user()->user_id, 
            'total_amount' => $total,
            'status' => 'pending',
            'shipping_address_id' => $request->shipping_address_id,
        ]);

        // Create order items and decrement stock
        foreach ($cart->cartItems as $item) {
            
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price_at_time' => $item->product->price,
            ]);
            
            $item->product->decrement('stock_quantity', $item->quantity);
        }

        // Clear the cart
        $cart->cartItems()->delete();

        // Redirect to payment
        return redirect()->route('payments.create', ['order_id' => $order->order_id])->with('success', 'Order placed, proceed to payment.');
    }

}
