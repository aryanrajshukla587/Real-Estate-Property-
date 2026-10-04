<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show Admin Login Page
     */
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    /**
     * Admin Login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | ADMIN AUTHENTICATION
        |--------------------------------------------------------------------------
        */

        if (
            Auth::guard('admin')->attempt(
                $credentials,
                $request->boolean('remember')
            )
        ) {

            /*
            |--------------------------------------------------------------------------
            | Regenerate Session
            |--------------------------------------------------------------------------
            */

            $request->session()->regenerate();

            $user = Auth::guard('admin')->user();

            /*
            |--------------------------------------------------------------------------
            | CHECK ADMIN ROLE
            |--------------------------------------------------------------------------
            */

            if ($user->role !== 'admin') {

                Auth::guard('admin')->logout();

                return back()
                    ->withErrors([
                        'email' => 'You are not authorized to access the admin panel.',
                    ])
                    ->onlyInput('email');
            }

            /*
            |--------------------------------------------------------------------------
            | ADMIN LOGIN SUCCESS
            |--------------------------------------------------------------------------
            |
            | IMPORTANT:
            | Do NOT use redirect()->intended() here.
            | It can redirect the admin to an old session URL such as /login.
            |
            */

            return redirect()
                ->route('admin.dashboard')
                ->with(
                    'success',
                    'Welcome back, ' . $user->name . '!'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | INVALID CREDENTIALS
        |--------------------------------------------------------------------------
        */

        return back()
            ->withErrors([
                'email' => 'The provided credentials are incorrect.',
            ])
            ->onlyInput('email');
    }

    /**
     * Admin Logout
     */
    public function logout(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Logout Admin Guard
        |--------------------------------------------------------------------------
        */

        Auth::guard('admin')->logout();

        /*
        |--------------------------------------------------------------------------
        | Destroy Session
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();

        /*
        |--------------------------------------------------------------------------
        | Regenerate CSRF Token
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerateToken();

        /*
        |--------------------------------------------------------------------------
        | Redirect To Home
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('home');
    }
}

