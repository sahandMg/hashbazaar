<?php

namespace App\Http\Controllers;

use App\Jobs\subscriptionMailJob;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
   * Gets user identification
   * generate referral code
   */
    public function subscribe(Request $request,User $user){
        $this->validate($request,[
        'email'=>'required|email|unique:users',
        'password'=> 'required',
        'confirm_password' => 'required|same:password'

        ]);
        $user->email = $request->email;
        $user->code = str_random(10);
        $user->password = Hash::make($request->password);
        $user->reset_password = str_random(10);
        $user->hash= $request->hash;
        // $user->plan_id = DB::table('plans')->where('name',$request->plan)->first()->id;
        // $user->period_id = DB::table('periods')->where('name',$request->period)->first()->id;
        $user->save();
        subscriptionMailJob::dispatch($user->email,$user->code);
        Session::put('code',$user->code);
        return redirect()->route('subscription');
    }

    public function subscription(){

        if(session()->has('code')){
            $code = session('code');
            session()->forget('code');
           return view('subscription',compact('code'));
        }else{
//            if session has been expired, 404 error will be appear
            return redirect()->back();
        }


    }
    /*
     *  get referral code from friends and do what ??
     */
    public function post_subscription(Request $request){


    }
}
