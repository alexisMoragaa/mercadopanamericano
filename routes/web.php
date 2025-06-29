<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use Illuminate\Support\Facades\Route;


Route::get('/google-auth/redirect',[GoogleAuthController::class, 'handleRedirect'])->name('google-auth.redirect');
Route::get('/google-auth/callback', [GoogleAuthController::class, 'handleCallback'])->name('google-auth.callback');


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
