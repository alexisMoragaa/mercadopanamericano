<?php

use App\Http\Controllers\Auth\CompleteProfile;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;


Route::get('/google-auth/redirect',[GoogleAuthController::class, 'handleRedirect'])->name('google-auth.redirect');
Route::get('/google-auth/callback', [GoogleAuthController::class, 'handleCallback'])->name('google-auth.callback');

Route::get('/profile/complete', [CompleteProfile::class, 'index'])->middleware(['auth'])->name('complete-profile.index');
Route::post('/profile/complete', [CompleteProfile::class, 'store'])->middleware(['auth'])->name('complete-profile.store');


Route::get('/seller/index', [SellerController::class, 'index'])->middleware(['auth', 'pofileIsComplete'])->name('seller.index');
Route::get('/seller/product/create', [SellerController::class, 'createProduct'])->middleware(['auth', 'pofileIsComplete'])->name('seller.products.create');


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
