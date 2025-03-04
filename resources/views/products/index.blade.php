<x-app-layout>
    <div class="container mx-auto px-4 py-12 max-w-7xl">
        <h1 class="text-4xl font-extrabold mb-10 text-gray-900 tracking-tight">Our Products</h1>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="mb-8 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-lg shadow-md">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-8 bg-rose-50 border-l-4 border-rose-500 text-rose-700 p-4 rounded-r-lg shadow-md">
                {{ session('error') }}
            </div>
        @endif

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($products as $product)
                <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <!-- Product Image -->
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($product->description, 100) }}</p>
                        <p class="text-lg font-bold text-indigo-600 mt-2">${{ number_format($product->price, 2) }}</p>
                        <p class="text-sm text-gray-500 mt-1">Sold by: {{ $product->seller->username }}</p>
                        <p class="text-sm text-gray-500">Category: {{ $product->category->name }}</p>

                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('products.show', $product->product_id) }}" class="px-4 py-2 text-indigo-600 font-medium border border-indigo-200 hover:bg-indigo-50 rounded-lg transition duration-200">
                                View
                            </a>
                            <!-- Add to Cart Form -->
                            <form action="{{ route('cart.store') }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 mr-2">
                                <button type="submit" class="px-4 py-2 text-white font-medium bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-xl shadow-lg border border-gray-100">
                    <p class="text-gray-500 text-lg font-medium">No products available.</p>
                    <p class="text-gray-400 mt-2">Check back soon for new items!</p>
                </div>
            @endforelse
        </div>

        <!-- Create Product Button (for sellers) -->
        @auth
            @if (Auth::user()->role === 'seller')
                <div class="mt-8 text-right">
                    <a href="{{ route('products.create') }}" class="inline-block px-6 py-3 text-white font-semibold bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                        Add New Product
                    </a>
                </div>
            @endif
        @endauth
    </div>
</x-app-layout>