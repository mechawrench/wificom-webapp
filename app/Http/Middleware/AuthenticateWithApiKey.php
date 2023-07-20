<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class AuthenticateWithApiKey
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken() ?? $request->input('simple_api_key');

        if (! $token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        if (! Auth::guard('api_custom')->setToken($token)->check()) {
            return response()->json(['error' => 'User not found'], 401);
        }

        $request->merge(['user' => Auth::guard('api_custom')->user()]);

        return $next($request);
    }
}
