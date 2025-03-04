<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white border-b border-gray-200 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left Side: Logo and Links -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="shrink-0">
                    <a href="{{ route('home') }}">
                        <span class="text-2xl font-bold">PressMart.</span>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden sm:flex space-x-8">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-lg font-semibold hover:text-yellow-400">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" class="text-lg font-semibold hover:text-yellow-400">
                        {{ __('Shop') }}
                    </x-nav-link>
                    <x-nav-link :href="route('blog')" :active="request()->routeIs('blog')" class="text-lg font-semibold hover:text-yellow-400">
                        {{ __('Blog') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="text-lg font-semibold hover:text-yellow-400">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>

                <!-- Cart Link with Indicator -->
                <a href="{{ route('cart.index') }}" class="relative text-lg font-semibold hover:text-yellow-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                         stroke-linecap="round" stroke-linejoin="round" width="20" height="20" stroke-width="1.5">
                        <path d="M17.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"/>
                        <path d="M6 8v11a1 1 0 0 0 1.806 .591l3.694 -5.091v.055"/>
                        <path d="M6 8h15l-3.5 7l-7.1 -.747a4 4 0 0 1 -3.296 -2.493l-2.853 -7.13a1 1 0 0 0 -.928 -.63h-1.323"/>
                    </svg>
                    @auth
                        @php
                            $cart = Auth::user()->cart;
                            $cartCount = $cart ? $cart->cartItems()->count() : 0;
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    @endauth
                </a>
            </div>

            <!-- Right Side: User Dropdown and Mobile Menu Toggle -->
            <div class="hidden sm:flex items-center space-x-6">
                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-lg font-medium text-gray-200 hover:text-yellow-400 transition ease-in-out duration-200">
                            <span>{{ Auth::user()->name ?? 'Account' }}</span>
                            <svg class="ml-2 h-5 w-5 transform rotate-180 transition duration-300 ease-in-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @auth
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-800 hover:text-gray-600">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-gray-800 hover:text-gray-600"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            <x-dropdown-link :href="route('login')" class="text-gray-800 hover:text-gray-600">
                                {{ __('Login') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')" class="text-gray-800 hover:text-gray-600">
                                {{ __('Register') }}
                            </x-dropdown-link>
                        @endauth
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="text-gray-200 hover:text-yellow-400 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden bg-blue-800 text-white">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="hover:text-yellow-400">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" class="hover:text-yellow-400">
                {{ __('Shop') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('blog')" :active="request()->routeIs('blog')" class="hover:text-yellow-400">
                {{ __('Blog') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="hover:text-yellow-400">
                {{ __('Contact') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cart.index')" class="hover:text-yellow-400">
                {{ __('Cart') }} 
                @auth
                    ({{ Auth::user()->cart ? Auth::user()->cart->cartItems()->count() : 0 }})
                @endauth
            </x-responsive-nav-link>
        </div>

        <!-- Mobile User Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                @auth
                    <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                @else
                    <p class="text-gray-200">Not logged in</p>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                @auth
                    <x-responsive-nav-link :href="route('profile.edit')" class="hover:text-yellow-400">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" class="hover:text-yellow-400"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('login')" class="hover:text-yellow-400">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="hover:text-yellow-400">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>