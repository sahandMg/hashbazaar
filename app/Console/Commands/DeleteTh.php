<?php

namespace App\Console\Commands;

use App\BitHash;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        $settings = Setting::first();
        foreach ($unpaids as $unpaid){

            if(Carbon::parse($unpaid->created_at)->diffInHours(Carbon::now()) > 10){

                $settings->update(['available_th'=> $settings->available_th + $unpaid->hash]);

                $unpaid->delete();
            }
        }
    }
}
