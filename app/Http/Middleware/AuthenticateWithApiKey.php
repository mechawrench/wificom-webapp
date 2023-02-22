<?php

namespace App\Http\Middleware;

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
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
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
