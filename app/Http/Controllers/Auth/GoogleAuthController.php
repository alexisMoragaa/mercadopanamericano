<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\GoogleAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class GoogleAuthController extends Controller
{
    protected GoogleAuthService $googleAuthService;

    public function __construct(GoogleAuthService $googleAuthService)
    {
        $this->googleAuthService = $googleAuthService;
    }
    

    /**
     * Gestioa la redirección a Google para autenticación.
     * 
     * @return RedirectResponse
     */
    public function handleRedirect(): RedirectResponse
    {
        return $this->googleAuthService->handleGoogleRedirect();
    }


    /**
     * Maneja la respuesta de google y gestiona el inicio de sesión del usuario.
     *
     * @return RedirectResponse
     */
    public function handleCallback(): RedirectResponse
    {
        try
        {
            $this->googleAuthService->handleGoogleCallback();
            return Redirect::route('seller.index')
                ->with('success', 'Inicio de sesión exitoso con Google.');
        } 
        catch (\Exception $e)
        {
            return Redirect::route('login')
                ->withErrors(['google' => 'Error al iniciar sesión con Google: ' . $e->getMessage()]);
        }
    }
}