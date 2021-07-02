<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('locale')) {
            app()->setLocale(session('locale'));
        }else if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
            app()->setLocale(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0,2));
        }
        return $next($request);
    }
}
