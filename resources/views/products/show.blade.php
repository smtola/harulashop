<x-app-layout>
    <div class="container mx-auto px-4 py-12 max-w-4xl">
        <h1 class="text-4xl font-extrabold mb-10 text-gray-900 tracking-tight">{{ $product->name }}</h1>

        <!-- Product Card -->
        <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-100">
            <!-- Product Image -->
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-80 object-cover">

            <div class="p-8">
                <p class="text-gray-600 leading-relaxed mb-4">{{ $product->description }}</p>
                <p class="text-2xl font-bold text-indigo-600 mb-2">${{ number_format($product->price, 2) }}</p>
                <p class="text-gray-700 mb-1">Stock: <span class="font-medium">{{ $product->stock_quantity }}</span></p>
                <p class="text-gray-700 mb-1">Sold by: <span class="font-medium">{{ $product->seller->username }}</span></p>
                <p class="text-gray-700 mb-6">Category: <span class="font-medium">{{ $product->category->name }}</span></p>

                <!-- Add to Cart Form -->
                @if ($product->stock_quantity > 0)
                    <form action="{{ route('cart.store') }}" method="POST" class="flex items-center mb-8">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" class="w-20 p-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 mr-4">
                        <button type="submit" class="px-6 py-3 text-white font-semibold bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <p class="text-rose-600 font-medium mb-8">Out of Stock</p>
                @endif

                <!-- Reviews Section -->
                <div class="border-t border-gray-100 pt-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Reviews</h2>
                    @forelse ($product->reviews as $review)
                        <div class="border-b border-gray-100 py-4 last:border-b-0">
                            <p class="font-medium text-gray-700 mb-1">Rating: 
                                <span class="text-amber-500">{{ str_repeat('★', $review->rating) }}</span>
                                <span class="text-gray-300">{{ str_repeat('☆', 5 - $review->rating) }}</span>
                            </p>
                            <p class="text-gray-600">{{ $review->comment ?? 'No comment' }}</p>
                            <p class="text-sm text-gray-500 mt-1">By: {{ $review->user->username }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 italic">No reviews yet. Be the first to share your thoughts!</p>
                    @endforelse

                    <!-- Add Review Button -->
                    <a href="{{ route('reviews.create', $product->product_id) }}" class="inline-block mt-6 px-6 py-3 text-white font-semibold bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                        Add Review
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>