<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
//    protected function redirectTo($request)
//    {
//
//        if (! $request->expectsJson()) {
//            return route('index');
//        }
//    }

    public function handle($request, Closure $next)
    {

        if(Auth::guard('user')->check()){

            return $next($request);
        }
        else{
            return redirect()->route('index');
        }

    }
}
