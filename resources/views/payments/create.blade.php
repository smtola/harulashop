<x-app-layout>
    <div class="max-w-2xl mx-auto px-6 py-12">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-10 text-center tracking-tight">
            Payment for Order #{{ $order_id }}
        </h1>

        <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-100">
            <form action="{{ route('payments.store') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order_id }}">
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-3">Payment Method</label>
                    <select name="payment_method" class="w-full border border-gray-200 rounded-lg px-5 py-3 bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" required>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="cod">Cash on Delivery</option>
                    </select>
                </div>
                
                <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3.5 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 transition-all duration-300 shadow-md">
                    Process Payment
                </button>
            </form>
        </div>
    </div>
</x-app-layout>