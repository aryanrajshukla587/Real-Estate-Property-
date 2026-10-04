<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | CHECK LOGIN
        |--------------------------------------------------------------------------
        |
        | Owner normal web guard se login karta hai.
        |
        */

        if (!Auth::guard('web')->check()) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Please login as an owner to continue.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CHECK OWNER ROLE
        |--------------------------------------------------------------------------
        |
        | Sirf role = owner ko Owner Panel access milega.
        |
        */

        if (Auth::guard('web')->user()->role !== 'owner') {
            abort(403, 'Unauthorized access.');
        }

        /*
        |--------------------------------------------------------------------------
        | ALLOW REQUEST
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}
