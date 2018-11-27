<?php

namespace App\Http\Controllers;

use App\Jobs\subscriptionMailJob;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /*
   * Gets user identification
   * generate referral code
   */
    public function subscribe(Request $request,User $user){
        $this->validate($request,['email'=>'required|email|unique:users',
            'plan'=>'required|filled','period'=>'required|filled']);

        $user->email = $request->email;
        $user->code = str_random(10);
        $user->plan_id = DB::table('plans')->where('name',$request->plan)->first()->id;
        $user->period_id = DB::table('periods')->where('name',$request->period)->first()->id;
        $user->save();
        subscriptionMailJob::dispatch($user->email,$user->code);
        return redirect()->route('subscription')->with(['code'=>$user->code]);
    }

    public function subscription(){
        if(session()->has('code')){
            $code = session('code');
            return $code;
//            return view('subscription',compact('code'));
        }else{
//            if session has been expired, 404 error will be appear
            abort(404);
        }


    }
    /*
     *  get referral code from friends and do what ??
     */
    public function post_subscription(Request $request){


    }
}
