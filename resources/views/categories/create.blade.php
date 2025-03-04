<x-app-layout>
    <div class="container mx-auto px-6 py-12 max-w-2xl">
        <h1 class="text-4xl font-extrabold mb-10 text-gray-900 tracking-tight text-center">Add New Category</h1>

        <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-100 max-w-xl mx-auto">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Category Name -->
                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-2">Category Name</label>
                    <input type="text" name="name" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" required placeholder="Enter category name">
                    @error('name')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Parent Category -->
                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-2">Parent Category (Optional)</label>
                    <div class="relative">
                        <select name="parent_category_id" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200">
                            <option value="">None</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->category_id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    @error('parent_category_id')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category Image -->
                {{-- <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-2">Category Image (Optional)</label>
                    <input type="file" name="image" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200">
                    @error('image')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div> --}}

                <!-- Description -->
                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-2">Category Description</label>
                    <textarea name="description" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200 h-32 resize-y" placeholder="Write a brief description of the category"></textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full py-3.5 text-white font-semibold text-lg bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 rounded-lg shadow-md hover:shadow-lg focus:ring-4 focus:ring-indigo-200 transition-all duration-300">
                        Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
