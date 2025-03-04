<x-app-layout>
    <div class="container mx-auto px-6 py-12 max-w-6xl">
        <h1 class="text-4xl font-extrabold mb-10 text-gray-900 tracking-tight">Your Addresses</h1>

        @if (session('success'))
            <div class="mb-8 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-lg shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('addresses.create') }}" class="inline-block mb-8 px-6 py-3 text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300">
            Add New Address
        </a>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($addresses as $address)
                <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">{{ ucfirst($address->type) }} Address</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $address->street }}, {{ $address->city }}, {{ $address->state }}, {{ $address->country }} {{ $address->postal_code }}</p>
                    <div class="mt-5 flex justify-end">
                        <a href="{{ route('addresses.edit', $address->address_id) }}" class="inline-block px-5 py-2 text-white bg-amber-500 hover:bg-amber-600 rounded-lg font-medium shadow-sm hover:shadow-md transition-all duration-200">
                            Edit
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-xl shadow-lg border border-gray-100">
                    <p class="text-gray-500 text-lg font-medium">No addresses found.</p>
                    <p class="text-gray-400 mt-2">Add a new address to get started.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>