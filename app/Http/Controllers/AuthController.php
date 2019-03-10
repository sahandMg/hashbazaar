<?php

namespace App\Http\Controllers;

use App\Http\Helpers;
use App\Jobs\subscriptionMailJob;
use App\User;
use Laravel\Socialite\Facades\Socialite;
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
        $user->code = uniqid('hashBazaar_');
        $user->password = Hash::make($request->password);
        $user->reset_password = str_random(10);
        $user->ip = Helpers::userIP();
        $user->total_mining = 0;
        $user->pending = 0;
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
        event(new \App\Events\ReferralQuery(Auth::user()));
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
        $user->total_mining = 0;
        $user->pending = 0;
        try{

            $user->country = strtolower(Location::get(Helpers::userIP())->countryCode);
        }catch (\Exception $exception){
            $user->country = 'fr';
        }

        $user->code = uniqid('hashBazaar_');
        $user->password = Hash::make($request->password);
        $user->reset_password = str_random(10);
        // $user->plan_id = DB::table('plans')->where('name',$request->plan)->first()->id;
        // $user->period_id = DB::table('periods')->where('name',$request->period)->first()->id;
        $user->save();
//        subscriptionMailJob::dispatch($user->email,$user->code);
        Auth::guard('user')->login($user);
        event(new \App\Events\ReferralQuery(Auth::user()));
        $data = [
            'code'=> $user->code,
            'email'=>$user->email
        ];

        Mail::send('email.newUser',['user'=>$user],function($message) use($data){
            $message->from ('Admin@HashBazaar');
            $message->to ('info@hashbazaar.com');
            $message->subject ('New User');
        });
        Mail::send('email.thanks',$data,function($message) use($data){
            $message->from ('Admin@HashBazaar');
            $message->to ($data['email']);
            $message->subject ('Subscription Email');
        });


        return redirect()->route('dashboard');
    }

    public function login(Request $request){
        $hashPower = $request->hashPower;
        return view('auth.login',compact('hashPower'));
    }

    public function post_login(Request $request){

        $this->validate($request,[
            'email'=> 'required|email',
            'password'=>'required|min:6'
        ]);

        if(Auth::guard('user')->attempt(['email'=>$request->email,'password'=>$request->password])){
            try{

                $country = strtolower(Location::get(Helpers::userIP())->countryCode);
            }catch (\Exception $exception){
                $country = 'fr';
            }

            Auth::guard('user')->user()->update(['ip'=>Helpers::userIP(),'country'=>$country]);

            if($request->has(['hashPower'])){
                $hashPower = $request->hashPower;
                    return redirect()->route('dashboard')->with(['hashPower'=>$hashPower]);
                }else{

                    return redirect()->route('dashboard');
                }
        }else{

            return redirect()->back()->with(['error'=>'Wrong email or password']);
        }

    }
    /*
     * Google Login Apis
     */

    public function redirectToProvider()
    {
//
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(){

        $client =  Socialite::driver('google')->stateless()->user();

//        try{
//            $user = User::where('email',$client->email)->firstOrFaile();
//        }catch (\Exception $exception){
//
//            return 404;
//        }

//            $userData = JWTAuth::parseToken()->authenticate();

//            return ['token'=>$token,'userData'=>$user];

        $user = User::where('email',$client->email)->first();
        if(!is_null($user)){
            $user->avatar = $client->avatar;
            $user->ip = Helpers::userIP();
            try{

                $user->country = strtolower(Location::get(Helpers::userIP())->countryCode);
            }catch (\Exception $exception){
                $user->country = 'fr';
            }

            $user->save();

            Auth::guard('user')->login($user);
            return redirect()->route('dashboard');
        }

        $user = new User();
        $user->name = $client->name;
        $user->email = $client->email;
        $user->code = uniqid('hashBazaar_');
        $user->avatar = $client->avatar;
        $user->ip = Helpers::userIP();
        $user->total_mining = 0;
        $user->pending = 0;
        try{

            $user->country = strtolower(Location::get(Helpers::userIP())->countryCode);
        }catch (\Exception $exception){
            $user->country = 'fr';
        }

        $user->save();

        $data = [
            'code'=> $user->code,
            'email'=>$user->email
        ];
        event(new \App\Events\ReferralQuery(Auth::user()));
        Mail::send('email.thanks',$data,function($message) use($data){
            $message->from ('Admin@HashBazaar');
            $message->to ($data['email']);
            $message->subject ('Subscription Email');
        });

        return redirect()->route('dashboard');
    }

    public function passwordReset(){

        return view('password_reset');
    }

    public function post_passwordReset(Request $request){

        $this->validate($request,[
            'email'=> 'required|email'
        ]);

        $user = User::where('email',$request->email)->first();
        $pass = strtolower(str_random(10));
        $user->password = bcrypt($pass);
        $user->save();
        Mail::send('email.reset_password',['pass'=>$pass,'user'=>$user],function($message) use($user){
            $message->from ('Admin@HashBazaar');
            $message->to ($user->email);
            $message->subject ('Password Reset');
        });

        return redirect()->route('login')->with(['message'=>'An Email with a new password has been sent to your email address']);

    }

    public function logout(){

        Auth::guard('user')->logout();
        return redirect()->route('index');
    }
}
