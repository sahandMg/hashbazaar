<?php

namespace App\Http\Middleware;

use App\VerifyUser;
use Closure;
use Illuminate\Support\Facades\Auth;

class checkLogin
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
        $query = VerifyUser::where('token',$request->token)->first();
        if(is_null($query)){
            return 'شناسه نادرست';
        }else{
            Auth::guard('user')->login($query->user);
        }
        return $next($request);
    }
}
