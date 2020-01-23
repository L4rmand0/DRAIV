<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\Middleware\AuthenticateDriver as Middleware;

class AuthenticateDriver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $logged = Auth::guest();
        if($logged){
            return redirect()->route('login.driver');
        }else{
            return $next($request);
        }
    }
}
