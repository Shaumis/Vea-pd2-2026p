<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware; // Added this import

class AuthController extends Controller implements HasMiddleware
{
    /**
     * Define the middleware that should apply to this controller.
     */
    public static function middleware(): array
    {
        return [
            // Fixed: Only require authentication for the logout method
            new Middleware('auth', only: ['logout']),
            
            // Optional: Prevent logged-in users from seeing login pages again
            new Middleware('guest', only: ['login', 'authenticate']), 
        ];
    }

    public function login(): View
    {
        return view(
            'auth.login',
            [
                'title' => 'Pieslēgties'
            ]
        );
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        // Note: Ensure your login form uses 'name' as the input field name instead of 'email'
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/voicebanks');
        }

        return back()->withErrors([
            'name' => 'Autentifikācija neveiksmīga',
        ]);
    }
}