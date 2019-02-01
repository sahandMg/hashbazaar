<?php

namespace App\Http\Controllers;

use App\BitHash;
use App\Crawling\CoinMarketCap;
use function App\CryptpBox\lib\cryptobox_selcoin;
use App\Transaction;
use Illuminate\Http\Request;
use App\CryptpBox\lib\Cryptobox;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stevebauman\Location\Facades\Location;
use App\Http\Helpers;

require_once(app_path()."/CryptoBox/lib/cryptobox.class.php" );

class PaymentController extends Controller
{

    public function postPayment(Request $request){

        DEFINE("CRYPTOBOX_PHP_FILES_PATH", app_path()."/CryptoBox/lib/");        	// path to directory with files: cryptobox.class.php / cryptobox.callback.php / cryptobox.newpayment.php;
        // cryptobox.newpayment.php will be automatically call through ajax/php two times - payment received/confirmed
        DEFINE("CRYPTOBOX_IMG_FILES_PATH", app_path()."images/");      // path to directory with coin image files (directory 'images' by default)
        DEFINE("CRYPTOBOX_JS_FILES_PATH", app_path()."js/");			// path to directory with files: ajax.min.js/support.min.js

        // updating bitcoin price
        $options = array( 'http' => array( 'method'  => 'GET') );
        $context = stream_context_create($options);
        $contents = file_get_contents('https://www.blockonomics.co/api/price?currency=USD', false, $context);
        $bitCoinPrice = json_decode($contents);
        if($bitCoinPrice->price == 0){

            return 'bitcoin api failed';
        }
        $userID = Auth::guard('user')->id();	  // place your registered userID or md5(userID) here (user1, user7, uo43DC, etc).
        // You can use php $_SESSION["userABC"] for store userID, amount, etc
        // You don't need to use userID for unregistered website visitors - $userID = "";
        // if userID is empty, system will autogenerate userID and save it in cookies
        $userFormat		= "SESSION";       // save userID in cookies (or you can use IPADDRESS, SESSION, MANUAL)
        $orderID		= str_random(10);	  // invoice #000383
        $amount          = $request->hash * Config::get('const.hashPowerUsd')/$bitCoinPrice->price;
        $period			= "NOEXPIRY";	  // one time payment, not expiry
        $def_language	= "en";			  // default Language in payment box
        $def_coin		= "bitcoin";      // default Coin in payment box



        // List of coins that you accept for payments
        //$coins = array('bitcoin', 'bitcoincash', 'bitcoinsv', 'litecoin', 'dash', 'dogecoin', 'speedcoin', 'reddcoin', 'potcoin', 'feathercoin', 'vertcoin', 'peercoin', 'monetaryunit', 'universalcurrency');
        $coins = ['bitcoin'];  // for example, accept payments in bitcoin, bitcoincash, litecoin, dash, speedcoin

        // Create record for each your coin - https://gourl.io/editrecord/coin_boxes/0 ; and get free gourl keys
        // It is not bitcoin wallet private keys! Place GoUrl Public/Private keys below for all coins which you accept


//        $all_keys = array(
//            "bitcoin"  =>
//                array(
//                    "public_key" => "37905AAMU6s6Bitcoin77BTCPUBvcBJk5qAm8oayz3MwFYeh6L",
//                    "private_key" => "37905AAMU6s6Bitcoin77BTCPRVaGHpTpmfrIrnSZBdhLIISVz"
//                )
//        );


        // Demo Keys; for tests	(example - 5 coins)
        $all_keys = array(
            "bitcoin" => array(
                "public_key" => "37917AAhw0Q9Speedcoin77SPDPUBUR2avCPSe9Rbpq8pX41HD",
                "private_key" => "37917AAhw0Q9Speedcoin77SPDPRVxAI38mYYRe0eD3JKPEwvW"
            )
        );


        //  IMPORTANT: Add in file /lib/cryptobox.config.php your database settings and your gourl.io coin private keys (need for Instant Payment Notifications) -
        /* if you use demo keys above, please add to /lib/cryptobox.config.php -
            $cryptobox_private_keys = array("25654AAo79c3Bitcoin77BTCPRV0JG7w3jg0Tc5Pfi34U8o5JE",
                        "25656AAeOGaPBitcoincash77BCHPRV8quZcxPwfEc93ArGB6D", "25657AAOwwzoLitecoin77LTCPRV7hmp8s3ew6pwgOMgxMq81F",
                        "25658AAo79c3Dash77DASHPRVG7w3jg0Tc5Pfi34U8o5JEiTss", "20116AA36hi8Speedcoin77SPDPRVNOwjzYNqVn4Sn5XOwMI2c",
                        "36306AAQUmatBitcoinsv77BSVPRVJQJx21y8kvd7xxEWzK3zA");
             Also create table "crypto_payments" in your database, sql code - https://github.com/cryptoapi/Payment-Gateway#mysql-table
             Instruction - https://gourl.io/api-php.html
         */




        // Re-test - all gourl public/private keys
        $def_coin = strtolower($def_coin);
        if (!in_array($def_coin, $coins)) $coins[] = $def_coin;
        foreach($coins as $v)
        {

            if (!isset($all_keys[$v]["public_key"]) || !isset($all_keys[$v]["private_key"])){

                die("Please add your public/private keys for '$v' in \$all_keys variable");
            }
            elseif (!strpos($all_keys[$v]["public_key"], "PUB")){
                die("Invalid public key for '$v' in \$all_keys variable");
            }
            elseif (!strpos($all_keys[$v]["private_key"], "PRV")) {

                die("Invalid private key for '$v' in \$all_keys variable");

            }
            elseif (strpos(CRYPTOBOX_PRIVATE_KEYS, $all_keys[$v]["private_key"]) === false){

                die("Please add your private key for '$v' in variable \$cryptobox_private_keys, file /lib/cryptobox.config.php.");
            }
        }

        // Current selected coin by user
        $coinName = cryptobox_selcoin($coins, $def_coin);
        // Current Coin public/private keys
        $public_key  = $all_keys[$coinName]["public_key"];
        $private_key = $all_keys[$coinName]["private_key"];
        /** PAYMENT BOX **/
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

        // Initialise Payment Class
        $box = new Cryptobox ($options);
//        $trans = new Transaction();
//        $trans->order_id = $orderID;
//        $trans->user_id = Auth::guard('user')->id();
//        $trans->txConfirmed = 0;
//        try{
//
//
//        }catch (\Exception $exception){
//            $trans->country = 'FR';
//        }
//        $trans->amount = $amount;
//        $trans->amount_usd = $request->hash * Config::get('const.hashPowerUsd');
//        $trans->save();

            $hash = new BitHash();
            $hash->hash = $request->hash;
            $hash->user_id = Auth::guard('user')->id();
            $hash->order_id = $orderID;
            $hash->confirmed = false;
            $hash->life = 2;
            $hash->save();

        session()->put('paymentData',['box'=>$box,'coins'=>$coins,'def_coin'=>$def_coin,'def_language'=>$def_language]);
        return redirect()->route('payment');
    }

