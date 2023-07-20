<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddApiHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Accept', 'application/json');

        return $response;
    }
}
