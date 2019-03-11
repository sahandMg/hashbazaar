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

    return QrCode::size(100)->generate('Make me into a QrCode!');

});

Route::get('test2',function(){

    $fields = array(
        'amount' => '100',
        'email' => 'sahand.mg.ne@gmail.com',
        'phone' => '021321',
        'pin' => '7DC84A8791E676C3DD7C',
        'description' => 'https://ssaa.com',
        'callback' => 'dadsda',
        'bank'=>'novin',
        'ip'=> '192.168.1.1'
    );
    $fields2 = json_encode($fields);
    $url = 'https://test.paystar.ir/api/create';
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
});

Route::get('/','PageController@index')->name('index');

Route::post('message','PageController@message')->name('message');

Route::post('subscribe','AuthController@subscribe')->name('subscribe');

Route::get('subscription','AuthController@subscription')->name('subscription');

Route::post('subscription','AuthController@post_subscription')->name('subscription');

Route::get('about','PageController@aboutUs')->name('aboutUs');

Route::get('affiliate','PageController@affiliate')->name('affiliate');

Route::get('login/{hashpower?}','AuthController@login')->name('login');

Route::post('login','AuthController@post_login')->name('login');

Route::get('password-reset','AuthController@passwordReset')->name('passwordReset');

Route::post('password-reset','AuthController@post_passwordReset')->name('passwordReset');

Route::get('login/google','AuthController@redirectToProvider')->name('redirectToProvider');

Route::get('login/google/callback','AuthController@handleProviderCallback')->name('handleProviderCallback');

Route::get('signup/{hashpower?}','AuthController@signup')->name('signup');

Route::post('signup','AuthController@post_signup')->name('signup');

Route::get('pricing','PageController@Pricing');

Route::get('received/{orderID?}','PaymentController@checkPaymentReceived')->name('checkPaymentReceived');
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

    Route::get('setting/wallet-make','PanelController@makeWallet')->name('makeWallet');

    Route::get('referral','PanelController@referral')->name('referral');

    Route::get('contact','PanelController@contact')->name('contact');

    Route::post('contact','PanelController@post_contact')->name('contact');

    Route::get('logout',['as'=> 'logout','uses'=>'AuthController@logout']);

    Route::get('payment','PaymentController@payment')->name('payment');

    Route::post('payment','PaymentController@postPayment')->name('payment');

    Route::post('cryptobox.callback.php','PaymentController@paymentCallback')->name('paymentCallback');

    Route::get('payment/confirm','PaymentController@confirmPayment')->name('confirmPayment');

    Route::post('redeem','PaymentController@redeem')->name('redeem');

    Route::get('chart','PanelController@chartData')->name('chartData');

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

//   Voyager::routes();
});

Route::post('send-code','PanelController@postDashboard')->name('SendCode');

Route::group(['prefix' => 'admin'], function () {




});