    /*
     * checks if latest payments are confirmed or not by using API
     */
    public function confirmPayment(Request $request){

        if(!$request->has('orderid')){

            return 'Cant find transaction !';
        }

        $trans = DB::table('crypto_payments')->where('orderID',$request->orderid)->first();

        if(is_null($trans)){

            return 'Transaction not found';
        }

        $all_keys = array(
            "bitcoin" => array(
                "public_key" => "37917AAhw0Q9Speedcoin77SPDPUBUR2avCPSe9Rbpq8pX41HD",
                "private_key" => "37917AAhw0Q9Speedcoin77SPDPRVxAI38mYYRe0eD3JKPEwvW"
            )
        );
        $orderID = $trans->orderID;
        $userFormat = 'SESSION';
        $userID = $trans->userID;
        $amount = $trans->amount;
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

            DB::table('crypto_payments')->where('orderID',$request->orderid)->update(['txConfirmed'=>1]);
            // send email to user that transaction has been confirmed
            // change transaction status in admin panel
            return 1;
        }else{

            return 0;
        }



    }
    public function payment(){

        if(!session()->has('paymentData')){

            return 'Invalid Transaction';
        }
        return view('payment.makePayment');
    }

    public function paymentCallback(){



        if(!defined("CRYPTOBOX_WORDPRESS")) define("CRYPTOBOX_WORDPRESS", false);

// a. check if private key valid
        $valid_key = false;
        if (isset($_POST["private_key_hash"]) && strlen($_POST["private_key_hash"]) == 128 && preg_replace('/[^A-Za-z0-9]/', '', $_POST["private_key_hash"]) == $_POST["private_key_hash"])
        {
            $keyshash = array();
            $arr = explode("^", CRYPTOBOX_PRIVATE_KEYS);
            foreach ($arr as $v) $keyshash[] = strtolower(hash("sha512", $v));
            if (in_array(strtolower($_POST["private_key_hash"]), $keyshash)) $valid_key = true;
        }


// b. alternative - ajax script send gourl.io json data
        if (!$valid_key && isset($_POST["json"]) && $_POST["json"] == "1")
        {
            $data_hash = $boxID = "";
            if (isset($_POST["data_hash"]) && strlen($_POST["data_hash"]) == 128 && preg_replace('/[^A-Za-z0-9]/', '', $_POST["data_hash"]) == $_POST["data_hash"]) { $data_hash = strtolower($_POST["data_hash"]); unset($_POST["data_hash"]); }
            if (isset($_POST["box"]) && is_numeric($_POST["box"]) && $_POST["box"] > 0) $boxID = intval($_POST["box"]);

            if ($data_hash && $boxID)
            {
                $private_key = "";
                $arr = explode("^", CRYPTOBOX_PRIVATE_KEYS);
                foreach ($arr as $v) if (strpos($v, $boxID."AA") === 0) $private_key = $v;

                if ($private_key)
                {
                    $data_hash2 = strtolower(hash("sha512", $private_key.json_encode($_POST).$private_key));
                    if ($data_hash == $data_hash2) $valid_key = true;
                }
                unset($private_key);
            }

            if (!$valid_key) die("Error! Invalid Json Data sha512 Hash!");

        }


// c.
        if ($_POST) foreach ($_POST as $k => $v) if (is_string($v)) $_POST[$k] = trim($v);



// d.
        if (isset($_POST["plugin_ver"]) && !isset($_POST["status"]) && $valid_key)
        {
            echo "cryptoboxver_" . (CRYPTOBOX_WORDPRESS ? "wordpress_" . GOURL_VERSION : "php_" . CRYPTOBOX_VERSION);
            die;
        }


// e.
        if (isset($_POST["status"]) && in_array($_POST["status"], array("payment_received", "payment_received_unrecognised")) &&
            $_POST["box"] && is_numeric($_POST["box"]) && $_POST["box"] > 0 && $_POST["amount"] && is_numeric($_POST["amount"]) && $_POST["amount"] > 0 && $valid_key)
        {

            foreach ($_POST as $k => $v)
            {
                if ($k == "datetime") 						$mask = '/[^0-9\ \-\:]/';
                elseif (in_array($k, array("err", "date", "period")))		$mask = '/[^A-Za-z0-9\.\_\-\@\ ]/';
                else								$mask = '/[^A-Za-z0-9\.\_\-\@]/';
                if ($v && preg_replace($mask, '', $v) != $v) 	$_POST[$k] = "";
            }

            if (!$_POST["amountusd"] || !is_numeric($_POST["amountusd"]))	$_POST["amountusd"] = 0;
            if (!$_POST["confirmed"] || !is_numeric($_POST["confirmed"]))	$_POST["confirmed"] = 0;


            $dt			= gmdate('Y-m-d H:i:s');
            $obj 		= run_sql("select paymentID, txConfirmed from crypto_payments where boxID = ".$_POST["box"]." && orderID = '".$_POST["order"]."' && userID = '".$_POST["user"]."' && txID = '".$_POST["tx"]."' && amount = ".$_POST["amount"]." && addr = '".$_POST["addr"]."' limit 1");


            $paymentID		= ($obj) ? $obj->paymentID : 0;
            $txConfirmed	= ($obj) ? $obj->txConfirmed : 0;

            // Save new payment details in local database
            if (!$paymentID)
            {
                $sql = "INSERT INTO crypto_payments (boxID, boxType, orderID, userID, countryID, coinLabel, amount, amountUSD, unrecognised, addr, txID, txDate, txConfirmed, txCheckDate, recordCreated)
				VALUES (".$_POST["box"].", '".$_POST["boxtype"]."', '".$_POST["order"]."', '".$_POST["user"]."', '".$_POST["usercountry"]."', '".$_POST["coinlabel"]."', ".$_POST["amount"].", ".$_POST["amountusd"].", ".($_POST["status"]=="payment_received_unrecognised"?1:0).", '".$_POST["addr"]."', '".$_POST["tx"]."', '".$_POST["datetime"]."', ".$_POST["confirmed"].", '$dt', '$dt')";

                $paymentID = run_sql($sql);

                $box_status = "cryptobox_newrecord";
            }
            // Update transaction status to confirmed
            elseif ($_POST["confirmed"] && !$txConfirmed)
            {
                $sql = "UPDATE crypto_payments SET txConfirmed = 1, txCheckDate = '$dt' WHERE paymentID = $paymentID LIMIT 1";
                run_sql($sql);

                $box_status = "cryptobox_updated";
            }
            else
            {
                $box_status = "cryptobox_nochanges";
            }


            /**
             *  User-defined function for new payment - cryptobox_new_payment(...)
             *  For example, send confirmation email, update database, update user membership, etc.
             *  You need to modify file - cryptobox.newpayment.php
             *  Read more - https://gourl.io/api-php.html#ipn
             */

            if (in_array($box_status, array("cryptobox_newrecord", "cryptobox_updated")) && function_exists('cryptobox_new_payment')) cryptobox_new_payment($paymentID, $_POST, $box_status);
        }

        else
            $box_status = "Only POST Data Allowed";


        echo $box_status; // don'
    }
