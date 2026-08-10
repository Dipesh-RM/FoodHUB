<?php

use App\Http\Controllers\Frontend\PageController;

use App\Http\Controllers\LogIn\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VendorController::class, 'showRegisterForm']);

Route::post('/vendor/register', [VendorController::class, 'registration'])
    ->name('vendor.register.submit');

Route::get('/vendor/register/success', [VendorController::class, 'RegisterSuccess'])
    ->name('Frontend.VendorSuccess');
