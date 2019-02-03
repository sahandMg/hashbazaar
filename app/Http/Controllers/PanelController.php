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

        $mining = DB::table('minings')->where('user_id',$request->id)->first();
        if(is_null($mining)) {
            return 404;
        }
        else{
            return $userEarn = [$mining->mined_btc,$mining->mined_usd];
        }
    }

    /*
     * Submit new HashPower Orders
     */
    public function postDashboard(Request $request,Hash $hash){

    }

    public function makeInvoice(){

        /*Blockonomics Configurations*/
        $BASE_URL = 'https://www.blockonomics.co';
        $NEW_ADDRESS_URL = $BASE_URL.'/api/new_address';
        $PRICE_URL = $BASE_URL.'/api/price?currency=USD';
        $API_KEY = 'hMXF2TdBtgFSCi4lbdNtz7mQiXdQcozDPL32BXrncUg';

        $data = '';
        $order_id = uniqid();

        $options = array(
            'http' => array(
                'header'  => 'Authorization: Bearer '.$API_KEY,
                'method'  => 'POST',
                'content' => $data
            )
        );
//Generate new address for this invoice
        $context = stream_context_create($options);
        $contents = file_get_contents($NEW_ADDRESS_URL, false, $context);
        $new_address = json_decode($contents);

//Getting price
        $options = array( 'http' => array( 'method'  => 'GET') );
        $context = stream_context_create($options);
        $contents = file_get_contents('https://www.blockonomics.co/api/price?currency=USD', false, $context);
        $price = json_decode($contents);

        dd($price);

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
