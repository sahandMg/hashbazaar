<?php

namespace App\Http\Controllers;

use App\BitHash;
use App\Events\Contact;
use App\ExpiredCode;
use App\Message;
use App\Mining;
use App\MiningReport;
use App\Referral;
use App\ReferralCode;
use App\Sharing;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\CryptoJob;
class PanelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){



        $hashes = BitHash::where('user_id',Auth::guard('user')->id())->where('confirmed',1)->get();
        $unusedCodes = DB::table('expired_codes')->where('user_id',Auth::guard('user')->id())->where('used',0)->count();
        if($unusedCodes > 0){
            $apply_discount = 1;
        }else{
            $apply_discount = 0;
        }
        return view('panel.dashboard',compact('hashes','apply_discount'));
    }

    /*
     * Get Total mining Ajax
     */

    public function totalEarn(Request $request){
// getting bitcoin price in usd
        $user = DB::table('users')->where('code',$request->user)->first();
        if(is_null($user)){
            return 404;
        }
        $mining = DB::table('minings')->where('user_id',$user->id)->where('block',0)->get();
        if( $mining->isEmpty()) {
            return [0,0];
        }
        else{
            return $userEarn = [$mining->sum('mined_btc'),$mining->sum('mined_usd')];
        }
    }
    /*
     *  bitcoin mining chart data
     */
    public function chartData(Request $request){

        $user = DB::table('users')->where('code',$request->user)->first();
        $reports = MiningReport::where('user_id',$user->id)->get();

        if(count($reports) == 0){
            return 404;
        }
        $data = [];
        for($i = 0 ; $i <= date('t') ; $i++){
            $time = Carbon::now()->subDay($i);
            $reports = MiningReport::whereDate('created_at',$time)->where('user_id',1)->get();
            if(count($reports) > 0){
                $totalUsd =  $reports->sum('mined_usd');
                $data[$i] = ['time'=>$time->format('Y d M') , 'mined'=>$totalUsd];
            }

        }

        $data = array_reverse( array_values($data)) ;
        return $data;


    }

    public function post_changePassword(Request $request){

        $this->validate($request,[
            'password'=>'required|min:8',
            'confirm_password'=>'required|same:password'
        ]);

        $user = Auth::user();
        $user->password = $request->password;
        $user->save();

        return redirect()->back()->with(['message'=>'New password has been set!']);

    }

    /*
     * Apply referral code
     * check if a referral code is active or not
     */
    public function postDashboard(Request $request,Hash $hash){


        $code = $request->referralCode;
        $is_active_Code = DB::table('expired_codes')
            ->where('user_id',Auth::guard('user')->id())
            ->where('used',0)->count();
        if($is_active_Code > 0){

            return [
                'type'=>'error',
                'body'=>'Your previous referral code has not been used yet !'
            ];
        }
        $referralUser = DB::table('users')->where('code',$code)->where('id','!=',Auth::id())->first();
        $is_expired = DB::table('expired_codes')->where('code',$code)->first();

        // check if the code is used before
        if(!is_null($is_expired)){

            return [
                'type'=>'error',
                'body'=>'Expired code entered'
            ];
        }
        // check code validation
        if(is_null($referralUser)){

            return [
                'type'=>'error',
                'body'=>'Code is not valid'
            ];
        }
        /*
         * 1. check sharing level
         * 2. update sharing benefit
         * 3. update sharing number
         * 4.
         */
        else{
            $referralUser = Referral::where('code',$code)->where('id','!=',Auth::id())->first();
            $sharings = Sharing::all()->toArray();
//            dd($sharings[0]);
            $expireCode = new ExpiredCode();
            $expireCode->user_id = Auth::guard('user')->id();
            $expireCode->code = $code;
            $expireCode->save();
            $referralUser->update([
                'total_sharing_num' => $referralUser->total_sharing_num + 1
            ]);
            $referralUser->save();
            $total_sharing_num = $referralUser->total_sharing_num;

            for($i=0 ; $i<count($sharings); $i++){

                if($sharings[$i]['sharing_number'] <= $total_sharing_num ){

                    $referralUser->update([
                        'share_level' => $sharings[$i]['level']
                    ]);
                    $referralUser->save();
                }



//                elseif( $sharings[0] <= $total_sharing_num && $total_sharing_num < $sharings[1]){
//
//                }elseif( $sharings[1] <= $total_sharing_num && $total_sharing_num < $sharings[2]){
//
//                }elseif( $sharings[2] >= $total_sharing_num){}
            }

            return [
                'type'=>'message',
                'body'=>'code accepted'
            ];

        }
    }



    public function activity(){

        $hashes = BitHash::where('user_id',Auth::guard('user')->id())->where('confirmed',1)->get();
        return view('panel.activity',compact('hashes'));
    }

    public function setting(){

        return view('panel.settings.setting');
    }

    public function post_setting(Request $request){

        $this->validate($request,[
            'pass'=>'required|min:8',
            'newpass'=>'required|min:8',
            'confirm'=>'required|same:newpass',
        ]);
        $user = Auth::guard('user')->user();
        $user->update([
            'password'=>Hash::make($request->newpass)

        ]);
        $user->save();
        return redirect()->back()->with(['message'=>'Password Changed']);
    }

    public function userInfo(){

        return view('panel.settings.userInfo');
    }

    public function post_userInfo(Request $request){

        $user = Auth::guard('user')->user();
        $input = $request->all();
        if(isset($input['email'])){

            $user->update(['email'=>$input['email']]);
        }

        if(isset($input['password'])){

            $user->update(['password'=> Hash::make($input['password'])]);
        }
    }

    public function changePassword(){

        return view('panel.settings.changePassword');
    }

    public function post_wallet(Request $request){

        $this->validate($request,['wallet'=>'required']);

        $wallet = new Wallet();
        $wallet->addr = $request->wallet;
        $wallet->user_id = Auth::guard('user')->id();
        $wallet->active = 1;
        $wallet->save();

        return redirect()->route('makeWallet');

    }

    public function wallet(){

        if(!is_null(Auth::guard('user')->user()->wallet)){ // user has a wallet

            return redirect()->route('makeWallet');
        }
        return view('panel.settings.wallet');
    }

    public function makeWallet(){

        $wallet = Auth::guard('user')->user()->wallet();
        return view('panel.settings.makeWallet',compact('wallet'));
    }

    public function referral(){

        return view('panel.referral');
    }

    public function contact(){

        return view('panel.contact');
    }

    public function post_contact(Request $request,Message $message){

        $this->validate($request,['name'=>'required','email'=>'required|email','message'=>'required']);

        if($request->has('name')){

        }
        $message->name = $request->name;
        $message->email = $request->email;
        $message->message = $request->message;
        $message->save();

//        MessageJob::dispatch($request->email,$request->message);
        $data = [
            'UserMessage'=> $request->message,
            'email'=> $request->email,
            'name' => $request->name
        ];

        event(new Contact($data));

        return redirect()->back()->with(['message'=>'Your message has been sent!']);
    }
}
