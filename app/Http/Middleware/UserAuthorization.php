<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use Closure;
use Illuminate\Http\Request;

class UserAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            if(Auth::user()->role == "user") {
                return $next($request);
            } else {
                return response([
                    'message' => 'You are unauthorized!'
                ], Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return response([
                'message' => 'Please log in'
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
