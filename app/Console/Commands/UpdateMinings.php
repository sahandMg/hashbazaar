<?php

namespace App\Console\Commands;

use App\Pools\Antpool;
use App\BitCoinPrice;
use App\BitHash;
use App\Events\Sms;
use App\Pools\F2pool;
use App\Mining;
use App\MiningReport;
use App\Setting;
use App\Transaction;
use App\User;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Morilog\Jalali\Jalalian;
use Psr\Http\Message\ResponseInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateMinings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mining:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update User Mining';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     *
     * This Command update mining histories & hashPower life
     */
    public function handle()
    {

// getting total minings from antpool
//
//        $instance = new Antpool();
//        $resp = $instance->run();

//  Getting minings from f2pool

        $instance = new F2pool();
        $resp = $instance->run();
        if($resp['code'] != 200){
            if(!Cache::has('poolError')){
                Cache::forever('poolError',0);
            }else{
                Cache::forever('poolError',Cache::get('poolError') + 1);
            }
            if(Cache::get('poolError') >= 3){

             $message =" خطای پول".$resp['message'];
            Sms::dispatch($message);

            }else{
                echo Cache::get('poolError');
                Artisan::call('mining:update');
            }
        }else{
            Cache::forever('poolError',0);
            $this->balances($resp['message']);
        }
    }
// use this for regular mining plan
    private function balances2($f2poolResp){

        $settings = Setting::first();
        $instant = new BitCoinPrice();
        $bitCoinPrice = $instant->getPrice();
        $todayTHash = number_format($f2poolResp['hashes_last_day'] / 86400 / pow(10, 12), 3);
        $miningValue = number_format($f2poolResp['value_last_day'], 8);
        if(Cache::get('power_off') == 1){
            $mainTh = $todayTHash;
        }else{
            $mainTh = $settings->total_th;
        }
        if($todayTHash >= $mainTh){
            // keep extra mining for hashbazaar
            $portion =  $mainTh / $todayTHash;
            $extraProfit = $miningValue * (1 -  $portion);
            $profit = 0.3 * $portion * $miningValue;

            $todayProfit = number_format($extraProfit + $profit,8);
            $settings->update(['total_benefit'=> $todayProfit + $settings->total_benefit ]);
            $mining24 = number_format($miningValue * $portion,8);
        }else{

            $portion =  $mainTh / $todayTHash;
            $damage = $miningValue * (1 -  $portion);
            $todayProfit = number_format(0.3 *  $miningValue + $damage,8);
            $settings->update(['total_benefit'=> $todayProfit + $settings->total_benefit ]);
            $mining24 = number_format($miningValue * $portion,8);
        }
        $users = User::where('block',0)->get();
        foreach ($users as $key => $user ){
            if(count($user->bithashes->all()) > 0){
                $hashRates = $user->bithashes->where('confirmed',1)->all();
                foreach (collect($hashRates) as $index => $hashRate){

                    if ($hashRate->remained_day == 0) {
                        $hashRate->update(['confirmed' => 0]);
                        $hashRate->save();
                        DB::connection('mysql')->table('minings')->where('order_id', $hashRate->order_id)->update(['block' => 1]);
                    } else {
                        // 30 70 contracts have no ending
//                        if ($user->plan_id == 1) {
//                            $remainedDay = 720;
//                            $hashRate->update(['remained_day' => $remainedDay]);
//                            $hashRate->save();
//                        } else {
//
//                            $remainedDay = Carbon::now()->diffInDays(Carbon::parse($hashRate->created_at)->addYears($hashRate->life));
//                            $hashRate->update(['remained_day' => $remainedDay]);
//                            $hashRate->save();
//                        }
                        $remainedDay = Carbon::now()->diffInDays(Carbon::parse($hashRate->created_at)->addYears($hashRate->life));
                        $hashRate->update(['remained_day' => $remainedDay]);
                        $hashRate->save();
                    }

                    $userPortion = $hashRate->hash/ $settings->total_th;
                    // check user plansId
                    $plans = $user->plans;
                    if(count($user->plans->toArray()) > 0 ){
//                        foreach($plans as $key => $plan){

                        if($hashRate->plan->id == 1){

                            $userEarn[$index] = $userPortion * $mining24 * 0.7;
                        }
                        if($hashRate->plan->id == 2){
                            $maintenance_inBTC = $settings->maintenance_fee_per_th_per_day / $bitCoinPrice * $hashRate->hash;

                            $userEarn[$index] = $mining24 * $userPortion - $maintenance_inBTC;
                        }
                        if($hashRate->plan->id == 3 ){

                            $userEarn[$index] = $mining24 * $userPortion;
                        }
                        if($hashRate->plan->id == 4 ){

                            $userEarn[$index] = $mining24 * $userPortion;
                        }

                        try{
                            $mining = Mining::where('order_id', $hashRate->order_id)->where('block', 0)->first();
                            if (!is_null($mining)) {
                                if ($mining->block == 0) {
                                    $userEarn[$index] = number_format($userEarn[$index], 8);
                                    $miningReport = new MiningReport();
                                    $miningReport->order_id = $mining->order_id;
                                    $miningReport->mined_btc = $userEarn[$index];
                                    $miningReport->mined_usd = $userEarn[$index] * $bitCoinPrice;
                                    $miningReport->user_id = $user->id;
                                    $miningReport->created_at = Carbon::now()->subDay(1);
                                    $miningReport->updated_at = Carbon::now()->subDay(1);
                                    $miningReport->save();
                                    $mining->update(['mined_btc' => $userEarn[$index] + $mining->mined_btc, 'mined_usd' => $mining->mined_usd + $userEarn[$index] * $bitCoinPrice]);
                                    $mining->save();
                                    // creating new record in database for tomorrow mining record
                                }
                            }
                            $total_paid_btc = Transaction::where('user_id', $user->id)->where('status', 'paid')->where('checkout', 'in')->sum('amount_btc');
                            $user->update(['total_mining' => number_format($user->total_mining + $userEarn[$index],8), 'pending' => number_format($user->total_mining + $userEarn[$index] - $total_paid_btc,8)]);
                            $user->save();
                        }catch (\Exception $exception){

                        }
                    }
                }

            }
        }
//        }

        /*
      * Stores last day hash rate & mined btc + blockchain difficulty & block reward
      */

        $url = "https://api-r.bitcoinchain.com/v1/status?_ga=2.23156472.371952348.1559114831-275280855.1559114831";
        $client = new GuzzleClient();
        $promise1 = $client->requestAsync('GET', $url)->then(function (ResponseInterface $response) {
            return $response->getBody()->getContents();
        });
        $resp = $promise1->wait();
        $newResp = json_decode($resp, true);
        $hashRate = new \App\hashRate();
        $hashRate->mined_btc = $miningValue;
        $hashRate->difficulty = intval($newResp['difficulty'] / (pow(10, 9)));
        $hashRate->block_reward = $newResp['reward'];
        $hashRate->hash_rate = $todayTHash;
        $hashRate->today_benefit = $todayProfit;
        $hashRate->created_at = Carbon::createFromTimestamp($newResp['time'])->addDay(-1)->toDateTimeString();
        $hashRate->save();

        $settings->update(['total_mining'=> $settings->total_mining + $miningValue]);

// -------------------------
        // resetting alarm counter and power off check, every day
        Cache::forever('alarmNumber',0);
        Cache::forever('power_off',0);

        $message = $message = "گزارش استخراج " . Jalalian::forge(Carbon::now())->toString()
            . ' ماینینگ' . $hashRate->mined_btc
            . ' سختی ' . $hashRate->difficulty
            .' میانگین تراهش '. $todayTHash
            . ' سود امروز '.$todayProfit
            . ' سود کل '.number_format($settings->total_benefit,8) ;
        Sms::dispatch($message);
    }
