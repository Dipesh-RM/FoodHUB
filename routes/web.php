<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HotelController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\LogIn\VendorController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;

Route::get('register', [VendorController::class, 'showRegisterForm'])->name('register');

Route::post('/vendor/register', [VendorController::class, 'registration'])
    ->name('vendor.register.submit');

Route::get('/vendor/register/success', [VendorController::class, 'RegisterSuccess'])
    ->name('Frontend.VendorSuccess');
Route::get('/vendor/register/success', [VendorController::class, 'RegisterSuccess'])
    ->name('Frontend.VendorSuccess');
// Home Page
Route::get('/', [PageController::class, 'home'])->name('home');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Hotels
Route::get('/hotels', [PageController::class, 'home'])->name('hotels.index');
Route::get('/hotel/{id}', [PageController::class, 'show'])->name('hotels.show');

// Food Search
// Route::get('/food', [SearchController::class, 'foodSearch'])->name('food.search');

// Hotel Menu View
Route::get('/hotel/{id}/menu', [HotelController::class, 'menu'])->name('hotels.menu');


Route::get('/auth/redirect',[AuthController::class,'redirect'])->name('redirect');

Route::get('/auth/callback',[AuthController::class,'callback'] );

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/login', [AuthController::class, 'redirect'])
    ->name('login');
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/count', [CartController::class, 'getCount'])->name('cart.count');
});


Route::middleware(['auth'])->group(function () {
    // Checkout Page
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    // Address Management
    Route::post('/checkout/address', [CheckoutController::class, 'storeAddress'])->name('checkout.address.store');
    Route::get('/checkout/address/{id}', [CheckoutController::class, 'showAddress'])->name('checkout.address.show');
    Route::put('/checkout/address/{id}', [CheckoutController::class, 'updateAddress'])->name('checkout.address.update');
    Route::delete('/checkout/address/{id}', [CheckoutController::class, 'deleteAddress'])->name('checkout.address.delete');
    // Place Order
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/my-orders', [OrderController::class, 'index'])->name('my-orders');
    Route::get('/my-orders/{id}', [OrderController::class, 'show'])->name('my-orders.show');
    Route::post('/my-orders/{id}/cancel', [OrderController::class, 'cancel'])->name('my-orders.cancel');
    Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');
    Route::post('/checkout/place-order', [OrderController::class, 'placeOrder'])->name('checkout.place-order');
});

