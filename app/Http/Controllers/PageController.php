<?php

namespace App\Http\Controllers;

use App\Crawling\CoinMarketCap;
use App\Events\Contact;
use App\Jobs\MessageJob;
use App\Message;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function index(){

        // Artisan::call('crypto:update');
        return view('index');
    }
/*
Gets user message for form
*/
    public function message(Request $request,Message $message){

        $this->validate($request,['name'=>'required','email'=>'required|email','message'=>'required']);

        if($request->has('name')){

        }
        $message->name = $request->name;
        $message->email = $request->email;
        $message->message = $request->message;
        $message->save();

//        MessageJob::dispatch($request->email,$request->message);
        $data = [
            'UserMessage'=> $request->message,
            'email'=> $request->email,
            'name' => $request->name
        ];

        event(new Contact($data));

        return redirect()->back()->with(['message'=>'Your message has been sent!']);
    }

    public function Pricing(){

        $coin = new CoinMarketCap();
        return $coin->getApi();


    }

    public function customerService(){

        return view('faq.index');
    }

}
