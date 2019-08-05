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

use App\BitCoinPrice;
use App\BitHash;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Morilog\Jalali\Jalalian;
use Symfony\Component\DomCrawler\Crawler;
use Psr\Http\Message\ResponseInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

Route::get('f2pool',function (){

    $url = 'http://api.f2pool.com/bitcoin/mvs1995';
    $client = new GuzzleClient();
    $promise1 = $client->requestAsync('GET',$url)->then(function (ResponseInterface $response) {
        return $response->getBody()->getContents();
    });
    $resp = $promise1->wait();

    return json_decode($resp,true);

});

Route::get('qr',function(){

//        $qr = QrCode::format('eps')->backgroundColor(210,168,103)->size(90)->generate('12X6ugSiEUUixJS17W1VghCA4zdPrHmzkY');
//        $output_file = "/img/qr-codes/test2".'.eps';
//        Storage::disk('local')->put($output_file, $qr);
//        dd('dsa');


});


Route::get('test',function (){


$btc = new BitCoinPrice();
        dd($btc->getPrice());

});

Route::get('redirect',function (){


    return redirect('http://electropak.ir/hashbazaar');

});

Route::get('elec',function (){


    return redirect('http://electropak.ir/home');

});

Route::get('sms',function (\Illuminate\Http\Request $request) {



    try{
        $api = new \Kavenegar\KavenegarApi( "796C4E505946715933687269672B6F6B5648564562585250533251356B6B6361" );
        $sender = "10008000800600";
        $message = "خدمات پیام کوتاه کاوه نگار";
        $receptor = array("09387728916","09351635933");
        $api->Send($sender,$receptor,$message);

    }
    catch(\Kavenegar\Exceptions\ApiException $e){
        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
        echo $e->errorMessage();
    }
    catch(\Kavenegar\Exceptions\HttpException $e){
        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
        echo $e->errorMessage();
    }


//    $url = 'https://hashbazaar.com/ReceiveCallbackUrl';
//    $fields = [
//        'sender'=>'10008000800600',
//        'to'=>'09387728916',
//        'message'=> $message =  "سلام",
//        'messageid'=>2
//    ];
//    $ch = curl_init();
//    curl_setopt($ch,CURLOPT_URL, $url);
//    curl_setopt($ch,CURLOPT_POST, count($fields));
//    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $result = curl_exec($ch);
//    curl_close($ch);


});


Route::get('ReceiveCallbackUrl',function (\Illuminate\Http\Request $request) {


});



Route::get('change-language','PageController@ChangeLanguage')->name('changeLanguage');

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

Route::get('language/{locale}', function ($locale) {

    $allLanguages = ["en", "fa"];

    $lng = ( in_array( $locale, $allLanguages) ) ? $locale : 'fa';
        session()->put(['locale'=>$lng]);
        App::setLocale($lng);
    return redirect()->route('index',['locale'=>$lng]);

})->name('locale');

Route::get('/', function (){

    return redirect()->route('index',['locale'=>session('locale')]);
});

