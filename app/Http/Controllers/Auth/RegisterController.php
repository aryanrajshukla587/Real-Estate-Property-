<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show registration form.
     */
    public function showRegistrationForm()
    {
        return view('pages.register');
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | NAME
            |--------------------------------------------------------------------------
            */
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | EMAIL
            |--------------------------------------------------------------------------
            */
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            /*
            |--------------------------------------------------------------------------
            | ACCOUNT TYPE
            |--------------------------------------------------------------------------
            |
            | Available account types:
            | user  = Normal User
            | owner = Property Owner
            | agent = Property Agent
            |
            */
            'role' => [
                'required',
                'in:user,owner,agent',
            ],

            /*
            |--------------------------------------------------------------------------
            | PASSWORD
            |--------------------------------------------------------------------------
            */
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | CREATE USER
        |--------------------------------------------------------------------------
        */

        User::create([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => Hash::make($validated['password']),

            'role' => $validated['role'],

        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT TO LOGIN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Registration successful. Please login.'
            );
    }
}

