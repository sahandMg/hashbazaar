<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use GuzzleHttp\Client as GuzzleClient;
use Morilog\Jalali\Jalalian;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Support\Facades\Mail;
class hashRateCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hash:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks hashRate status';

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
     */
    public function handle()
    {

        $url = 'http://api.f2pool.com/bitcoin/mvs1995';
        $client = new GuzzleClient();
        $promise1 = $client->requestAsync('GET',$url)->then(function (ResponseInterface $response) {
            return $response->getBody()->getContents();
        });
        $resp = $promise1->wait();
        $hashRate = json_decode($resp,true)['hashrate'];

        if($hashRate == 0){

            $sender = "1000596446";
            $receptor = "09387728916";
            $message =  "ماینرها خاموش شدند ".Jalalian::forge(Carbon::now())->toString();
            $api = new \Kavenegar\KavenegarApi("796C4E505946715933687269672B6F6B5648564562585250533251356B6B6361");
            $api -> Send ( $sender,$receptor,$message);

//            $sender = "1000596446";
//            $receptor = "09371869568";
//            $message = "ماینرها خاموش شدند مدیر!";
//            $api = new \Kavenegar\KavenegarApi("796C4E505946715933687269672B6F6B5648564562585250533251356B6B6361");
//            $api -> Send ( $sender,$receptor,$message);

            Mail::send('email.hashRateCheck',[],function($message){
                $message->to('admin@hashbazaar.com');
                $message->from('admin@hashbazaar.com');
                $message->subject('Hash Rate Alllleeerrrrtttttt!!!!');
            });
        }

    }
}
