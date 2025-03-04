<x-app-layout>
    <x-slot name="header">
        {{ __('HARULA SHOP') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Welcome Back, {{ Auth::user()->username }}!</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">Explore your shopping dashboard.</p>

                    <!-- Quick Actions -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <a href="{{ route('products.index') }}" class="bg-indigo-50 dark:bg-indigo-900/50 p-6 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900 transition duration-300 shadow-md">
                            <h3 class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">Shop Products</h3>
                            <p class="text-gray-500 dark:text-gray-400 mt-1">Browse our curated collection.</p>
                        </a>
                        <a href="{{ route('cart.index') }}" class="bg-amber-50 dark:bg-amber-900/50 p-6 rounded-lg hover:bg-amber-100 dark:hover:bg-amber-900 transition duration-300 shadow-md">
                            <h3 class="text-lg font-semibold text-amber-600 dark:text-amber-400">View Cart</h3>
                            <p class="text-gray-500 dark:text-gray-400 mt-1">Check your items and checkout.</p>
                        </a>
                    </div>

                    <!-- Categories Section -->
                    <div class="border-t border-gray-100 dark:border-gray-700 pt-6">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Explore Categories</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse ($categories->take(6) as $category)
                                <a href="{{ route('products.index', ['category' => $category->category_id]) }}" class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-4 hover:shadow-lg transition-all duration-300 border border-gray-100 dark:border-gray-600">
                                    <h4 class="text-lg font-medium text-gray-800 dark:text-gray-100">{{ $category->name }}</h4>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ $category->products->count() }} Products</p>
                                </a>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400 col-span-full">No categories available yet.</p>
                            @endforelse
                        </div>
                        @if ($categories->count() > 6)
                            <div class="mt-4 text-right">
                                <a href="{{ route('categories.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">View All Categories</a>
                            </div>
                        @endif
                    </div>

                    <!-- Seller Action -->
                    @if (Auth::user()->role === 'seller')
                        <div class="mt-6">
                            <a href="{{ route('categories.create') }}" class="inline-block px-6 py-3 text-white font-semibold bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                                Add New Category
                            </a>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('products.create') }}" class="inline-block px-6 py-3 text-white font-semibold bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                                Add New Product
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>