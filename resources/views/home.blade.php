@extends('layouts.guest')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-white py-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="w-full md:w-1/2 text-center md:text-left">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Season Sale</h1>
                    <h2 class="text-5xl font-extrabold text-gray-900 mb-6">MEN'S FASHION</h2>
                    <p class="text-xl text-gray-600 mb-8">Min. 35-70% Off</p>
                    <div class="space-x-4">
                        <a href="{{ route('products.index') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">Shop Now</a>
                        <a href="#" class="inline-block px-6 py-3 bg-white text-blue-600 font-semibold border border-blue-600 rounded-lg hover:bg-gray-100 transition duration-300">Read More</a>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <img src="https://i.pinimg.com/736x/bb/ee/39/bbee39d312991862296dada850e2bf6d.jpg" alt="Men's Fashion" class="w-full h-auto rounded-lg shadow-md">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-around items-center gap-6">
            <div class="text-center">
                <i class="fas fa-shipping-fast text-3xl text-blue-600 mb-2"></i>
                <p class="text-gray-700">Free Shipping</p>
                <p class="text-sm text-gray-500">On Orders Over $50</p>
            </div>
            <div class="text-center">
                <i class="fas fa-lock text-3xl text-blue-600 mb-2"></i>
                <p class="text-gray-700">Secure Payment</p>
                <p class="text-sm text-gray-500">We Ensure Secure Payment</p>
            </div>
            <div class="text-center">
                <i class="fas fa-undo text-3xl text-blue-600 mb-2"></i>
                <p class="text-gray-700">100% Money Back</p>
                <p class="text-sm text-gray-500">30 Days Return Policy</p>
            </div>
            <div class="text-center">
                <i class="fas fa-headset text-3xl text-blue-600 mb-2"></i>
                <p class="text-gray-700">Online Support</p>
                <p class="text-sm text-gray-500">24/7 Dedicated Support</p>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">Featured Categories</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach ($categories as $category)
                    <div class="bg-gray-200 p-6 rounded-lg text-center hover:shadow-md transition duration-300">
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-40 object-cover rounded-lg mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h3>
                        <p class="text-gray-600">Up to 70% Off</p>
                        <a href="{{ route('products.index', ['category' => 'womens']) }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Shop Now</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">Featured Products</h2>
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
        </div>
    </section>

    <!-- Promotions -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-8">
            <div class="w-full md:w-1/2 text-center md:text-left">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Weekend Sale</h3>
                <p class="text-xl text-gray-600 mb-6">Men's Fashion</p>
                <p class="text-3xl font-extrabold text-gray-900">Flat 70% Off</p>
                <a href="{{ route('products.index', ['category' => 'mens']) }}" class="mt-4 inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">Shop Now</a>
            </div>
            <div class="w-full md:w-1/2">
                <img src="https://via.placeholder.com/400x300?text=Men%27s+Fashion" alt="Men's Fashion Sale" class="w-full h-auto rounded-lg shadow-md">
            </div>
            <div class="w-full md:w-1/2">
                <img src="https://via.placeholder.com/400x300?text=Women%27s+Wear" alt="Women's Fashion" class="w-full h-auto rounded-lg shadow-md">
            </div>
            <div class="w-full md:w-1/2 text-center md:text-left">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Fashion Style</h3>
                <p class="text-xl text-gray-600 mb-6">Women's Wear</p>
                <p class="text-3xl font-extrabold text-gray-900">Min. 35-70% Off</p>
                <a href="{{ route('products.index', ['category' => 'womens']) }}" class="mt-4 inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">Shop Now</a>
            </div>
        </div>
    </section>
@endsection