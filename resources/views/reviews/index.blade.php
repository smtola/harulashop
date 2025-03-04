<x-app-layout>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                Customer Reviews: {{ $product->name }}
            </h1>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('reviews.create', $product->product_id) }}" 
                   class="btn transform transition-all hover:scale-105 bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-3 rounded-full shadow-lg hover:shadow-xl flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Write a Review
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-8 rounded-lg shadow-sm" role="alert">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Reviews Grid -->
        <div class="space-y-6">
            @forelse ($reviews as $review)
                <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <!-- Rating Stars -->
                    <div class="flex items-center mb-4">
                        <div class="flex space-x-1">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-6 h-6 {{ $i < $review->rating ? 'text-amber-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-500">{{ $review->rating }}/5</span>
                    </div>

                    <!-- Review Content -->
                    <p class="text-gray-700 leading-relaxed mb-4 text-lg">
                        {{ $review->comment ?? 'This reviewer didn\'t leave any comments' }}
                    </p>

                    <!-- Reviewer Info -->
                    <div class="flex items-center justify-between border-t pt-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-medium">
                                    {{ substr($review->user->username, 0, 1) }}
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $review->user->username }}</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($review->created_at)->format('F j, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="mb-4">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">No reviews yet</h3>
                    <p class="text-gray-500">Be the first to share your thoughts!</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>