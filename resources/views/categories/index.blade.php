<x-app-layout>
    <div class="container mx-auto px-6 py-12 max-w-6xl">
        <h1 class="text-4xl font-extrabold mb-10 text-gray-900 tracking-tight">Categories</h1>

        @if (session('success'))
            <div class="mb-8 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-lg shadow-md">
                {{ session('success') }}
            </div>
        @endif

        @auth
            <a href="{{ route('categories.create') }}" class="inline-block mb-8 px-6 py-3 text-white font-semibold bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                + Add Category
            </a>
        @endauth

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($categories as $category)
                <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300">
                    @if ($category->image)
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                            <span class="text-xl">No Image</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-3">{{ $category->name }}</h2>
                        <p class="text-gray-600 leading-relaxed mb-4">{{ $category->description ?? 'No description available.' }}</p>
                        <p class="text-sm text-gray-500">Products: <span class="font-medium">{{ $category->products->count() }}</span></p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-xl shadow-lg border border-gray-100">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m9-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg font-medium">No categories found.</p>
                    <p class="text-gray-400 mt-2">Create a new category to get started!</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
