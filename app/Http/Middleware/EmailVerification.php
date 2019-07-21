<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EmailVerification
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
        if(Auth::guard('user')->check()){
            $user = Auth::guard('user')->user();
            if($user->verified == 0){
                Session::flash('message', 'ایمیل فعال سازی حساب ارسال شد. درصورت دریافت نکردن ایمیل رو ارسال مجدد کلیک کنید');
                Session::put('userToken', $user->verifyUser->token);
                return redirect()->route('VerifyUserPage');
            }
        }else{
            return redirect()->route('login');
        }
        return $next($request);
    }
}
