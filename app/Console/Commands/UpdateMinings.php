<?php

namespace App\Console\Commands;

use App\BitHash;
use App\Mining;
use App\MiningReport;
use App\Transaction;
use App\User;
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
        // getting realtime bitcoin price
        $settings = DB::table('settings')->first();
        $options = array('http' => array('method' => 'GET'));
        $context = stream_context_create($options);
        $contents = file_get_contents('https://www.blockonomics.co/api/price?currency=USD', false, $context);
        $bitCoinPrice = json_decode($contents);
        if ($bitCoinPrice->price == 0) {

            return 'bitcoin api failed';
        }
// getting total minings from antpool
        $userId = '13741374';
        $apiKey = '7b07bc4b507b4d7584770f8ddddd02f1';
        $nonce = rand(0, 1000);
        $secret = '0585329bf8eb48509b1ad13b709d9390';
        $url = 'https://antpool.com/api/account.htm';
        $signature = strtoupper(hash_hmac('sha256', $userId . $apiKey . $nonce, $secret, false));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url?key=$apiKey&nonce=$nonce&signature=$signature&coin=BTC");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $mining24 = json_decode($result)->data->earn24Hours;
        $users = User::all();
        $mainTHash = $settings->total_th;


        foreach ($users as $index => $user) {
            $hashes = BitHash::where('user_id', $user->id)->where('confirmed',1)->get();
            if (!$hashes->isEmpty()) {
                foreach ($hashes as $item => $hash) {
                    $remainedDay = Carbon::now()->diffInDays(Carbon::parse($hash->created_at)->addYears($hash->life));
                    $hash->update(['remained_day'=>$remainedDay]);
                    $hash->save();
                    $hashPower[$item] = $hash->hash;
                    $userEarn[$item] = $mining24 * ($hashPower[$item] / $mainTHash);
                }
                $minings = Mining::where('user_id',$user->id)->where('block',0)->orderBy('id','desc')->get();
                if(! $minings ->isEmpty()){
                    foreach ($minings as $key => $mining){
                        if($mining->block == 0){

                            $miningReport = new MiningReport();
                            $miningReport->order_id = $mining->order_id;
                            $miningReport->mined_btc = $userEarn[$key];
                            $miningReport->mined_usd =  $userEarn[$key] * $bitCoinPrice->price - $settings->maintenance_fee_per_th_per_day;
                            $miningReport->user_id = $user->id;
                            $miningReport->created_at = Carbon::now()->subDay(1);
                            $miningReport->updated_at = Carbon::now()->subDay(1);
                            $miningReport->save();


                            $mining->update(['mined_btc'=>$userEarn[$key] + $mining->mined_btc ,'mined_usd'=> $mining->mined_usd + $userEarn[$key] * $bitCoinPrice->price - $settings->maintenance_fee_per_th_per_day]);
                            $mining->save();
                            // creating new record in database for tomorrow mining record

                        }
                    }
                }

                $total_paid_btc = Transaction::where('user_id',$user->id)->where('status','paid')->where('checkout','in')->sum('amount_btc');
                $user->update(['total_mining'=>$minings->sum('mined_btc'),'pending'=> $minings->sum('mined_btc') - $total_paid_btc]);
                $user->save();
            }
        }
    }
}