// use this for regular bitcoin as mining plan
    private function balances($f2poolResp){

        $settings = Setting::first();
        $instant = new BitCoinPrice();
        $bitCoinPrice = $instant->getPrice();
        $todayTHash = number_format($f2poolResp['hashes_last_day'] / 86400 / pow(10, 12), 3);
        $miningValue = number_format($f2poolResp['value_last_day'], 8);
        if(Cache::get('power_off') == 1){
            $mainTh = $todayTHash;
        }else{
            $mainTh = $settings->total_th;
        }
        if($todayTHash >= $mainTh){
            // keep extra mining for hashbazaar
            $portion =  $mainTh / $todayTHash;
            $extraProfit = $miningValue * (1 -  $portion);
            $profit = 0.3 * $portion * $miningValue;

            $todayProfit = number_format($extraProfit + $profit,8);
            $settings->update(['total_benefit'=> $todayProfit + $settings->total_benefit ]);
            $mining24 = number_format($miningValue * $portion,8);
        }else{

            $portion =  $mainTh / $todayTHash;
            $damage = $miningValue * (1 -  $portion);
            $todayProfit = number_format(0.3 *  $miningValue + $damage,8);
            $settings->update(['total_benefit'=> $todayProfit + $settings->total_benefit ]);
            $mining24 = number_format($miningValue * $portion,8);
        }
        $users = User::where('block',0)->get();
        foreach ($users as $key => $user ){
            if(count($user->bithashes->all()) > 0){
                $hashRates = $user->bithashes->where('confirmed',1)->all();
                foreach (collect($hashRates) as $index => $hashRate){

                    if ($hashRate->remained_day == 0) {
                        $hashRate->update(['confirmed' => 0]);
                        $hashRate->save();
                        DB::connection('mysql')->table('minings')->where('order_id', $hashRate->order_id)->update(['block' => 1]);
                    } else {
                        // 30 70 contracts have no ending
//                        if ($user->plan_id == 1) {
//                            $remainedDay = 720;
//                            $hashRate->update(['remained_day' => $remainedDay]);
//                            $hashRate->save();
//                        } else {
//
//                            $remainedDay = Carbon::now()->diffInDays(Carbon::parse($hashRate->created_at)->addYears($hashRate->life));
//                            $hashRate->update(['remained_day' => $remainedDay]);
//                            $hashRate->save();
//                        }
                        $remainedDay = Carbon::now()->diffInDays(Carbon::parse($hashRate->created_at)->addYears($hashRate->life));
                        $hashRate->update(['remained_day' => $remainedDay]);
                        $hashRate->save();
                    }

                    $userPortion = $hashRate->hash/ $settings->total_th;
                    // check user plansId
                    $plans = $user->plans;
                    if(count($user->plans->toArray()) > 0 ){
//                        foreach($plans as $key => $plan){

                        if($hashRate->plan->id == 1){

                            $userEarn[$index] = $userPortion * $mining24 * 0.7;
                        }
                        if($hashRate->plan->id == 2){

                            $maintenance_inBTC = $mining24 * $userPortion * 0.3;

                            $userEarn[$index] = $mining24 * $userPortion - $maintenance_inBTC;
                        }
                        if($hashRate->plan->id == 3 ){

                            $userEarn[$index] = $mining24 * $userPortion;
                        }
                        if($hashRate->plan->id == 4 ){

                            $userEarn[$index] = $mining24 * $userPortion;
                        }

                        try{
                            $mining = Mining::where('order_id', $hashRate->order_id)->where('block', 0)->first();
                            if (!is_null($mining)) {
                                if ($mining->block == 0) {
                                    $userEarn[$index] = number_format($userEarn[$index], 8);
                                    $miningReport = new MiningReport();
                                    $miningReport->order_id = $mining->order_id;
                                    $miningReport->mined_btc = $userEarn[$index];
                                    $miningReport->mined_usd = $userEarn[$index] * $bitCoinPrice;
                                    $miningReport->user_id = $user->id;
                                    $miningReport->created_at = Carbon::now()->subDay(1);
                                    $miningReport->updated_at = Carbon::now()->subDay(1);
                                    $miningReport->save();
                                    $mining->update(['mined_btc' => $userEarn[$index] + $mining->mined_btc, 'mined_usd' => $mining->mined_usd + $userEarn[$index] * $bitCoinPrice]);
                                    $mining->save();
                                    // creating new record in database for tomorrow mining record
                                }
                            }
                            $total_paid_btc = Transaction::where('user_id', $user->id)->where('status', 'paid')->where('checkout', 'in')->sum('amount_btc');
                            $user->update(['total_mining' => number_format($user->total_mining + $userEarn[$index],8), 'pending' => number_format($user->total_mining + $userEarn[$index] - $total_paid_btc,8)]);
                            $user->save();
                        }catch (\Exception $exception){

                        }
                    }
                }

            }
        }
//        }

        /*
      * Stores last day hash rate & mined btc + blockchain difficulty & block reward
      */

        $url = "https://api-r.bitcoinchain.com/v1/status?_ga=2.23156472.371952348.1559114831-275280855.1559114831";
        $client = new GuzzleClient();
        $promise1 = $client->requestAsync('GET', $url)->then(function (ResponseInterface $response) {
            return $response->getBody()->getContents();
        });
        $resp = $promise1->wait();
        $newResp = json_decode($resp, true);
        $hashRate = new \App\hashRate();
        $hashRate->mined_btc = $miningValue;
        $hashRate->difficulty = intval($newResp['difficulty'] / (pow(10, 9)));
        $hashRate->block_reward = $newResp['reward'];
        $hashRate->hash_rate = $todayTHash;
        $hashRate->today_benefit = $todayProfit;
        $hashRate->created_at = Carbon::createFromTimestamp($newResp['time'])->addDay(-1)->toDateTimeString();
        $hashRate->save();

        $settings->update(['total_mining'=> $settings->total_mining + $miningValue]);

// -------------------------
        // resetting alarm counter and power off check, every day
        Cache::forever('alarmNumber',0);
        Cache::forever('power_off',0);

        $message = $message = "گزارش استخراج " . Jalalian::forge(Carbon::now())->toString()
            . ' ماینینگ' . $hashRate->mined_btc
            . ' سختی ' . $hashRate->difficulty
            .' میانگین تراهش '. $todayTHash
            . ' سود امروز '.$todayProfit
            . ' سود کل '.number_format($settings->total_benefit,8) ;
        Sms::dispatch($message);
    }
}
