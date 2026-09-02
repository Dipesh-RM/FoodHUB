<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\HotelController;
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
Route::get('/food', [SearchController::class, 'foodSearch'])->name('food.search');

// Hotel Menu View
Route::get('/hotel/{id}/menu', [HotelController::class, 'menu'])->name('hotels.menu');


Route::get('/auth/redirect',[AuthController::class,'redirect'])->name('redirect');

Route::get('/auth/callback',[AuthController::class,'callback'] );

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
