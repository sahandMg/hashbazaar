<?php
/**
 * Created by PhpStorm.
 * User: Sahand
 * Date: 5/12/19
 * Time: 4:58 PM
 */

namespace App\HashPaymentTest;


use App\BitHash;
use App\CustomCode;
use App\Mining;
use App\Referral;
use App\Setting;
use App\Sharing;
use App\Transaction;
use App\User;
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

        if($plan == 3){

            $amount = ($settings->usd_per_hash * $hash * (1- $discount)  + env('contractDays') * $settings->maintenance_fee_per_th_per_day) * $dollarPriceInToman;
        }else if($plan == 2){

            $amount = $settings->usd_per_hash * $hash * (1- $discount) * $dollarPriceInToman;
        }
        $referralCode = $this->request['code'];


                // create database record
                $custom_code = CustomCode::where('code',$referralCode)->first();
                $hashRecord = new BitHash();
                $hashRecord->hash = $hash;
                $hashRecord->user_id = Auth::guard('user')->id();
                $hashRecord->order_id = strtoupper('zarrin_'.str_random(8));
                $hashRecord->confirmed = 0;
                // a custom code is not involved in affiliate
                if(isset($custom_code)){
                    $hashRecord->referral_code = null;
                }else{
                    $hashRecord->referral_code = $referralCode;
                }
                $hashRecord->life = $settings->hash_life;
                $hashRecord->remained_day = Carbon::now()->diffInDays(Carbon::now()->addYears($hashRecord->life));
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
                $trans->authority = "TEST__000000000000000000210312000000".rand(0,100);
                $trans->save();
                session(['authority'=> $trans->authority]);
                return 200;



    }

    public function verify(){

        $transactionId = session('authority');
        $trans = Transaction::where('authority',$transactionId)->first();
        if(is_null($trans)){
            return 'کد تراکنش نادرست است';
        }
        $settings = Setting::first();

        $this->ZarrinPaymentConfirm($trans);

        return redirect()->route('RemotePaymentSuccess',['locale'=>App::getLocale(),'transid'=>$trans->code]);

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
            'plan_id'=> Session::get('planId')
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
            $message->from('Admin@HashBazaar');
            $message->to($user->email);
            $message->subject('Payment Confirmed');
        });

        Mail::send('email.newTrans', [], function ($message) use ($user) {
            $message->from('Admin@HashBazaar');
            $message->to('Admin@HashBazaar');
            $message->subject('New Payment');
        });
    }

}
