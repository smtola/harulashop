<x-app-layout>
    <div class="container mx-auto px-4 py-12 max-w-2xl">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-3 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Review {{ $product->name }}
            </h1>
            <p class="text-lg text-gray-600">Share your experience with this product</p>
        </div>

        <!-- Review Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-100 hover:shadow-3xl transition-shadow duration-300">
            <form action="{{ route('reviews.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                <!-- Rating Input -->
                <div class="space-y-2">
                    <label class="block text-lg font-medium text-gray-700 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        Product Rating
                    </label>
                    <div class="rating-stars flex space-x-2" id="ratingContainer">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden" required>
                            <label for="star{{ $i }}" class="star-label cursor-pointer text-gray-300 transition-all duration-200 hover:text-amber-400">
                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </label>
                        @endfor
                    </div>
                </div>

                <!-- Comment Input -->
                <div class="space-y-2">
                    <label class="block text-lg font-medium text-gray-700 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                        Your Review
                    </label>
                    <textarea name="comment" rows="5" 
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 placeholder-gray-400 text-gray-700"
                        placeholder="Share detailed thoughts about the product..."></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                    class="w-full py-4 px-6 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold text-lg rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                    Submit Review
                </button>
            </form>
        </div>
    </div>

    <script>
        // Star rating interaction
        document.querySelectorAll('.star-label').forEach(label => {
            label.addEventListener('click', (e) => {
                const rating = e.target.closest('label').getAttribute('for').replace('star', '');
                document.querySelectorAll('.star-label').forEach((star, index) => {
                    star.classList.remove('text-amber-400');
                    if (5 - index <= rating) {
                        star.classList.add('text-amber-400');
                    }
                });
            });
        });
    </script>
</x-app-layout>