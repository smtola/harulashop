<x-app-layout>
    <div class="container mx-auto px-4 py-12 max-w-2xl">
        <h1 class="text-4xl font-extrabold mb-10 text-gray-900 tracking-tight text-center">Edit Address</h1>

        <form action="{{ route('addresses.update', $address->address_id) }}" method="POST" class="bg-white shadow-xl rounded-xl p-8 border border-gray-100 space-y-8">
            @csrf
            @method('PUT')

            <div>
                <label for="street" class="block text-lg font-semibold text-gray-700 mb-2">Street</label>
                <input type="text" name="street" id="street" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" value="{{ $address->street }}">
            </div>

            <div>
                <label for="city" class="block text-lg font-semibold text-gray-700 mb-2">City</label>
                <input type="text" name="city" id="city" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" value="{{ $address->city }}">
            </div>

            <div>
                <label for="state" class="block text-lg font-semibold text-gray-700 mb-2">State</label>
                <input type="text" name="state" id="state" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" value="{{ $address->state }}">
            </div>

            <div>
                <label for="zip" class="block text-lg font-semibold text-gray-700 mb-2">Zip</label>
                <input type="text" name="zip" id="zip" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" value="{{ $address->zip }}">
            </div>

            <div>
                <label for="country" class="block text-lg font-semibold text-gray-700 mb-2">Country</label>
                <input type="text" name="country" id="country" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" value="{{ $address->country }}">
            </div>

            <div>
                <label for="type" class="block text-lg font-semibold text-gray-700 mb-2">Type</label>
                <input type="text" name="type" id="type" class="w-full p-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200" value="{{ $address->type }}">
            </div>

            <div>
                <button type="submit" class="w-full py-3.5 text-white font-semibold text-lg rounded-lg bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 shadow-md hover:shadow-lg transition-all duration-300">
                    Update Address
                </button>
            </div>
        </form>
    </div>
</x-app-layout>