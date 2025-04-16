<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordIsSet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @disregard P1013 - Intelephense not indexing methods on-top of auth helper */
        if (auth()->check() && auth()->user()->requires_password_setup
            && !$request->routeIs('password.setup')
            && !$request->routeIs('logout')
            && !$request->routeIs('password.setup.store'))  {
            return redirect()->route('password.setup');
        }

        return $next($request);
    }
}
