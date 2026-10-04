<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show Normal Login Page
     */
    public function showLoginForm()
    {
        return view('pages.login');
    }

    /**
     * Handle Login
     *
     * Agent -> agent guard
     * Owner -> web guard
     * User  -> web guard
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | AGENT LOGIN
        |--------------------------------------------------------------------------
        |
        | Agent uses the separate agent guard.
        |
        */

        if (Auth::guard('agent')->attempt($credentials)) {

            $user = Auth::guard('agent')->user();

            if ($user->role === 'agent') {

                $request->session()->regenerate();

                return redirect()
                    ->route('agent.dashboard')
                    ->with(
                        'success',
                        'Welcome back, ' . $user->name . '!'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Invalid role for agent guard
            |--------------------------------------------------------------------------
            */

            Auth::guard('agent')->logout();
        }


        /*
        |--------------------------------------------------------------------------
        | NORMAL WEB LOGIN
        |--------------------------------------------------------------------------
        |
        | Owner and normal User both use the web guard.
        |
        */

        if (Auth::guard('web')->attempt($credentials)) {

            $user = Auth::guard('web')->user();


            /*
            |--------------------------------------------------------------------------
            | OWNER LOGIN
            |--------------------------------------------------------------------------
            */

            if ($user->role === 'owner') {

                $request->session()->regenerate();

                return redirect()
                    ->route('owner.dashboard')
                    ->with(
                        'success',
                        'Welcome back, ' . $user->name . '!'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | NORMAL USER LOGIN
            |--------------------------------------------------------------------------
            */

            if ($user->role === 'user') {

                $request->session()->regenerate();

                return redirect()
                    ->intended(route('home'))
                    ->with(
                        'success',
                        'Welcome back, ' . $user->name . '!'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | INVALID WEB ROLE
            |--------------------------------------------------------------------------
            |
            | If the account exists but its role is not allowed
            | through the normal web login.
            |
            */

            Auth::guard('web')->logout();
        }


        /*
        |--------------------------------------------------------------------------
        | INVALID LOGIN
        |--------------------------------------------------------------------------
        */

        return back()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ])
            ->onlyInput('email');
    }


    /**
     * Agent Logout
     */
    public function logout(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | LOGOUT FROM AGENT GUARD
        |--------------------------------------------------------------------------
        */

        Auth::guard('agent')->logout();


        /*
        |--------------------------------------------------------------------------
        | INVALIDATE AGENT SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();


        /*
        |--------------------------------------------------------------------------
        | GENERATE NEW CSRF TOKEN
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerateToken();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT TO LOGIN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('login')
            ->with(
                'success',
                'You have been logged out successfully.'
            );
    }


    /**
     * Normal User / Owner Logout
     */
    public function userLogout(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | LOGOUT FROM WEB GUARD
        |--------------------------------------------------------------------------
        */

        Auth::guard('web')->logout();


        /*
        |--------------------------------------------------------------------------
        | COMPLETELY INVALIDATE USER SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();


        /*
        |--------------------------------------------------------------------------
        | GENERATE NEW CSRF TOKEN
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerateToken();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT TO HOME PAGE
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('home')
            ->with(
                'success',
                'You have been logged out successfully.'
            );
    }
}