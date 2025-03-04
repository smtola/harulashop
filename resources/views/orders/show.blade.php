<x-app-layout>
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Order #{{ $order->id }} Details</h1>

        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Shipping Address</h2>
                <p class="text-gray-700">{{ $order->address->street }}, {{ $order->address->city }}, {{ $order->address->state }}, {{ $order->address->zip }}</p>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Payment Method</h2>
                <p class="text-gray-700">{{ $order->payment_method }}</p>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Status</h2>
                <span class="px-3 py-1 text-sm rounded-full bg-{{ $order->status === 'pending' ? 'yellow' : 'green' }}-100 text-{{ $order->status === 'pending' ? 'yellow' : 'green' }}-800">{{ ucfirst($order->status) }}</span>
            </div>

            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Order Items</h3>
                <ul class="space-y-4">
                    @foreach ($order->items as $item)
                        <li class="flex justify-between text-gray-600">
                            <span>{{ $item->product->name }} - {{ $item->quantity }} x ${{ number_format($item->price, 2) }}</span>
                            <span class="font-semibold">${{ number_format($item->price * $item->quantity, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-8 text-lg font-semibold">
                <p class="text-gray-900">Total: ${{ number_format($order->total, 2) }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
