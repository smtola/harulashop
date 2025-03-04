<x-app-layout>
    <div class="container mx-auto px-6 py-12 bg-gray-800 text-white">
        <h1 class="text-4xl font-extrabold mb-8 text-white">Checkout</h1>

        <!-- Cart Items List -->
        @foreach ($cartItems as $item)
            <div class="bg-gray-900 p-6 mb-6 shadow-lg rounded-lg flex items-center">
                @if ($item->product->image_path)
                    <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded-md mr-6">
                @endif
                <div class="flex-grow">
                    <h2 class="text-xl font-semibold text-white">{{ $item->product->name }}</h2>
                    <p class="text-gray-400 text-lg">${{ number_format($item->product->price, 2) }} x {{ $item->quantity }}</p>
                </div>
            </div>
        @endforeach

        <!-- Total Amount -->
        <div class="flex justify-between items-center mt-6">
            <p class="text-3xl font-bold text-white">Total: ${{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</p>
            <span class="text-xl text-gray-400">Incl. taxes & shipping</span>
        </div>

        <!-- Checkout Form -->
        <form action="{{ route('orders.store') }}" method="POST" class="bg-gray-900 shadow-xl p-8 rounded-lg mt-8 border-t-4 border-green-600">
            @csrf

            <!-- Shipping Address Selection -->
            <div class="mb-8">
                <label for="shipping_address_id" class="block text-lg font-semibold text-white">Select Shipping Address</label>
                <select name="shipping_address_id" id="shipping_address_id" class="w-full p-4 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 text-white">
                    @foreach ($addresses as $address)
                        <option value="{{ $address->address_id }}" {{ old('shipping_address_id') == $address->address_id ? 'selected' : '' }}>
                            {{ $address->street }}, {{ $address->city }}, {{ $address->state }}, {{ $address->zip }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Payment Method -->
            <div class="mb-8">
                <label for="payment_method" class="block text-lg font-semibold text-white">Select Payment Method</label>
                <select name="payment_method" id="payment_method" class="w-full p-4 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 text-white">
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            <!-- Place Order Button -->
            <button type="submit" class="w-full bg-green-600 text-white py-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200 text-lg font-semibold">
                Place Order
            </button>
        </form>
    </div>
</x-app-layout>
