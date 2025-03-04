<x-app-layout>
    <div class="container mx-auto px-4 py-12 max-w-3xl">
        <h1 class="text-4xl font-extrabold mb-10 text-gray-900 tracking-tight text-center">Address Details</h1>

        <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-100">
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Shipping Address</h2>
                <p class="text-gray-700 leading-relaxed">{{ $address->street }}, {{ $address->city }}, {{ $address->state }}, {{ $address->zip }}</p>
            </div>

            <div class="pt-6 border-t border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Billing Address</h2>
                <p class="text-gray-700 leading-relaxed">{{ $address->street }}, {{ $address->city }}, {{ $address->state }}, {{ $address->zip }}</p>
            </div>
        </div>
    </div>
</x-app-layout>