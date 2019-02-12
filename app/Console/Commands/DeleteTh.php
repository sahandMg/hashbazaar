<?php

namespace App\Console\Commands;

use App\BitHash;
use App\Mining;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DeleteTh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hash:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'retrieves unpaid THs';

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
        $unpaids = BitHash::where('confirmed',0)->get();
        $unpaidMining = Mining::where('block',1)->get();
        $settings = Setting::first();
        foreach ($unpaids as $key => $unpaid){

            if(Carbon::parse($unpaid->created_at)->diffInHours(Carbon::now()) > 10){


                $settings->update(['available_th'=> $settings->available_th + $unpaid->hash]);
//                $unpaidMining[$key]->delete();
//                $unpaid->delete();

                $user = DB::table('users')->where('id',$unpaid->user_id)->first();
                $trans = DB::table('crypto_payments')->where('orderID',$unpaid->order_id)->first();
                if(! is_null($user) && !is_null($trans)){

                    $data = [
                        'orderID' => $unpaid->order_id,
                        'email'=> $user->email,
                        'amount' => $trans->amount,
                        'created_at' => $trans->txDate
                    ];

                    Mail::send('email.unconfirmedPayment',$data,function ($message) use($data){

                        $message->to($data['email']);
                        $message->from('admin@hashbazaar.com');
                        $message->subject('Unsuccessful Payment');
                    });
                }

            }
        }
    }
}
