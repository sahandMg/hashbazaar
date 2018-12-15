<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $UserMessage;
    public $email;

    public function __construct($email,$userMessage)
    {
        $this->email = $email;
        $this->UserMessage = $userMessage;
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
            'UserMessage'=>$this->UserMessage,
            'email'=>$this->email
        ];

        // Mail::send('messageMailPage',$data,function($message) use($data){
        //     $message->from ($data['email']);
        //     $message->to ('Admin@HashBazaar');
        //     $message->subject ('Subscription Email');
        // });

        Log::warning('Job has been finished');
    }
}
