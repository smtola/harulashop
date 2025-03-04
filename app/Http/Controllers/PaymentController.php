<?php
// app/Http/Controllers/PaymentController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::whereHas('order', fn($q) => $q->where('user_id', Auth::user()->user_id))->get();
        return view('payments.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'payment_method' => 'required|in:credit_card,paypal,cod',
        ]);

        $order = Order::findOrFail($request->order_id);
        if ($order->user_id !== Auth::user()->user_id) {
            return redirect()->back()->with('error', 'Unauthorized.');
        }

        $payment = Payment::create([
            'order_id' => $order->order_id,
            'amount' => $order->total_amount,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'transaction_id' => Str::uuid(), // Simulated transaction ID
        ]);

        // Simulate payment success for 'cod'
        if ($request->payment_method === 'cod') {
            $payment->update(['status' => 'completed']);
            $order->update(['status' => 'shipped']);
        }

        return redirect()->route('payments.index')->with('success', 'Payment processed.');
    }
}