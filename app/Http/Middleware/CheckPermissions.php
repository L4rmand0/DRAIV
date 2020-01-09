<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckPermissions as Middleware;
use Closure;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $module)
    {
        echo $user_id = auth()->user()->id;
        // echo ' '.$module ;
        // echo '<pre> middlware ';
        // print_r($request->all());
        // die;
        return $next($request);
    }
}
