<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('admin')->check()) {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Please login to access the admin panel.');
        }

        if (auth('admin')->user()->role !== 'admin') {

            auth('admin')->logout();

            return redirect()
                ->route('admin.login')
                ->with('error', 'You are not authorized to access the admin panel.');
        }

        return $next($request);
    }
}