Route::group(['middleware'=>'lang','prefix'=> '{lang}'],function() {

    Route::get('captcha-refresh',function (){

        $captcha = \Mews\Captcha\Facades\Captcha::create();
        return Captcha::src();

    });

    Route::get('/', 'PageController@index')->name('index');

    Route::get('about', 'PageController@aboutUs')->name('aboutUs');

    Route::get('affiliate', 'PageController@affiliate')->name('affiliate');

    Route::get('login/{hashpower?}', 'AuthController@login')->name('login')->middleware('guest');

    Route::post('login', 'AuthController@post_login')->name('login');

    Route::get('user/verify/{token}', 'AuthController@VerifyUser')->name('userVerify');

    Route::post('resend-verification', 'AuthController@ResendVerification')->name('ResendVerification');

    Route::get('user/email-verify', 'AuthController@VerifyUserPage')->name('VerifyUserPage');

    Route::get('subscription', 'AuthController@subscription')->name('subscription');

    Route::get('google/login', 'AuthController@redirectToProvider')->name('redirectToProvider');

    Route::get('google/login/callback', 'AuthController@handleProviderCallback')->name('handleProviderCallback');

    Route::get('signup/{hashpower?}', 'AuthController@signup')->name('signup')->middleware('guest');

    Route::get('password-reset', 'AuthController@passwordReset')->name('passwordReset');

    Route::get('pricing', 'PageController@Pricing');

    Route::get('received/{orderID?}', 'PaymentController@checkPaymentReceived')->name('checkPaymentReceived');

    Route::get('payment/canceled/{transid?}', 'PaymentController@PaymentCanceled')->name('PaymentCanceled')->middleware('auth');

    Route::get('payment/success', 'PaymentController@PaymentSuccess')->name('PaymentSuccess')->middleware('auth');

    Route::get('wallet-redirect', 'PageController@RedirectWallet')->name('RedirectWallet');

    Route::get('zarrin/callback', 'PaymentController@ZarrinCallback')->name('ZarrinCallback');

    Route::post('subscription', 'AuthController@post_subscription')->name('subscription');

    Route::post('subscribe', 'AuthController@subscribe')->name('subscribe');

    Route::post('signup', 'AuthController@post_signup')->name('signup');

    Route::post('password-reset', 'AuthController@post_passwordReset')->name('passwordReset');

    Route::post('paystar/paying', 'PaymentController@PaystarPaying')->name('PaystarPaying')->middleware('auth');

    Route::post('message', 'PageController@message')->name('message');

    Route::post('zarrin/paying', 'PaymentController@ZarrinPalPaying')->name('ZarrinPalPaying')->middleware('auth');

    Route::post('payment/test', 'PaymentController@TestPayment')->name('TestPayment')->middleware('auth');




    /*
    ===============================================================================
                                    User Panel Routes
    ===============================================================================
    */
    Route::group(['middleware' => 'block', 'prefix' => '/panel'], function () {

        Route::get('dashboard', 'PanelController@dashboard')->name('dashboard');

        Route::post('totalEarn', 'PanelController@totalEarn')->name('totalEarn');

        Route::post('dashboard', 'PanelController@postDashboard')->name('dashboard');

        Route::get('invoice', 'PanelController@makeInvoice')->name('invoice');

        Route::get('activity', 'PanelController@activity')->name('activity');

        Route::get('setting', 'PanelController@setting')->name('setting');

        Route::post('setting', 'PanelController@post_setting')->name('setting');

        Route::get('setting/user-info', 'PanelController@userInfo')->name('userInfo');

        Route::get('setting/change-pass', 'PanelController@changePassword')->name('changePassword');

        Route::post('setting/change-pass', 'PanelController@post_changePassword')->name('changePassword');

        Route::get('setting/wallet', 'PanelController@wallet')->name('wallet');

        Route::post('setting/wallet', 'PanelController@post_wallet')->name('wallet');

        Route::post('setting/wallet-edit', 'PanelController@editWallet')->name('editWallet');

        Route::get('setting/wallet-confirm', 'PanelController@confirmWallet')->name('confirmWallet');

        Route::get('referral', 'PanelController@referral')->name('referral');

        Route::get('contact', 'PanelController@contact')->name('contact');

        Route::post('contact', 'PanelController@post_contact')->name('contact');

        Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

        Route::get('payment', 'PaymentController@payment')->name('payment');

        Route::post('payment', 'PaymentController@postPayment')->name('payment');

        Route::get('payment/confirm', 'PaymentController@confirmPayment')->name('confirmPayment');

        Route::post('redeem', 'PaymentController@redeem')->name('redeem');

        Route::get('chart', 'PanelController@chartData')->name('chartData');

        Route::get('banner/{name?}', ['as' => 'banner', 'uses' => 'PanelController@downloadBanner']);

        Route::get('collaboration', ['as' => 'collaboration', 'uses' => 'PanelController@collaboration']);

    });

    Route::get('faq', ['as' => 'customerService', 'uses' => 'PageController@customerService']);

    Route::get('@admin/login', ['as' => 'AdminLogin', 'uses' => 'AdminController@login'])->middleware('guest');

    Route::post('@admin/login', ['as' => 'AdminLogin', 'uses' => 'AdminController@post_login'])->middleware('guest');
// ============================ Admin Routes ==============================================
    Route::group(['prefix' => '@admin', 'middleware' => 'admin'], function () {

        Route::get('home', ['as' => 'adminHome', 'uses' => 'AdminController@index']);

        Route::get('transactions', ['as' => 'adminTransactions', 'uses' => 'AdminController@transactions']);

        Route::get('get-transactions', ['as' => 'adminGetTransactions', 'uses' => 'AdminController@getTransactions']);

        Route::get('checkout', ['as' => 'adminCheckout', 'uses' => 'AdminController@adminCheckout']);

        Route::get('redeems', ['as' => 'adminRedeems', 'uses' => 'AdminController@adminRedeems']);

        Route::get('get-redeems', ['as' => 'adminGetRedeems', 'uses' => 'AdminController@adminGetRedeems']);

        Route::get('users/list', ['as' => 'adminGetUsersList', 'uses' => 'AdminController@adminGetUsersList']);

        Route::get('block-user', ['as' => 'blockUser', 'uses' => 'AdminController@blockUser']);

        Route::post('login-as-user', ['as' => 'LoginAsUser', 'uses' => 'AdminController@LoginAsUser']);

        Route::get('collaboration/{id?}', ['as' => 'collaboration', 'uses' => 'AdminController@collaboration']);

        Route::post('collaboration', ['as' => 'collaboration', 'uses' => 'AdminController@post_collaboration']);

        Route::get('user-setting/{id?}', ['as' => 'userSetting', 'uses' => 'AdminController@userSetting']);

        Route::post('user-setting/{id?}', ['as' => 'userSetting', 'uses' => 'AdminController@post_userSetting']);

        Route::get('site-setting', ['as' => 'siteSetting', 'uses' => 'AdminController@siteSetting']);

        Route::post('site-setting', ['as' => 'siteSetting', 'uses' => 'AdminController@post_siteSetting']);

        Route::get('logout', ['as' => 'adminLogout', 'uses' => 'AdminController@adminLogout']);

        Route::get('message', ['as' => 'AdminMessage', 'uses' => 'AdminController@message']);

        Route::post('message', ['as' => 'AdminMessage', 'uses' => 'AdminController@post_message']);

        Route::post('delete-message', ['as' => 'deleteMessage', 'uses' => 'AdminController@post_deleteMessage']);

        Route::get('chartData', ['as' => 'chartDataAdmin', 'uses' => 'AdminController@chartData']);

        Route::get('chartData-profit', ['as' => 'chartDataProfit', 'uses' => 'AdminController@chartDataProfit']);

//   Voyager::routes();
    });

    Route::post('send-code', 'PanelController@postDashboard')->name('SendCode');
});
