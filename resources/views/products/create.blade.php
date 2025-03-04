<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-12">
        <h1 class="text-4xl font-extrabold mb-10 text-gray-900 tracking-tight text-center">Add New Product</h1>

        <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-100">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Product Name -->
                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-2">Product Name</label>
                    <input type="text" name="name" placeholder="Enter product name" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" required>
                    @error('name')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-2">Description</label>
                    <textarea name="description" placeholder="Enter product description" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200 h-32 resize-y" required></textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-2">Price ($)</label>
                    <input type="number" name="price" placeholder="Enter price" step="0.01" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" required>
                    @error('price')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-2">Stock Quantity</label>
                    <input type="number" name="stock" placeholder="Enter stock quantity" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" required>
                    @error('stock')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category Selection -->
                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-2">Category</label>
                    <select name="category_id" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" required>
                        <option value="" disabled selected>Select a category</option>
                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-2">Product Image</label>
                    <input type="file" name="image" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*">
                    @error('image')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-3 text-white font-semibold bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>