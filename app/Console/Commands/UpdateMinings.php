<?php

namespace App\Console\Commands;

use App\Antpool;
use App\BitCoinPrice;
use App\BitHash;
use App\Events\Sms;
use App\F2pool;
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

    private function balances($f2poolResp){

        // getting realtime bitcoin price
        $settings = Setting::first();
//        $options = array('http' => array('method' => 'GET'));
//        $context = stream_context_create($options);
//        $contents = file_get_contents('https://www.blockonomics.co/api/price?currency=USD', false, $context);
        $instant = new BitCoinPrice();
        $bitCoinPrice = $instant->getPrice();
//        if ($bitCoinPrice->price == 0) {
//
//            return 'bitcoin api failed';
//        }
        $users = User::all();
        $mainTHash = $settings->total_th;
        $RealTHash = number_format($f2poolResp['hashes_last_day'] / 86400 / pow(10, 12), 3);
        // ============================
        $todayTHash = $RealTHash ;
        // ============================
        $miningValue = number_format($f2poolResp['value_last_day'], 8);
        $mining24 = $miningValue * $todayTHash / $RealTHash;
        $updateFlag = 0;
        $todayProfit = 0;

        foreach ($users as $index => $user) {
            $hashes = BitHash::where('user_id', $user->id)->where('confirmed', 1)->get();
            if (!$hashes->isEmpty()) {
                foreach ($hashes as $item => $hash) {
                    // checks if contract is over or not
                    if ($hash->remained_day == 0) {
                        $hash->update(['confirmed' => 0]);
                        $hash->save();
                        DB::connection('mysql')->table('minings')->where('order_id', $hash->order_id)->update(['block' => 1]);
                    } else {
                        // 30 70 contracts have no ending
                        if ($user->plan_id == 1) {
                            $remainedDay = 720;
                        } else {

                            $remainedDay = Carbon::now()->diffInDays(Carbon::parse($hash->created_at)->addYears($hash->life));
                        }

                        $hash->update(['remained_day' => $remainedDay]);
                        $hash->save();
                        $hashPower[$item] = $hash->hash;
                        $maintenance_inBTC = $settings->maintenance_fee_per_th_per_day / $bitCoinPrice * $hashPower[$item];
                        if ($mining24 != 0) {
                            // keeps extra bitcoins for hashbazaar
                            if ($todayTHash >= $mainTHash) {
                                // update hashbazaar benefit
                                if($updateFlag == 0){

                                    $settings->update(['total_benefit'=> $settings->total_benefit +
                                        $mining24 * (1 - $mainTHash / $todayTHash ) +
                                        0.3 * $mining24 * ($mainTHash / $todayTHash) ]);
                                    $todayProfit = number_format($mining24 * (1 - $mainTHash / $todayTHash ) + 0.3 * $mining24 * ($mainTHash / $todayTHash),8);
                                    $updateFlag = 1;
                                }

                                $mining24 = $mining24 * $mainTHash / $todayTHash;
                            }
                            // if today th is less than main th
                            elseif ($updateFlag == 0){
                                // reducing our benefit and keeping the change for the users
                                $compensationValue = $mining24 * ($mainTHash / $todayTHash - 1);
                                $settings->update(['total_benefit'=> number_format($settings->total_benefit +
                                    0.3 * $mining24 - $compensationValue,8)  ]);
                                $todayProfit = number_format( 0.3 * $mining24 - $compensationValue,8);
                                $updateFlag = 1;
                                // boost real mining value up when main th is more than today th
                                $mining24 = $mining24 + $compensationValue;
                            }
                            // apply 30 70 contracts conditions
                            if ($user->plan_id == 1) {
                                $userEarn[$item] = $mining24 * ($hashPower[$item] / $mainTHash) * 0.7;
                            } elseif ($user->plan_id == 2) {

                                $userEarn[$item] = $mining24 * ($hashPower[$item] / $mainTHash) - $maintenance_inBTC;
                            } elseif ($user->plan_id == 3) {

                                $userEarn[$item] = $mining24 * ($hashPower[$item] / $mainTHash);
                            }
                        }
                    }

                }
                $minings = Mining::where('user_id', $user->id)->where('block', 0)->orderBy('id', 'desc')->get();
                if (!$minings->isEmpty()) {
                    foreach ($minings as $key => $mining) {
                        if ($mining->block == 0) {
                            $userEarn[$key] = number_format($userEarn[$key], 8);
                            $miningReport = new MiningReport();
                            $miningReport->order_id = $mining->order_id;
                            $miningReport->mined_btc = $userEarn[$key];
                            $miningReport->mined_usd = $userEarn[$key] * $bitCoinPrice;
                            $miningReport->user_id = $user->id;
                            $miningReport->created_at = Carbon::now()->subDay(1);
                            $miningReport->updated_at = Carbon::now()->subDay(1);
                            $miningReport->save();


                            $mining->update(['mined_btc' => $userEarn[$key] + $mining->mined_btc, 'mined_usd' => $mining->mined_usd + $userEarn[$key] * $bitCoinPrice]);
                            $mining->save();
                            // creating new record in database for tomorrow mining record

                        }
                    }
                }
                $total_paid_btc = Transaction::where('user_id', $user->id)->where('status', 'paid')->where('checkout', 'in')->sum('amount_btc');
                $user->update(['total_mining' => $minings->sum('mined_btc'), 'pending' => $minings->sum('mined_btc') - $total_paid_btc]);
                $user->save();
            }
        }


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
        // resetting alarm counter every day
        Cache::forever('alarmNumber',0);

        $message = $message = "گزارش استخراج " . Jalalian::forge(Carbon::now())->toString()
            . ' ماینینگ' . $hashRate->mined_btc
            . ' سختی ' . $hashRate->difficulty
            .' میانگین تراهش '. $todayTHash
            . ' سود امروز '.$todayProfit
            . ' سود کل '.number_format($settings->total_benefit,8) ;
        Sms::dispatch($message);
    }
}
