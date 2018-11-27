<?php
/**
 * Created by PhpStorm.
 * User: Sahand
 * Date: 11/25/18
 * Time: 5:50 PM
 */

namespace App\Crawling;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\DomCrawler\Crawler;
use Psr\Http\Message\ResponseInterface;

class CoinMarketCap
{

    public function getApi(){
        $cryptoName = [];
        $url = 'https://coinmarketcap.com/';
        $client = new GuzzleClient();
        $promise1 = $client->requestAsync('GET',$url)->then(function (ResponseInterface $response) {
            $this->resp = $response->getBody()->getContents();
            return $this->resp;
        });
        $promise1->wait();

        $crawler = new Crawler($this->resp);
        $coins = $crawler->filterXPath('//td[contains(@class,"no-wrap text-right")]');
        $crawledCoins = $coins->each(
            function (Crawler $node, $i) {
                $first = $node->children()->first()->text();
                return $first;
            });
        $names = $crawler->filterXPath('//a[contains(@class,"currency-name-container link-secondary")]');

//    Gets Just Crypto Names
        $crawledNames = $names->each(
            function (Crawler $node, $i) {

                $first = $node->text();
                return $first;
            });

        for($i=0;$i<count($crawledCoins);$i++){
            $crawledCoins[$i] = str_replace('  ', '', $crawledCoins[$i]);
            $crawledCoins[$i] = str_replace("\n", '', $crawledCoins[$i]);
        }
        for($i=0;$i<count($crawledCoins);$i++) {
            if(fmod($i,3)==0){
                $coinPrice = str_replace(',','',preg_replace('/[^0.-9]/','', $crawledCoins[$i]));
                $coinPrice = str_replace(' ','',$coinPrice);
                $cryptoPrice[$i] = $coinPrice;
            }
        }
        $cryptoPrice = array_values($cryptoPrice);
        $CryptoCrawl = array_combine($crawledNames,$cryptoPrice);
        if($CryptoCrawl['Ethereum'] >= 100){

            $data = ['CryptoCrawl'=>$CryptoCrawl];
            Mail::send('cryptoMailPage',$data,function($message){
                $message->from('Admin@HashBazaar');
                $message->to('s23.moghadam@gmail.com');
                $message->subject('Crypto Prices');
            });

        }


    }
}