<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Session contains an id of the user if logged in
        if($request->session()->has('user_id')){
            return $next($request);
        }
        if($request-> input("token") !== 'my-secret-token'){
            return redirect()->route('login')->with('error','Invalid token');
        }
        return $next($request);
    }

    
}
