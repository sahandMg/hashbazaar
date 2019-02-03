<?php

namespace App\Http\Controllers;

use App\BitHash;
use App\Mining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class PanelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){

        $hashes = BitHash::where('user_id',Auth::guard('user')->id())->get();
        return view('panel.dashboard',compact('hashes'));
    }

    /*
     * Get Total mining Ajax
     */

    public function totalEarn(Request $request){
// getting bitcoin price in usd
        $mining = DB::table('minings')->where('user_id',$request->id)->where('block',0)->get();
        if( ! $mining->isEmpty()) {
            return [0,0];
        }
        else{
            return $userEarn = [$mining->sum('mined_btc'),$mining->sum('mined_usd')];
        }
    }

    /*
     * Submit new HashPower Orders
     */
    public function postDashboard(Request $request,Hash $hash){

    }



    public function activity(){

        return view('panel.activity');
    }

    public function setting(){

        return view('panel.settings.setting');
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

    public function wallet(){

        return view('panel.settings.wallet');
    }

    public function makeWallet(){

        return view('panel.settings.makeWallet');
    }

    public function referral(){

        return view('panel.referral');
    }

    public function contact(){

        return view('panel.contact');
    }
}
