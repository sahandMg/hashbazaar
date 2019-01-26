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

Route::get('/','PageController@index')->name('index');

Route::post('message','PageController@message')->name('message');

Route::post('subscribe','AuthController@subscribe')->name('subscribe');

Route::get('subscription','AuthController@subscription')->name('subscription');

Route::post('subscription','AuthController@post_subscription')->name('subscription');

Route::get('pricing','PageController@Pricing');
/*
*       Dashboard Routes
*/
Route::get('dashboard','PanelController@dashboard')->name('dashboard');

Route::get('activity','PanelController@activity')->name('activity');

Route::get('setting','PanelController@setting')->name('setting');

Route::get('setting/user-info','PanelController@userInfo')->name('userInfo');

Route::get('setting/change-pass','PanelController@changePassword')->name('changePassword');

Route::get('setting/wallet','PanelController@wallet')->name('wallet');

Route::get('setting/wallet-make','PanelController@makeWallet')->name('makeWallet');

Route::get('referral','PanelController@referral')->name('referral');

Route::get('contact','PanelController@contact')->name('contact');

Route::get('test',function (){

//    subscriptionMailJob::dispatch('sss@gmial.com','dsadsadaxzmczxmczx11231321');


});
