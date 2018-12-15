<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class subscriptionMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $email;
    public $code;

    public function __construct($email,$code)
    {
        $this->email = $email;
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::warning('Job has been started');
        $data = [
            'code'=>$this->code,
            'email'=>$this->email
        ];
        Mail::send('thanks',$data,function($message) use($data){
            $message->from ('Admin@HashBazaar');
            $message->to ($data['email']);
            $message->subject ('Subscription Email');
        });

        Log::warning('Job has been finished');
    }
}
