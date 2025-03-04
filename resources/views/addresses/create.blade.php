<!-- resources/views/addresses/create.blade.php -->
<x-app-layout>
    <div class="container mx-auto px-6 py-12 max-w-3xl">
        <h1 class="text-4xl font-extrabold mb-10 text-gray-900 tracking-tight text-center">Add New Address</h1>

        <div class="bg-white shadow-xl rounded-xl p-8 border border-gray-100">
            <form action="{{ route('addresses.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Street</label>
                        <input type="text" name="street" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" required>
                    </div>
                    <div>
                        <label class="block text-lg font-semibold text-gray-700 mb-2">City</label>
                        <input type="text" name="city" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" required>
                    </div>
                    <div>
                        <label class="block text-lg font-semibold text-gray-700 mb-2">State</label>
                        <input type="text" name="state" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" required>
                    </div>
                    <div>
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Country</label>
                        <input type="text" name="country" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" required>
                    </div>
                    <div>
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Postal Code</label>
                        <input type="text" name="postal_code" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" required>
                    </div>
                    <div>
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Type</label>
                        <select name="type" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" required>
                            <option value="shipping">Shipping</option>
                            <option value="billing">Billing</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-3.5 text-white font-semibold rounded-lg bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 shadow-md hover:shadow-lg transition-all duration-300">
                        Save Address
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>