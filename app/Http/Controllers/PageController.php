<?php
namespace App\Http\Controllers;
use App\Crawling\CoinMarketCap;
use App\Events\Contact;
use App\Jobs\MessageJob;
use App\Message;
use App\RemoteData;
use App\User;
use App\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class PageController extends Controller
{
    public function index(Request $request){
        // Artisan::call('crypto:update');
        if($request->has('code')){
            $code = $request->code;
            return view('index',compact('code'));
        }else{
            return view('index');
        }
    }
    /*
        Index Page Contact Form
    */
    public function message(Request $request,Message $message){
        $this->validate($request,['name'=>'required'
            ,'email'=>'required|email'
            ,'message'=>'required',
            'captcha'=>'required|captcha'
        ]);
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
    public function aboutUs(){
        return view('about');
    }
    public function affiliate(){
        return view('affiliate');
    }
    public function ChangeLanguage(Request $request){
        $lang = $request->lang;
        $lang = explode('.',$lang)[0];
        if($lang == 'uk'){
            session(['locale'=>'en']);
        }elseif ($lang == 'ir'){
            session(['locale'=>'fa']);
        }
        return 200;
    }
    public function RedirectWallet(Request $request){
        if(!isset($request->address)){
            return 'Wrong Link!';
        }
        $tokenQuery = VerifyUser::where('token',$request->token)->first();
        if(is_null($tokenQuery)){
            return 'Fake Link';
        }
        $user = $tokenQuery->user;
        $wallet = $user->wallet;
        $wallet->update(['addr'=> $request->address]);
        return view('walletRedirection');
    }

    // Gets Miners data by API
    public function remote(Request $request){

        $remote = new RemoteData();
        $remote->data = serialize($request->minersInfo);
        $remote->save();
        return ['code'=>200,'message'=>'done!'];
    }

    // Shows Miners Data
    public function remoteDataPage(){
        $minerData = DB::connection('mysql')->table('remote_data')->orderBy('id','desc')->first();
        return view('minersStatus',compact('minerData'));
    }
}