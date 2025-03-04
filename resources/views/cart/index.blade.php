<x-app-layout>
    <div class="container mx-auto px-8 py-12 max-w-5xl">
        <h1 class="text-4xl font-extrabold mb-10 text-gray-900 tracking-tight">Your Cart</h1>

        @if (session('success'))
            <div class="mb-8 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-lg shadow-md">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-8 bg-rose-50 border-l-4 border-rose-500 text-rose-700 p-4 rounded-r-lg shadow-md">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-100">
            <div class="p-6">
                @forelse ($cartItems as $item)
                    <div class="flex justify-between items-center border-b border-gray-100 py-6 last:border-b-0" 
                         x-data="{ 
                             quantity: {{ $item->quantity }}, 
                             max: {{ $item->product->stock_quantity }},
                             updating: false 
                         }">
                        <div class="flex items-center space-x-6">
                            <img src="{{ asset('storage/' . $item->product->image_path) }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="w-20 h-20 object-cover rounded-lg shadow-sm border border-gray-100">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800">{{ $item->product->name }}</h2>
                                <p class="text-gray-600 text-sm">
                                    ${{ number_format($item->product->price, 2) }} × 
                                    <span x-text="quantity"></span>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-6">
                            <form action="{{ route('cart.update', $item->id) }}" 
                                  method="POST" 
                                  @submit.prevent="updating = true; fetch($event.target.action, {
                                      method: 'PATCH',
                                      body: new FormData($event.target),
                                      headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                                  })
                                  .then(response => response.ok ? location.reload() : alert('Update failed'))
                                  .catch(() => alert('An error occurred'))
                                  .finally(() => updating = false)">
                                @csrf
                                @method('PATCH')
                                <div class="flex items-center space-x-4">
                                    <button type="button" 
                                            @click="quantity > 1 ? quantity-- : null" 
                                            class="w-10 h-10 flex items-center justify-center text-xl text-gray-600 hover:text-indigo-600 border border-gray-200 hover:border-indigo-500 rounded-full transition duration-200"
                                            :disabled="updating">
                                        <span class="font-bold">-</span>
                                    </button>
                                    <input type="hidden" name="quantity" x-model="quantity">
                                    <span class="w-8 text-center text-lg font-semibold text-gray-800" 
                                          x-text="quantity"></span>
                                    <button type="button" 
                                            @click="quantity < max ? quantity++ : null" 
                                            class="w-10 h-10 flex items-center justify-center text-xl text-gray-600 hover:text-indigo-600 border border-gray-200 hover:border-indigo-500 rounded-full transition duration-200"
                                            :disabled="updating">
                                        <span class="font-bold">+</span>
                                    </button>
                                    <button type="submit" 
                                            class="px-5 py-2 text-white font-medium bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300"
                                            :disabled="updating">
                                        <span x-show="!updating">Update</span>
                                        <span x-show="updating" class="flex items-center">
                                            <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Updating...
                                        </span>
                                    </button>
                                </div>
                            </form>

                            <form action="{{ route('cart.destroy', $item->id) }}" 
                                  method="POST" 
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-5 py-2 text-white font-medium bg-rose-600 hover:bg-rose-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg font-medium">Your cart is empty.</p>
                        <p class="text-gray-400 mt-2">Explore our products and start shopping!</p>
                        <a href="{{ route('products.index') }}" 
                           class="mt-4 inline-block px-6 py-3 text-white font-semibold bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md">
                            Shop Now
                        </a>
                    </div>
                @endforelse

                @if ($cartItems->isNotEmpty())
                    <div class="mt-8 text-right">
                        <p class="text-2xl font-bold text-gray-800">
                            Total: ${{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}
                        </p>
                        <a href="{{ route('orders.create') }}" 
                           class="inline-block mt-4 px-6 py-3 text-white font-semibold text-lg bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                            Proceed to Checkout
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>