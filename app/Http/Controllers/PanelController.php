<?php

namespace App\Http\Controllers;

use App\BitHash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class PanelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){

        return view('panel.dashboard');
    }

    /*
     * Get Total mining Ajax
     */

    public function totalEarn(){

        $options = array( 'http' => array( 'method'  => 'GET') );
        $context = stream_context_create($options);
        $contents = file_get_contents('https://www.blockonomics.co/api/price?currency=USD', false, $context);
        $bitCoinPrice = json_decode($contents);
        if($bitCoinPrice->price == 0){

            return 'bitcoin api failed';
        }

        $hashes = BitHash::where('user_id',Auth::guard('user')->id())->get();
        if(!$hashes->isEmpty()){

            $hashPower =  $hashes->sum('hash');
            $userId = '13741374';
            $apiKey = '7b07bc4b507b4d7584770f8ddddd02f1';
            $nonce = rand(0,1000);
            $secret = '0585329bf8eb48509b1ad13b709d9390';
            $url = 'https://antpool.com/api/account.htm';
            $signature = strtoupper(hash_hmac('sha256',$userId.$apiKey.$nonce, $secret,false));

            $fields = [
                'key'       => $apiKey,
                'nonce'     =>  $nonce ,
                'signature' =>  $signature,
                'coin'      =>  'BTC'
            ];

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, "$url?key=$apiKey&nonce=$nonce&signature=$signature&coin=BTC");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);


            $totalEarn = json_decode($result)->data->earnTotal;
            $userEarn = $totalEarn/$hashPower;

            return [$userEarn,$bitCoinPrice->price];
        }else{
            return $userEarn = 0;
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
