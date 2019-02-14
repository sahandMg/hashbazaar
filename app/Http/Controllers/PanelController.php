<?php

namespace App\Http\Controllers;

use App\BitHash;
use App\Mining;
use App\MiningReport;
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
        return view('panel.dashboard',compact('hashes'));
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
     * Submit new HashPower Orders
     */
    public function postDashboard(Request $request,Hash $hash){

    }



    public function activity(){

        $hashes = BitHash::where('user_id',Auth::guard('user')->id())->where('confirmed',1)->get();
        return view('panel.activity',compact('hashes'));
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