/*
 * this function will executed after callback function
 */
    public function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = ""){




        if($payment_details['confirmed'] == 1){

            $hashPower = BitHash::where('order_id',$paymentID)->first();

            $hashPower->update(['confirmed'=>1]);

            Mail::send('thanks',[],function($message){
                $message->from ('Admin@HashBazaar');
                $message->to ('sahand.mg.ne@gmail.com');
                $message->subject ('Subscription Email');
            });
        }

        /** .............
        .............

         *
        PLACE YOUR CODE HERE

        Update database with new payment, send email to user, etc
        Please note, all received payments store in your table `crypto_payments` also
        See - https://gourl.io/api-php.html#payment_history
        .............
        .............
        For example, you have own table `user_orders`...
        You can use function run_sql() from cryptobox.class.php ( https://gourl.io/api-php.html#run_sql )

        .............
        // Save new Bitcoin payment in database table `user_orders`
        $recordExists = run_sql("select paymentID as nme FROM `user_orders` WHERE paymentID = ".intval($paymentID));
        if (!$recordExists) run_sql("INSERT INTO `user_orders` VALUES(".intval($paymentID).",'".$payment_details["user"]."','".$payment_details["order"]."',".floatval($payment_details["amount"]).",".floatval($payment_details["amountusd"]).",'".$payment_details["coinlabel"]."',".intval($payment_details["confirmed"]).",'".$payment_details["status"]."')");

        .............
        // Received second IPN notification (optional) - Bitcoin payment confirmed (6+ transaction confirmations)
        if ($recordExists && $box_status == "cryptobox_updated")  run_sql("UPDATE `user_orders` SET txconfirmed = ".intval($payment_details["confirmed"])." WHERE paymentID = ".intval($paymentID));
        .............
        .............

        // Onetime action when payment confirmed (6+ transaction confirmations)
        $processed = run_sql("select processed as nme FROM `crypto_payments` WHERE paymentID = ".intval($paymentID)." LIMIT 1");
        if (!$processed && $payment_details["confirmed"])
        {
        // ... Your code ...

        // ... and update status in default table where all payments are stored - https://github.com/cryptoapi/Payment-Gateway#mysql-table
        $sql = "UPDATE crypto_payments SET processed = 1, processedDate = '".gmdate("Y-m-d H:i:s")."' WHERE paymentID = ".intval($paymentID)." LIMIT 1";
        run_sql($sql);
        }

        .............

         */

        // Debug - new payment email notification for webmaster
        // Uncomment lines below and make any test payment
        // --------------------------------------------
        // $email = "....your email address....";
        // mail($email, "Payment - " . $paymentID . " - " . $box_status, " \n Payment ID: " . $paymentID . " \n\n Status: " . $box_status . " \n\n Details: " . print_r($payment_details, true));




        return true;

    }

}
