<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Models\Category;
require __DIR__.'/auth.php';
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/blog', function () { return view('blog'); })->name('blog'); // Placeholder
Route::get('/contact', function () { return view('contact'); })->name('contact'); // Placeholder

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

    Route::get('/product/create', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
    Route::post('/product/store', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
    Route::get('/product/{product_id}', [ProductController::class, 'show'])->name('products.show')->middleware('auth');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store')->middleware('auth');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');

    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create')->middleware('auth');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
    Route::get('/orders/{order_item_id}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth');

    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index')->middleware('auth');
    Route::get('/addresses/create', [AddressController::class, 'create'])->name('addresses.create')->middleware('auth');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store')->middleware('auth');
    Route::get('/addresses/{address_id}', [AddressController::class, 'show'])->name('addresses.show')->middleware('auth');
    Route::put('/addresses/{address_id}', [AddressController::class, 'update'])->name('addresses.update')->middleware('auth');
    Route::delete('/addresses/{address_id}', [AddressController::class, 'destroy'])->name('addresses.destroy')->middleware('auth');
    Route::get('/addresses/{address_id}/edit', [AddressController::class, 'edit'])->name('addresses.edit')->middleware('auth');

    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('auth');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('auth');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index')->middleware('auth');
    Route::get('/payments/create/{order_id}', fn($order_id) => view('payments.create', ['order_id' => $order_id]))->name('payments.create')->middleware('auth');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store')->middleware('auth');

    Route::get('/reviews/{product_id}', [ReviewController::class, 'index'])->name('reviews.index')->middleware('auth');
    Route::get('/reviews/create/{product_id}', [ReviewController::class, 'create'])->name('reviews.create')->middleware('auth');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
});

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
    });