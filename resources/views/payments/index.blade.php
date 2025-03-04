<!-- resources/views/payments/index.blade.php -->
<x-app-layout>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-4xl font-extrabold mb-8 text-gray-900 tracking-tight">Your Premium Payments</h1>

        @if (session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6">
            @forelse ($payments as $payment)
                <div class="card bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="card-body p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="card-title text-2xl font-semibold text-gray-800">Order #{{ $payment->order_id }}</h2>
                            <span class="badge badge-lg font-medium 
                                {{ $payment->status === 'pending' ? 'bg-amber-100 text-amber-800 border-amber-200' : 
                                   ($payment->status === 'completed' ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 
                                   'bg-rose-100 text-rose-800 border-rose-200') }} 
                                px-3 py-1 rounded-full border">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </div>
                        <div class="space-y-3 text-gray-700">
                            <p class="text-lg">
                                <span class="font-medium">Amount:</span> 
                                <span class="text-gray-900 font-bold">${{ number_format($payment->amount, 2) }}</span>
                            </p>
                            <p class="text-lg">
                                <span class="font-medium">Method:</span> 
                                <span class="text-gray-900">{{ ucfirst($payment->payment_method) }}</span>
                            </p>
                            <p class="text-lg">
                                <span class="font-medium">Transaction ID:</span> 
                                <span class="text-gray-900">{{ $payment->transaction_id }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 h-1"></div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-xl shadow-lg border border-gray-100">
                    <p class="text-gray-500 text-lg font-medium">No payments found.</p>
                    <p class="text-gray-400 mt-2">Your payment history will appear here once you make a transaction.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>