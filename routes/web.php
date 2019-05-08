<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\BitHash;
use App\CoinBaseCharge;
use App\CustomCode;
use App\Jobs\subscriptionMailJob;
use App\Mining;
use App\MiningReport;
use App\Setting;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Psr\Log\LoggerInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\DomCrawler\Crawler;
use Psr\Http\Message\ResponseInterface;
use TCG\Voyager\Facades\Voyager;

Route::get('job',function(){

    $url = 'http://ip-api.com/php/192.119.12.118';
    unserialize(file_get_contents($url))['countryCode'];
    $ch = curl_init($url); // such as http://example.com/example.xml
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    dd($data);
    $cryptoName = [];
    $url = 'https://pay98.cash/%D9%82%DB%8C%D9%85%D8%AA-%D8%A7%D8%B1%D8%B2%D9%87%D8%A7%DB%8C-%D8%AF%DB%8C%D8%AC%DB%8C%D8%AA%D8%A7%D9%84';
    $config = [
        'referer' => true,
         'headers' => [
             'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
             'Accept-Encoding' => 'gzip, deflate, br',
],
];
    $client = new GuzzleClient();
    $promise1 = $client->requestAsync('GET',$url,$config)->then(function (ResponseInterface $response) {
        $this->resp = $response->getBody()->getContents();
        return $this->resp;
    });
    $promise1->wait();
    $crawler = new Crawler($this->resp);
    $coinNames = $crawler->filterXPath('//p[contains(@class,"nametop1")]');
    // $coins = str_replace(' ', '', $coins);
    // $coins = str_replace("\n", '', $coins);
    // $coins = str_replace("\r", '', $coins);

    $crawledCoins = $coinNames->each(
        function (Crawler $node, $i) {
            $first = $node->children()->eq(1)->text();
            return $first;
        });

    $coinPrices = $crawler->filterXPath('//b[contains(@class,"ltr")]');

//    Gets Just Crypto Names
    $crawledPrices = $coinPrices->each(
        function (Crawler $node, $i) {
            // $first = $node->eq(4)->text();
            return $node->text();
        });

        array_shift($crawledPrices);
        array_shift($crawledPrices);
        array_shift($crawledPrices);

    $CryptoCrawl = array_combine($crawledCoins,$crawledPrices);
    return view('cryptoMailPage',compact('CryptoCrawl'));
});

Route::get('mail',function (){

//    $user = User::first();
//    Mail::send('email.newUser',['user'=>$user],function($message){
//        $message->from ('support@hashbazaar.com');
//        $message->to ('s23.moghadam@gmail.com');
//        $message->subject ('New User');
//    });
        $doalr = new \App\Crawling\Dolar();
    dd($doalr->getDolarInToman());

//    $hashes = BitHash::where('user_id', 1)->where('confirmed',1)->get();
//    if (!$hashes->isEmpty()) {
//        foreach ($hashes as $item => $hash) {
//            $remainedDay = Carbon::now()->diffInDays(Carbon::parse($hash->created_at)->addYears($hash->life));
//            $hash->update(['remained_day' => $remainedDay]);
//            $hash->save();
//            $hashPower[$item] = $hash->hash;
//            $maintenance_inBTC = 0.1 / 5200 * $hashPower[$item];
//            $userEarn[$item] = 0.01 * ($hashPower[$item] / 14) - $maintenance_inBTC;
//
//        }
//
//        dd( array_sum($userEarn));
//    }

});


Route::post('charge/create','PaymentController@createCharge')->name('chargeCreate');
Route::get('charge/show/{id?}','PaymentController@getCharges');
Route::get('charge/list','PaymentController@listCharges');
Route::get('charge/cancel/{id?}','PaymentController@cancelCharge');

Route::get('checkout/list','PaymentController@listCheckouts');
Route::get('checkout/create','PaymentController@createCheckout');
Route::get('checkout/update/{productid?}','PaymentController@updateCheckout');
Route::get('checkout/delete/{productid?}','PaymentController@deleteCheckout');


Route::get('events/list','PaymentController@eventList');
Route::get('events/show/{productid?}','PaymentController@eventShow');

Route::get('/','PageController@index')->name('index');

Route::post('message','PageController@message')->name('message');

Route::post('subscribe','AuthController@subscribe')->name('subscribe');

Route::get('subscription','AuthController@subscription')->name('subscription');

Route::post('subscription','AuthController@post_subscription')->name('subscription');

Route::get('about','PageController@aboutUs')->name('aboutUs');

Route::get('affiliate','PageController@affiliate')->name('affiliate');

