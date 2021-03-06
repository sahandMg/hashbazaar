<?php
/**
 * Created by PhpStorm.
 * User: Sahand
 * Date: 5/12/19
 * Time: 4:58 PM
 */

namespace App;


use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ZarrinPal
{
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    protected $connection = 'mysql';

    public function create(){

        $settings = Setting::first();
        $dollarPriceInToman = $settings->usd_toman;
        $discount = $this->request['discount'];
        $hash = $this->request['hash'];
        $plan = $this->request['plan'];

        if($plan == 2){

//            $amount = ($settings->usd_per_hash * $hash * (1- $discount)  + env('contractDays') * $settings->maintenance_fee_per_th_per_day) * $dollarPriceInToman;
            $amount = str_replace(',','',env('hash_toman_classic')) * $hash * (1- $discount);
        }else if($plan == 3){

//            $amount = $settings->usd_per_hash * $hash * (1- $discount) * $dollarPriceInToman;
            $amount = str_replace(',','',env('hash_toman_zero')) * $hash * (1- $discount);
        }
        $referralCode = $this->request['code'];

        $data = array('MerchantID' => $settings->zarrin_pin,
            'Amount' => $amount,
            'Email' => Auth::guard('user')->user()->email,
            'CallbackURL' => 'https://hashbazaar.com/fa/zarrin/callback?token='.Auth::guard('user')->user()->verifyUser->token,
            'Description' => 'هش بازار، استخراج ابری بیتکوین');
        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        if ($err) {
            return 404;
        } else {
            if ($result["Status"] == '100' ) {

                // create database record
                $custom_code = CustomCode::where('code',$referralCode)->first();
                $hashRecord = new BitHash();
                $hashRecord->hash = $hash;
                $hashRecord->user_id = Auth::guard('user')->id();
                $hashRecord->order_id = strtoupper('zarrin_'.str_random(8));
                $hashRecord->plan_id = $plan;
                $hashRecord->confirmed = 0;
                // a custom code is not involved in affiliate
                if(isset($custom_code)){
                    $hashRecord->referral_code = null;
                }else{
                    $hashRecord->referral_code = $referralCode;
                }
                $hashRecord->life = env('contract_time');
                $hashRecord->remained_day = Carbon::now()->diffInDays(Carbon::now()->addDays($hashRecord->life));
                $hashRecord->save();


                $mining = new Mining();
                $mining->mined_btc = 0;
                $mining->mined_usd = 0;
                $mining->user_id = Auth::guard('user')->id();
                $mining->order_id = $hashRecord->order_id;
                $mining->block = 1;
                $mining->save();

                $trans = new Transaction();
                $trans->code = $hashRecord->order_id;
                $trans->status = 'unpaid';
                $trans->amount_toman = $amount;
                $trans->user_id = Auth::guard('user')->id();
                $trans->checkout = 'out';
                $trans->country = Auth::guard('user')->user()->country;
                $trans->authority = $result['Authority'];
                $trans->save();

                return $result;
            } else {
                return 404;
            }
        }

    }

    public function verify(){

        $transactionId = $this->request->Authority;
        $trans = Transaction::where('authority',$transactionId)->first();
        if(is_null($trans)){
            return 'کد تراکنش نادرست است';
        }
        $settings = Setting::first();

        $data = array('MerchantID' => $settings->zarrin_pin, 'Authority' => $transactionId, 'Amount'=>$trans->amount_toman);

        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            if ($result['Status'] == '100') {

                $this->ZarrinPaymentConfirm($trans);

                return redirect()->route('PaymentSuccess',['locale'=>App::getLocale()]);

            } else {
                return redirect()->route('PaymentCanceled', ['locale'=>App::getLocale(),'transid' => $trans->code]);
            }
        }
    }
    private function ZarrinPaymentConfirm($trans)
    {

        $transactionId = $trans->code;
        $user = $trans->user;
        $orderID = $transactionId;
        $hashPower = BitHash::where('order_id', $orderID)->first();
        $mining = Mining::where('order_id', $orderID)->first();
        $settings = Setting::first();
        $hashPower->update(['confirmed' => 1]);
        $hashPower->save();
        $mining->update(['block' => 0]);
        $mining->save();
        // update created transaction record
        DB::connection('mysql')->table('transactions')->where('code', $orderID)->update([
            'country' => $user->country,
            'status' => 'paid'
        ]);
        $settings->update(['available_th' => $settings->available_th - $hashPower->hash]);
        $settings->save();

//                $referralUser = DB::connection('mysql')->table('expired_codes')->where('user_id',$user->id)->where('used',0)->first();
        $referralCode = $hashPower->referral_code;
        $referralQuery = Referral::where('code', $referralCode)->first();
        DB::connection('mysql')->table('plan_user')->insert([
            'user_id'=> Auth::guard('user')->id(),
            'plan_id'=> Session::get('planId'),
            'created_at'=>Carbon::now()
        ]);
        DB::connection('mysql')->table('user_shares')->insert([
            'user_id'=> Auth::guard('user')->id(),
            'share'=> env('default_profit'),
            'code'=>$hashPower->order_id,
            'plan_id'=> $this->request->plan,
            'created_at'=>Carbon::now()
        ]);
        // if any referral code used for hash owner purchasing
        if (!is_null($referralCode)) {

            $codeCaller = User::where('code', $referralCode)->first();// code caller user
            /*
             * reward new th to the code caller
             * ============================
             * increasing share level
             */

            $sharings = Sharing::all()->toArray();
            $total_sharing_num = $referralQuery->total_sharing_num;

            for ($i = 0; $i < count($sharings); $i++) {

                if ($sharings[$i]['sharing_number'] < $total_sharing_num) {

                    if ($i == count($sharings) - 1) {

                        $referralQuery->update([
                            'share_level' => $sharings[$i]['level']
                        ]);
                        $referralQuery->save();
                    } else {
                        $referralQuery->update([
                            'share_level' => $sharings[$i + 1]['level']
                        ]);
                        $referralQuery->save();
                    }

                }
            }

            $share_level = $referralQuery->share_level;
            $share_value = DB::connection('mysql')->table('sharings')->where('level', $share_level)->first()->value;
            $hash = new BitHash();
            $hash->hash = $hashPower->hash * $share_value;
            $hash->user_id = $codeCaller->id;
            $hash->order_id = 'referral';
            $hash->confirmed = 1;
            $hash->life = $settings->hash_life;
            $hash->remained_day = Carbon::now()->diffInDays(Carbon::now()->addYears($hash->life));
            $hash->save();
            $mining = new Mining();
            $mining->mined_btc = 0;
            $mining->mined_usd = 0;
            $mining->user_id = $codeCaller->id;
            $mining->order_id = 'referral';
            $mining->block = 0;
            $mining->save();
        }

        Mail::send('email.paymentConfirmed', ['hashPower' => $hashPower, 'trans' => $trans], function ($message) use ($user) {
            $message->from(env('Admin_Mail'));
            $message->to($user->email);
            $message->subject('Payment Confirmed');
        });

        Mail::send('email.newTrans', [], function ($message) use ($user) {
            $message->from(env('Admin_Mail'));
            $message->to(env('Admin_Mail'));
            $message->subject('New Payment');
        });
    }

}
