<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class CompleteProfile extends Controller
{
    public function index()
    {
        return view('auth.complete-profile');
    }

    /**
     * Store the completed profile data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'cellphone' => ['required', 'string', 'max:15'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->cellphone = $request->input('cellphone');
        $user->address = $request->input('address');
        $user->password = bcrypt($request->input('password'));
        $user->is_complete = true;
        $user->save();

        return redirect()->route('seller.index')->with('status', 'Profile completed successfully.');
    }
    
}