<?php

namespace App\Http\Services\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthService
{

    public function handleGoogleRedirect()
    {
        try {
            // Redirect to Google for authentication
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            Log::error('Error al redirigir a Google: ' . $e->getMessage());
            throw new Exception('No fue posible redirigir a Google para autenticación.');
        }
    }


    /**
     * Get the callback URL for Google.
     *
     * @return void
     */
    public function handleGoogleCallback(): void
    {
        try{

            $googleUser = Socialite::driver('google')->user();

            if (empty($googleUser->id) || empty($googleUser->email)) {
                throw new Exception('Datos incompletos recibidos de Google.');
            }

            
            $user = User::updateOrCreate(
                ['google_id' => $googleUser->id],
                [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                ]
            );

            Auth::login($user);

        }catch (\Exception $e) {
            Log::error('Error de estado en OAuth con Google: ' . $e->getMessage());
            throw new Exception('No fue posible realizar el Login con Google.'. $e->getMessage());
        }
        

    }
}