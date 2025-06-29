<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-auth/callback', function () {
    // echo 'Google Auth Callback'; die();
    $user = Socialite::driver('google')->user();

    $user = User::updateOrCreate(
        ['google_id' => $user->id],
        [
            'name' => $user->name,
            'email' => $user->email,
        ]
    );
    Auth::login($user);
    return redirect()->route('dashboard');
    // $user->token
});

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
