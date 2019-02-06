<?php

namespace App\Http\Controllers;

use App\Http\Helpers;
use App\Jobs\subscriptionMailJob;
use App\User;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
         'name' => 'required',
        'email'=>'required|email|unique:users',
        'password'=> 'required',
        'confirm_password' => 'required|same:password'

        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->code = str_random(10);
        $user->password = Hash::make($request->password);
        $user->reset_password = str_random(10);
        $user->ip = Helpers::userIP();
        try{

            $user->country = strtolower(Location::get(Helpers::userIP())->countryCode);
        }catch (\Exception $exception){
            $user->country = 'fr';
        }
        // $user->plan_id = DB::table('plans')->where('name',$request->plan)->first()->id;
        // $user->period_id = DB::table('periods')->where('name',$request->period)->first()->id;
        $user->save();
//        subscriptionMailJob::dispatch($user->email,$user->code);
        Auth::guard('user')->login($user);
        $data = [
            'code'=> $user->code,
            'email'=>$user->email
        ];
        Mail::send('email.thanks',$data,function($message) use($data){
            $message->from ('Admin@HashBazaar');
            $message->to ($data['email']);
            $message->subject ('Subscription Email');
        });

        Session::put('code',$user->code);
        return redirect()->route('subscription');
    }

    /*
     * Subscription page after filling the form
     */
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

    public function signup(){

        return view('auth.signup');
    }

    public function post_signup(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email'=>'required|email|unique:users',
            'password'=> 'required',
            'confirm_password' => 'required|same:password'

        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->ip = Helpers::userIP();
        try{

            $user->country = strtolower(Location::get(Helpers::userIP())->countryCode);
        }catch (\Exception $exception){
            $user->country = 'fr';
        }

        $user->code = str_random(10);
        $user->password = Hash::make($request->password);
        $user->reset_password = str_random(10);
        // $user->plan_id = DB::table('plans')->where('name',$request->plan)->first()->id;
        // $user->period_id = DB::table('periods')->where('name',$request->period)->first()->id;
        $user->save();
//        subscriptionMailJob::dispatch($user->email,$user->code);
        Auth::guard('user')->login($user);
        $data = [
            'code'=> $user->code,
            'email'=>$user->email
        ];

        Mail::send('email.thanks',$data,function($message) use($data){
            $message->from ('Admin@HashBazaar');
            $message->to ($data['email']);
            $message->subject ('Subscription Email');
        });


        return redirect()->route('dashboard');
    }

    public function login(){

        return view('auth.login');
    }

    public function post_login(Request $request){

        $this->validate($request,[
            'email'=> 'required|email',
            'password'=>'required'
        ]);

        if(Auth::guard('user')->attempt(['email'=>$request->email,'password'=>$request->password])){
            try{

                $country = strtolower(Location::get(Helpers::userIP())->countryCode);
            }catch (\Exception $exception){
                $country = 'fr';
            }

            Auth::guard('user')->user()->update(['ip'=>Helpers::userIP(),'country'=>$country]);
            return redirect()->route('dashboard');
        }else{

            return redirect()->back();
        }

    }

    public function logout(){

        Auth::guard('user')->logout();
        return redirect()->route('index');
    }
}
