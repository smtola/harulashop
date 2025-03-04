<!-- resources/views/auth/login.blade.php -->
@extends('layouts.guest')

@section('content')
    {{-- Login Form Card --}}

    <div class="container mx-auto px-4 py-12 max-w-xl">
        <div class="bg-gray-800 shadow-xl rounded-xl overflow-hidden border border-gray-100">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Login</h2>
                <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Username or Email -->
                <div>
                    <x-input-label for="login" :value="__('Username or Email')" />
                    <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('login')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember" class="flex items-center">
                        <x-checkbox id="remember" name="remember" />
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection