<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgentAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('agent')->check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Please login to access the agent panel.');
        }

        if (auth('agent')->user()->role !== 'agent') {

            auth('agent')->logout();

            return redirect()
                ->route('login')
                ->with('error', 'You are not authorized to access the agent panel.');
        }

        return $next($request);
    }
}