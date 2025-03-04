<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Orders</h1>

        @if (session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        @forelse ($orders as $order)
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 shadow-2xl mb-6 rounded-lg p-6">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-3">Order #{{ $order->order_id }}</h2>
                    <p class="text-white">Status: <span class="inline-block py-1 px-2 rounded-full bg-{{ $order->status === 'pending' ? 'yellow-500' : 'green-500' }} text-white">{{ $order->status }}</span></p>
                    <p class="text-white mb-4">Total: ${{ number_format($order->total_amount, 2) }}</p>
                    <ul class="list-disc pl-5 text-white">
                        @foreach ($order->orderItems as $item)
                            <li>{{ $item->product->name }} - {{ $item->quantity }} x ${{ number_format($item->price_at_time, 2) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @empty
            <p class="text-gray-500">You have no orders yet.</p>
        @endforelse
    </div>
</x-app-layout>
