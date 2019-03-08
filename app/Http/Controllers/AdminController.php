<?php

namespace App\Http\Controllers;

use App\CryptpBox\lib\Cryptobox;
use App\Mining;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
require_once(app_path()."/CryptoBox/lib/cryptobox.class.php" );

class AdminController extends Controller
{

    public function index(){

        return view('admin.index');
    }

    public function transactions(){

        $transactions = DB::table('crypto_payments')->orderBy('PaymentID','desc')->paginate(20);

        return view('admin.transactions',compact('transactions'));
    }

    public function adminGetUsersList(){

        $users = User::get();
        return view('admin.users.list',compact('users'));
    }
    /*==================================================================================
     * Ajax request to admin transaction page
     */

    public function blockUser(Request $request){

        $user = User::where('code',$request->code)->first();
        $user->update(['block'=> !$user->block]);
        $user->save();
    }
    /*
     * gets redeem requests
     */
    public function adminRedeems(){

        return view('admin.redeem');
    }
    public function adminGetRedeems(){

        return   $trans = Transaction::get();
    }
/*
 * gets latest user buying
 */
    public function getTransactions(){


        $this->getConfirmedPayment();

        $transactions = DB::table('crypto_payments')->orderBy('PaymentID','desc')->get()->toArray();
        return $transactions;
    }

    private function getConfirmedPayment () {


        $all_keys = array(
            "bitcoin" => array(
                "public_key" => "37917AAhw0Q9Speedcoin77SPDPUBUR2avCPSe9Rbpq8pX41HD",
                "private_key" => "37917AAhw0Q9Speedcoin77SPDPRVxAI38mYYRe0eD3JKPEwvW"
            )
        );
        $transactions = DB::table('crypto_payments')->get();

        foreach ($transactions as $transaction){


            $orderID = $transaction->orderID;
            $userFormat = 'SESSION';
            $userID = $transaction->userID;
            $amount = $transaction->amount;
            $public_key  = $all_keys['bitcoin']["public_key"];
            $private_key = $all_keys['bitcoin']["private_key"];
            $period			= "NOEXPIRY";	  // one time payment, not expiry
            $def_language	= "en";			  // default Language in payment box
            $options = array(
                "public_key"  	=> $public_key,	    // your public key from gourl.io
                "private_key" 	=> $private_key,	// your private key from gourl.io
                "webdev_key"  	=> "", 			    // optional, gourl affiliate key
                "orderID"     	=> $orderID, 		// order id or product name
                "userID"      	=> $userID, 	// unique identifier for every user
                "userFormat"  	=> $userFormat, 	// save userID in COOKIE, IPADDRESS, SESSION  or MANUAL
                "amount"   	  	=> $amount, // product price in btc/bch/bsv/ltc/doge/etc OR setup price in USD below
                "amountUSD"   	=> 0,	    // we use product price in USD
                "period"      	=> $period, 	// payment valid period
                "language"	  	=> $def_language    // text on EN - english, FR - french, etc
            );

            $box = new Cryptobox ($options);
            $response = $box->get_json_values();
            if($response['confirmed'] == 1) {

                DB::table('crypto_payments')->where('orderID', $transaction->orderID)->update(['txConfirmed' => 1]);
                $mining = Mining::where('order_id', $transaction->orderID)->first();
                if (!is_null($mining)) {


                    $mining->update(['block' => 0]);
                    $mining->save();
                    // send email to user that transaction has been confirmed
                    // change transaction status in admin panel
                    return 1;
                }
            }
        }
    }

    public function adminCheckout(){

        $users = User::all();

        return view('admin.users.checkout',compact('users'));
    }
}
