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

use App\Jobs\subscriptionMailJob;
use App\MiningReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;
use Psr\Http\Message\ResponseInterface;

Route::get('job',function(){

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

Route::get('test',function (){

    $unpaids = \App\BitHash::where('confirmed',0)->get();
    $settings = \App\Setting::first();
    foreach ($unpaids as $unpaid){

        if(Carbon::parse($unpaid->created_at)->diffInHours(Carbon::now()) > 24){

            $settings->update(['available_th'=> $settings + $unpaid->hash]);
            $unpaid->delete();
        }
    }
});

Route::get('antpool',function (){


    $userId = '13741374';
    $apiKey = '7b07bc4b507b4d7584770f8ddddd02f1';
    $nonce = rand(0,1000);
    $secret = '0585329bf8eb48509b1ad13b709d9390';
    $url = 'https://antpool.com/api/account.htm';
    $signature = strtoupper(hash_hmac('sha256',$userId.$apiKey.$nonce, $secret,false));

    $fields = [
        'key'       => $apiKey,
        'nonce'     =>  $nonce ,
        'signature' =>  $signature,
        'coin'      =>  'BTC'
    ];

    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$url?key=$apiKey&nonce=$nonce&signature=$signature&coin=BTC");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    dd($result);
    $totalEarn = json_decode($result)->data->earnTotal;



});

Route::get('/','PageController@index')->name('index');

Route::post('message','PageController@message')->name('message');

Route::post('subscribe','AuthController@subscribe')->name('subscribe');

Route::get('subscription','AuthController@subscription')->name('subscription');

Route::post('subscription','AuthController@post_subscription')->name('subscription');

Route::get('login','AuthController@login')->name('login');

Route::post('login','AuthController@post_login')->name('login');

Route::get('signup','AuthController@signup')->name('signup');

Route::post('signup','AuthController@post_signup')->name('signup');

Route::get('pricing','PageController@Pricing');

/*
===============================================================================
                                User Panel Routes
===============================================================================
*/

Route::get('dashboard','PanelController@dashboard')->name('dashboard');

Route::post('totalEarn','PanelController@totalEarn')->name('totalEarn');

Route::post('dashboard','PanelController@postDashboard')->name('dashboard');

Route::get('invoice','PanelController@makeInvoice')->name('invoice');

Route::get('activity','PanelController@activity')->name('activity');

Route::get('setting','PanelController@setting')->name('setting');

Route::get('setting/user-info','PanelController@userInfo')->name('userInfo');

Route::get('setting/change-pass','PanelController@changePassword')->name('changePassword');

Route::post('setting/change-pass','PanelController@post_changePassword')->name('changePassword');

Route::get('setting/wallet','PanelController@wallet')->name('wallet');

Route::get('setting/wallet-make','PanelController@makeWallet')->name('makeWallet');

Route::get('referral','PanelController@referral')->name('referral');

Route::get('contact','PanelController@contact')->name('contact');

Route::get('logout',['as'=> 'logout','uses'=>'AuthController@logout']);

Route::get('payment','PaymentController@payment')->name('payment');

Route::post('payment','PaymentController@postPayment')->name('payment');

Route::post('cryptobox.callback.php','PaymentController@paymentCallback')->name('paymentCallback');

Route::get('payment/confirm','PaymentController@confirmPayment')->name('confirmPayment');

Route::get('redeem','PaymentController@redeem')->name('redeem');

Route::get('chart','PanelController@chartData')->name('chartData');

Route::group(['prefix'=>'admin'],function (){

    Route::get('main',['as'=>'main','uses'=>'AdminController@index']);
    Route::get('transactions',['as'=>'adminTransactions','uses'=>'AdminController@transactions']);
    Route::get('get-transactions',['as'=>'adminGetTransactions','uses'=>'AdminController@getTransactions']);
});

Route::get('blog',['as'=>'blog','uses'=>'BlogController@index']);

Route::get('customer-service',['as'=>'customerService','uses'=>'PageController@customerService']);
