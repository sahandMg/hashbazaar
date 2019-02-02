<?php

namespace App\Http\Controllers;

use App\CryptpBox\lib\Cryptobox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
require_once(app_path()."/CryptoBox/lib/cryptobox.class.php" );

class AdminController extends Controller
{

    public function index(){


    }

    public function transactions(){

        $transactions = DB::table('crypto_payments')->orderBy('PaymentID','desc')->get()->toArray();
        return view('admin.transactions',compact('transactions'));
    }
    /*
     * Ajax request to admin transaction page
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
            if($response['confirmed'] == 1){

                DB::table('crypto_payments')->where('orderID',$transaction->orderID)->update(['txConfirmed'=>1]);
                // send email to user that transaction has been confirmed
                // change transaction status in admin panel
                return 1;
            }
        }
    }
}
