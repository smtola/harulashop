<div id="cart-sidebar" 
     class="fixed right-0 top-0 h-full w-80 bg-white shadow-2xl transform transition-transform duration-300 translate-x-full z-50">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Your Cart</h2>
            <button id="close-cart" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        @if($cart->isEmpty())
            <p class="text-gray-500 text-center">Your cart is empty</p>
        @else
            <div class="space-y-4 max-h-[70vh] overflow-y-auto">
                @foreach($cart as $item)
                    <div class="flex items-center gap-4 border-b pb-4">
                        <img src="{{ asset('storage/' . $item->product->image_path) }}" 
                             alt="{{ $item->product->name }}"
                             class="w-16 h-16 object-cover rounded">
                        <div class="flex-1">
                            <p class="font-semibold">{{ $item->product->name }}</p>
                            <p class="text-gray-600">
                                ${{ number_format($item->product->price, 2) }} x {{ $item->quantity }}
                            </p>
                        </div>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-rose-600 hover:text-rose-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 pt-4 border-t">
                <p class="text-lg font-semibold">
                    Total: ${{ number_format($cart->sum(fn($item) => $item->product->price * $item->quantity), 2) }}
                </p>
                <a href="{{ route('checkout') }}"
                   class="block mt-4 w-full bg-indigo-600 text-white py-3 rounded-lg text-center hover:bg-indigo-700">
                    Proceed to Checkout
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Cart Toggle Button -->
<button id="cart-toggle" 
        class="fixed right-4 bottom-4 bg-indigo-600 text-white p-4 rounded-full shadow-lg hover:bg-indigo-700">
    <i class="fas fa-shopping-cart"></i>
    @if($cart->count() > 0)
        <span class="absolute -top-2 -right-2 bg-rose-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
            {{ $cart->count() }}
        </span>
    @endif
</button>

<script>
    const cartSidebar = document.getElementById('cart-sidebar');
    const cartToggle = document.getElementById('cart-toggle');
    const closeCart = document.getElementById('close-cart');

    cartToggle.addEventListener('click', () => {
        cartSidebar.classList.toggle('translate-x-full');
    });

    closeCart.addEventListener('click', () => {
        cartSidebar.classList.add('translate-x-full');
    });
</script>