Route::get('login/{hashpower?}','AuthController@login')->name('login')->middleware('guest');

Route::post('login','AuthController@post_login')->name('login');

Route::get('password-reset','AuthController@passwordReset')->name('passwordReset');

Route::post('password-reset','AuthController@post_passwordReset')->name('passwordReset');

Route::get('google/login','AuthController@redirectToProvider')->name('redirectToProvider');

Route::get('google/login/callback','AuthController@handleProviderCallback')->name('handleProviderCallback');

Route::get('signup/{hashpower?}','AuthController@signup')->name('signup')->middleware('guest');

Route::post('signup','AuthController@post_signup')->name('signup');

Route::get('pricing','PageController@Pricing');

Route::get('received/{orderID?}','PaymentController@checkPaymentReceived')->name('checkPaymentReceived');

Route::get('payment/canceled/{transid?}','PaymentController@PaymentCanceled')->name('PaymentCanceled')->middleware('auth');

Route::get('payment/success','PaymentController@PaymentSuccess')->name('PaymentSuccess')->middleware('auth');

Route::post('payment/callback','PaymentController@PaymentCallback')->name('PaymentCallback');

Route::post('paystar/paying','PaymentController@PaystarPaying')->name('PaystarPaying')->middleware('auth');

/*
===============================================================================
                                User Panel Routes
===============================================================================
*/
Route::group(['middleware'=>'block','prefix'=>'panel'],function(){


    Route::get('dashboard','PanelController@dashboard')->name('dashboard');

    Route::post('totalEarn','PanelController@totalEarn')->name('totalEarn');

    Route::post('dashboard','PanelController@postDashboard')->name('dashboard');

    Route::get('invoice','PanelController@makeInvoice')->name('invoice');

    Route::get('activity','PanelController@activity')->name('activity');

    Route::get('setting','PanelController@setting')->name('setting');

    Route::post('setting','PanelController@post_setting')->name('setting');

    Route::get('setting/user-info','PanelController@userInfo')->name('userInfo');

    Route::get('setting/change-pass','PanelController@changePassword')->name('changePassword');

    Route::post('setting/change-pass','PanelController@post_changePassword')->name('changePassword');

    Route::get('setting/wallet','PanelController@wallet')->name('wallet');

    Route::post('setting/wallet','PanelController@post_wallet')->name('wallet');

    Route::post('setting/wallet-edit','PanelController@editWallet')->name('editWallet');

    Route::get('referral','PanelController@referral')->name('referral');

    Route::get('contact','PanelController@contact')->name('contact');

    Route::post('contact','PanelController@post_contact')->name('contact');

    Route::get('logout',['as'=> 'logout','uses'=>'AuthController@logout']);

    Route::get('payment','PaymentController@payment')->name('payment');

    Route::post('payment','PaymentController@postPayment')->name('payment');

    Route::get('payment/confirm','PaymentController@confirmPayment')->name('confirmPayment');

    Route::post('redeem','PaymentController@redeem')->name('redeem');

    Route::get('chart','PanelController@chartData')->name('chartData');

    Route::get('banner/{name?}',['as'=>'banner','uses'=>'PanelController@downloadBanner']);

});


Route::get('blog',['as'=>'blog','uses'=>'BlogController@index']);

Route::get('faq',['as'=>'customerService','uses'=>'PageController@customerService']);


Route::group(['prefix' => '@admin'], function () {

    Route::get('home',['as'=>'adminHome','uses'=>'AdminController@index']);
    Route::get('transactions',['as'=>'adminTransactions','uses'=>'AdminController@transactions']);
    Route::get('get-transactions',['as'=>'adminGetTransactions','uses'=>'AdminController@getTransactions']);Route::get('redeems',['as'=>'adminRedeems','uses'=>'AdminController@adminRedeems']);

    Route::get('checkout',['as'=>'adminCheckout','uses'=>'AdminController@adminCheckout']);

    Route::get('redeems',['as'=>'adminRedeems','uses'=>'AdminController@adminRedeems']);
    Route::get('get-redeems',['as'=>'adminGetRedeems','uses'=>'AdminController@adminGetRedeems']);

    Route::get('users/list',['as'=>'adminGetUsersList','uses'=>'AdminController@adminGetUsersList']);
    Route::get('block-user',['as'=>'blockUser','uses'=>'AdminController@blockUser']);

    Route::post('login-as-user',['as'=>'LoginAsUser','uses'=>'AdminController@LoginAsUser']);

//   Voyager::routes();
});

Route::post('send-code','PanelController@postDashboard')->name('SendCode');

Route::group(['prefix' => 'admin'], function () {




});
