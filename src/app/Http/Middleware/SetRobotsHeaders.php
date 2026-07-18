<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetRobotsHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->routeIs(
            'changelog.show',
            'dashboard',
            'dashboard.*',
            'settings.*',
            'profile.*',
            'password.*',
            'sleep-preferences.*',
            'appearance',
            'register',
            'login',
            'verification.*',
            'passkeys.*',
            'auth.*',
        )) {
            $response->headers->set('X-Robots-Tag', 'noindex, follow');
        }

        return $response;
    }
}
