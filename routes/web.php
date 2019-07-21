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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Morilog\Jalali\Jalalian;
use Symfony\Component\DomCrawler\Crawler;
use Psr\Http\Message\ResponseInterface;


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

Route::get('test',function (){

    $addresses =["12X6ugSiEUUixJS17W1VghCA4zdPrHmzkY","L3ePNME2JBEavtmoUdPSbc4qmaH3W9q6jdwYfT5884CRzk9d2VXj",
2,"12gNNJT3KZqKkFJ6JkU3WF6uupyTB7NGTC","KwpSjUkNisezha6XPazHfSjonPJ7SPPKoo9NxkAdGb2pCCZUjGQE",
3,"14rJHMVrybfbArWECa5fcj538MfUeUMYeS","L3TdX6H8ZF5TjaRv6Ew4FwXz5Cdg6B3eBVFyKDSf7gFEft9YGAeE",
4,"184kfJwVqXLKFXCXi4H3ox6i5QhTnVKGcC","L5WfkFZHC6WVcREFiqxQQNWSQrxzwt35skjAbqP3om9njVCYFQCS",
5,"18Mva6fUwGvRxoZi6pFYfYxZoCtFfjVhti","L3oPQ14Z7wfTHLbxMZbBnyf2uCQkNXWdBWDYe1nTXv83ZRR5SjEx",
6,"1HzWFwS1qhMVTyK6YjHWN11EvH7D3Ba8AD","KzTW8Syi6gqsgiDEku8ebb1bE4LKR4xRV8J1tfjGCeP9SfVWc7vs",
7,"1K1jiV8jcXkuDPPfZBXkxNdyVA98MoATTm","KzpdcAjDYpT1jgpGTbE7yL4HtQdSBhV7e23FHyYPhWQX3HeVWAfT",
8,"18Y6Wd85HGV8NpAfeJ6XWLBnnnxaYDohuS","KzSvgNX8AhtkBEZJqiPSvWgN7runWGRuKKXx71ReQiGKUrZ3cKHV",
9,"1EEp3nYHj1vzuPiBan3RFTbkdRYv32X4gj","L2ifmm3tBhAgTnXYAKPevu1Zz6bBWFtYMHLuhbexT8R1Abr5KtRo",
10,"1GAVZAirRJPMw1HcqZspUhX8uAitLmLcKx","L41gTMKWX3266VrUkWk3Qeipx6pB58hioh5a8sumELCP4qfhM1WR",
11,"1DYfENg1Qzc5v3czuC9C49brqCtEcufJzU","KxbqWB8veE34nuNSUY3jzfMZxkg2jwQ6qppkmDbsAnibU2SXru4V",
12,"16fjkb8e2MRxYNmidU7GX2ntwtoQxTLDNm","KwcrduBHLGYWK72y9dJb4sKn3Bk9xDQiAwT1SC94hAq9Gvtr238b",
13,"13dL8UfkCP8s3ZZQVaqojP9fGnAxHH6B2c","KzCTuBZW7ma7CXJiUXna1SqsjLTgmprbRpXAYJu3R9hRLXg7xMia",
14,"1GhnJgyBCZDAAod5aj3V2BLyxC5QA35JwB","L2soQXg9txwZFEkZjbnrHYaSxvLtK3CmN4ZhZjhRZ72CdVrasGoS",
15,"1CgFzt4a1tWqJhXWt9oitRdMVuF3eqmWaz","KxQa2sFjMkcp8Y1oPHwpDLXHVr2EysaCjYRykuZTJVFagCy99cSY",
16,"1EvS5N17tRygc8znXgxJzzCMJUKTJknSKU","KyqHpZPMppyCziz9tYBny9FNKkQ3A5f4pavEyokYsp4Z7qrj3mWS",
17,"1EdsRoK9xhJ791aPnoh3rCV8z4a6f6HwSn","KzrPxp4KpPQdjQ53CBWhMQVQNKJYft6k9mgqksDBbvqvKXQTaLaL",
18,"1efGx141ebXDpA7ZWz3fc4qBJeDBieXdC","L3Xkk6KmXKgjNbgik9PEUB6tDfxhTmXEijrcbrAYAgR3NLkYDaHB",
19,"15V3t7CB6s8HijuV7Sa6HvPR7hkwvPW7iC","KwSh3uDAbrQ6vxb6dGwJX3mCuNU4mPRiKLvB6ew9xyUhUEivuyfq",
20,"1DeG3YUMbsX9Zg2WYZiy437B8ZGkEsoZt6","L112wWCNHrehPdeyAAT3wAzm9wWgS11MVCnWn3DEZUNRzPqDe7Zu",
21,"161i8fqKvV43gb2pYLEkCNNRm4NfWTS2Bq","Kzh28KdoDbyDShqPBzMxExY9eFibJpQBAsvfUTM4CKSz8nif9SPN",
22,"1GfXb2Wc25PnBtP2AA33eYTaLJJRZBKu8F","Kx5bsc5xHDydPJhjFjBTJocuCZUxSjd8rBMmGRD4HgPNCH6AWPJi",
23,"1KW6WiFJgrwZshGJpyFgk59MkRgTEB57YS","L5Xgxzmk5RTKekPqRXgsQwBzBiPckyrvVoquuiDPtJFFGPMD66Jo",
24,"1GsTLJa8YUJyo1Gnr1T9z9FfhArC2jnQEA","Kxjf4wrfvtp7b4kTp4Khw8UcgnFh67mHwoWGpdCsGWvSfEFcfYHC",
25,"15RGXe6ZT9gabdRK6QFXv7FYpy15AJXTqK","KxAffmyPezE5PgwB5pnGn4kRiNWvyz8TGdMgHrnoWDCfD3vEaWyg",
26,"178fg4DaAJs5jynjiSPjBEtR2X71iQXniz","L1AcZ22QaAFjsaSwtrKwGHntVbnDbtc6ykDVuJGSSrkTR4siuMPb",
27,"19jACAfPk1L3nStz7NrEWcrjo3G2m5csHj","L2BB6HAaRz1X68WmZrVJX3gv6LQRRdN8LVnSaNcstCry4KAsotjc",
28,"1NpaNygMNZ5g3WsUVfmmmPShxYd7iQShfg","Ky6FuSyyhEySz5yjBZpsXUx99ysT7zdpRi7ZqPpKW48em1jcRWNS",
29,"1P6oobo2Wt2L826D8L5ESF3gkrU9nyg6LW","KzjDR8sBT2rhqooi5qeo6QBk8LQ4Qi9BbRkJN9JhzQJJ3ACEfGDH",
30,"1NE4FjKzFfsMZPUZQvVHpg8MMFgKekDbFW","KxHsmoG6emjpguecBW272FbbSL6oYvzo6njmTbAAumaJe8ZzspXi",
31,"13sYzhGWVNNQn2mC8E9QXLZiuPFdk7ef2x","KxqLuPwShnC419KvjjZizkDLiG8AxAZqhkF26x9Q4fswrmidAHDg",
32,"13UzWjNYNvN1y2ipqjnSSUCLBGDrnVGCpX","KxNrtyQqjs8N2GkRLtwpykzLnE72ab6WAds6pzp4bDMbqhATmAAL",
33,"1B4nCMa4GBq2vD14FpSMr5qAtDdN9jUTGd","KzZsQGBcq2jZV2LbS8LE26TPrPKohnxoCQvnJZp2a3kde8LsWn2f",
34,"1hcEzzH1dZhbzQEZynJvb7WbcTRRV9f6J","L1qLVoKwg49XNzDCz7WddmcrApYRTYSyrj7eqZpLm5YJkx5Rk68k",
35,"176UG2XU1BBmkHnjDCHz5YeNooFRvZkyzL","L3nQmsAmbCQh4ehBpwW9GBoqez89qcPEKy8UPSEtAX4aJ1Yr4do4",
36,"1CoZDFKhwPmCbt53S1g2UAiVnJtntm5Uis","L2rkyD5mxpTAwNGuHHBYazfjgYvur78RDwGWdkLwY1h4FWGGC765",
37,"1Medf17Pyv546qHYC7tFv5YkhhvYcmfVzg","L29YEiMgAMYFfqRCZhhk9K7KX6RLpgypSPWDUH9vpXFa4EukavNi",
38,"145P6cq272q1At5seHazKrpwTLTSGRrC1V","KxRu82pam8MFYfEQR4d5Ung6QK14nVEobrhtUMMMJ3qmbwkAwkht",
39,"1Btkt5axrzwYjYu5SxsMFNefhDvKHAB4wt","L4QkCkEtfoKKhgbuZsALFwHZFEfALgokSFLJGkyajB7r22dWYKZ7",
40,"1EGd5wPo4eGFDLTdRANa8bUJXYEbN1VFpg","L46RKFovcdX1EWkuxZMY3WVpui6QEicMqz4KExe7fZw66vVdGqnt",
41,"1AX7SAs3XjjGeS6kVSo26QiKETkCJzyfAn","KyXMpSZ9rxQBAEWvgHqMgvVLpx8QeeKGyuDz4pmePK3YwouCZ3h2",
42,"1ChJp9Yg9n3ZMhyTJHbfDTFrsHDDsuvM7i","L5L1ojigWBJSSDMq18nQ7AWTdjbfJtiNpRNmx5VviYu4kDZygCBK",
43,"1DGEDVUiQ2YV8cjrxFFxs61CMZnBkueGtj","KxwWT7cubQUuKY17JAWHApDJfYc4WFtbFwuqCWR699bsgqtfN1zu",
44,"18bTr3BLXsdCfTPjniwKAeRQj7zU2FVncr","Kz8P8XA71HCaV3spaacB7N6TRFMvzGRGDqYfaCfFKq2HEUcfSSxH",
45,"1HweC5141nYcLD87ZRLFRExL7GqdDKk9ej","L26BC5a9AbJ1TVgqHbxnodGk3z6q7CD25Bhy6meUryAe9JNnftcC",
46,"1ABd5jfZf4kCLZN7JS5oVvUtXJJUZwD8qV","Kzcm2oSuLdWDTvCQYj6NNtCS2beZw2Bv25Xav4JbSP41WUiQ6wmZ",
47,"1FqYiTR7AEsdXD2H8EzMVVovSmPUZZXEPp","L3WELdroKYPZm83BGoysX1LpXRETYsiUD8QQgaLYf3BYca96BBNf",
48,"1L8EgX8qVQoT9TSijXG7pvE5vcynGPFkrw","Ky4a6qqNrByfQevtXyrzrRZsH5QcUWyeB8C48ocdhg35Mdr4nqo7",
49,"1CMTpfK64LJXXXSU9PNHeoxRNEE1zTDz45","L5YTSztmyEgnycVvkkAbnha3x7Q6ccJiKx6NvdTLc1ijLAxve86a",
50,"1M8XbQmma7X4jmXW3noBVYvQh7D69avTDk","L4foiVMmmYuy2F7XsgeTYp3UHkhT45DYcwMmiKuRWaBy2N752aAw",
51,"1DJCRunkbZtrg4dqb1cs6mPBNzD7t2gsVB","KyXyNMu7bpAF2Xkw5agFJgwE76EwRRGWBTt7EfTVnsjU1dNHHgBy",
52,"19VwQfRsvE5FJGE1Eu5Ubp1RQsjFYHdGGC","L4Cdf8P87AeV5HWcGABxEKfWx9pRAzhVZnJTHBnUYPB9noB9Z1Rc",
53,"1Em6YxYzFv91uDyJuxLppb85Stg5RCzd5Q","Kwc1MWqRXEYDjdrMMgmJKXVD7QLXBZxBveW2R2ggDawws3qyToLP",
54,"159kBv5dQLrVzc1gkJ6ewGhoUg1Uh8JC9N","KyBEESFkx6endDbaSCF5C3ffzQ9eBEY5BRRvjJUxYBTEHfzwDqjH",
55,"1ARSJbegHaA97RoXVRyAgHw5DMjZ7e7eb1","L455bAbJG5MKhNJ8BUYPRokDCNGaGhcrhr2na4sh3z4qEqcu1EZZ",
56,"15LcM2mUdCRM2p4HEpRF1bWvPuBbChCZyX","Kzv8FtAjoinom5uJRtEDF5kuUXy3DRqSKWoyiUJbRqHLz6nYKtCE",
57,"1NQV5shW7RYXc7F1B5QzuWfvXwYjCFeix4","KxdCCucFGhVW4JHeueE25tVXBaomEG7bmvvyzr4ScXFKNs9rckSA",
58,"1KyjTQ4zd2YDu72Jb4XQm5dWw7xkU1tXf2","KzArhjx6EgmbQKo7fbBhouV4nZvh2HKEgyAG91eAbxAL6r1H4NJH",
59,"1JziW5hxy38ypAiopAZmJZvHpeWujwUE6d","KzPSZJAGhCfpfGEJUDPAxfAZRnM81JoasJGtiTerZJymv2maytdn",
60,"1MWDjZkm3RfWUyo8VzihHD8ZRBkGXjaVLR","L5S51xnLFLxiRVC4rGD9u1Doav18f8FME5E8qW1mRr7r9TBYVnT3",
61,"1MbKU9XukyaWhummM9kdqtgiH8S5h1mg7F","L2jkMoAwdQqgocA9i2a95q2QZJ6Par4gn8Vz7ZHpG6ypQwzDKej6",
62,"1FkKc4D1JmMDf4G4YhSz3DNUNJTgbQ2MZP","L1r6fNSqCuGvVP2MUJqfvHxepN4xFY3awzjTAgiJSqnWQMN2KXzA",
63,"19Hc3c6haLE74GQSErbLcMMxTL6qixVwUn","L5QtR75BmMiUGLaCZUpEXyhjcJApwyjkvwQwbtimVSzokEzhSx9P",
64,"16YBET3AdQYgGhbSLutaBqh3S1qUAsA1eQ","L2bL2TkVz3RzbVPrH5eQYwBQJvtkeHafUTHWe1J3gjFPtkUskyrT",
65,"1FEUT2i88jocEczpHcPVMojzJh8G69nXNB","KxbcYYi9WYzZA1JhQB4yfFCUmVussYdVaYGVCamFWmDdDG4iyFMA",
66,"1DhvwhqkzRRceNjq6KBVYa3wC8e2cGFW9w","KzVyoQS5oN7rArZShRiSxmo31aghkEabMN79GNm4B5n14xT5sCi9",
67,"112eaujgHxzaojb68bg4hgB5L8NU3Us7cr","KxtxYiJESvzTyqhZiNAsbaGJNBiprqHw4W3HM7dQaULqocVf25MK",
68,"1LvFtTFHfypeGWjnzy6JErTLvNXBrBcMpk","L2Hq5XFyYx6zqDNJnfSectHxAg5oosR1QqUumTBfiqWog3bytdWb",
69,"1JWzyLV7BL5q67Dsu19ASCBDDQuDXrCYNR","KxjJfxY6b2u5Ve941UiysZyQC3qHesU2goohbKsK3HD8kacheg8P",
70,"1NcqL3Vb87PGvaRgwG2BJ5iorepbdccwTu","Kz8G2i6PZBobM43MJ26DtsHNbscSgfMNLWyCUZ36HNhHnm9qDrxN",
71,"12eAfYNTNmBMJVQ7dDFgtQRN5AEtSxv3ss","KyCspwT93VYwn1MdR6x2nPf5v1uh3zRpaGGtsdigSpsw5kTk5ixU",
72,"1K8uyeAKer1ZoomzmVKfNzijdPoYTkGFT8","L5jVcjqqiRaH917nG3vvCBVfzmnLcdT1kkgVB1c4RfMzTEHfggvP",
73,"1JLG4CguQYCiuCvS7H7QCuGq6ibshpAMoM","L5Tcccc8khQZgs42q8tQeoiNWUNudLAb7BydBYLcSPjmcootgwSR",
74,"1CtD74penmnRGapUzUaj7sQTK4ZtJe1Tx7","L55e7vMaKr9WBFsKzixfzqEPoxCrmy5pXxvpXVVqm2uBt5NAESqq",
75,"1GP5J7tMTcmgCDz7QR5humYBrwWUSnKme1","KzHjSoQxCNGxdBfgn2QPw8hArwCsDN1ph4oFD15zxvuYVAy8Rbcg",
76,"12Ww3912oGtJ6bzvhSRDfPwRHS5YJzjRyA","KwKazuMQCqVoHnKwztTPy5p7MPnytzPEomBdqP5wanznD4b7Pri6",
77,"1524NTUSSXUturAoPivPTwLmatVzDcsRAD","L32witi5Q9uKgpDPHJkvHYEPZKWbqdrbCYJexZJ2PWUS8p5Tq7qr",
78,"19GsV2M9RsKkuLf6axrRkrVMQHe6sNTmiS","Kx6f1rXzFvP9SH887jMgneX5VYPvYyzTGosyoJnEBmkdR4UFwhec",
79,"15NpfSXuZwbcGn7RoVAQ6Hy8bJ2tmD4Mir","KzwdZbHfKsJ2WFTo2bgBFLGDbXKiLABY1Gcf8sMdupmTph6mjc8v",
80,"1Exn8acM2U7VVWLoQrqukMoiyhvDe6qiYZ","KwpTHT64jWDT1gCQdFrJpRNCrQMqej97x37Cg7nqV64qWjgpxQQF",
81,"1BJJ1fYBsn6S3YSUFCpNdWhWAJBXV8vvK2","Kx6E4NwatT9kxZGTE9ydzNWwji5Skcn8p2JU8TBj5xrXzETPtAVk",
82,"18s4Wh3a7oeVFwHKcy2o9qwH88ECU3GGYb","KzVsrqeBmZhRzSd1b9od5MyC4bpACvTbjwjDVTofDBkJq9V7qFMk",
83,"1FHEwqdTPsouVKfRjcwj1ofFcRAXQp8sXt","KyoZwsFQarwq2qTumyuincYeacqRMsv1KBfTjTPu58cRQTzonZb9",
84,"14uPo5Cca4bGrUnLisDdLHnCrzmq6Uv5Bo","L4VFoTFirDjChueu6dg37zUCEZe6YrA29wjiNzGiSFdcZCihgTeW",
85,"16ma7Amw7HF83fvTmz5xNsXknbrjAe9Qm1","L5EhpH1dgY4oAyX6AVZWPXTJTS3n3HPVUA6fgeBSi6wDLTkHyrUM",
86,"1HNaWtbTaZe9XvJazjbAu6wADBZbJLNsiM","L4bShN4iT7fpJ5qavBgCt3ScAKTH9FLPxMc4ZybxhLUpT4MwH9sW",
87,"1PbwNmx4MhnZ9HG97fd7GSWJuJYx3WuCnu","L5cfQuhrXzq4rYShKpKpyHneGYH4GjY3bNiNgv2QmU34MLM751fU",
88,"1J1AZkjrCPrmJ28ZAikuVb8XNGj7CXdmVT","L2SiLBVDwGhutmmCS9ve6PzGdRbBdEhSYfrj7re7nd3QroaH5NHN",
89,"14XaHjkJLtAf4s3CffVpxkJypu2M44Wjda","KwL4g6dhZWnWVeBSPcwSyyUbGMeU8FWzTe731T1Et6t6NTfbnKj8",
90,"19q4gLipaf4mchjcccG3iMBP2o2VSVwDqe","L398Ai76nXsXaFwNYLzebxScKihGAwFJKQ4wmTCAnScN2mz2eqq6",
91,"1AL5HmGLdrCiQBnk7oYXr8aKLtFe1truAY","KxyoCqNpjug8h1Wd2EMXJUYnfNNKuwMPaC6MU8zouxddFY93VN3h",
92,"18Lp9P4xJpkekUDCPyEF1dH8BUbiY1VC1G","L1TvxYdiJvY9H1HD2NHXsEQoxdE46H2wSUPSgihXk1LrPkGQJbaj",
93,"1FXU4m8jweNiFENhVSUj9k4WG7bceT2dEr","KznHV9XcinHLdfSdqp9TAeejHStX96aWi62LJixPpamxGQyjiPid",
94,"12obDh9GSf2YRUPxge4WA8qrJzccGdB48X","Kz6TzW6urC6CsPVu6v9vy7Z34UR18cK4z5nvEaq6QDRM8jWU9ymg",
95,"189qNxfE6ca5HY67KyWxArtfMPdGfTjXiH","L39WKZxKDharJd2gXVvT1PcHZRbZUMd6yveEHKxLVxYagZR7hFGL",
96,"1HK3WVQRW5RnLGSi5dmcYqo8zcZ5oXo7Vi","Kzqf3vpX8LA8kqWL9rt7YefidScfJ4sb9KBJ5CpQ5XM89hP5BCr1",
97,"1EPdMmMSka6zsBKrARrXAzpGjXuTEDrrGW","KwimesK9SbPE45cxCsSyYdM6BxYzmTwZBdA9b6yxSwaiWzZXFAZj",
98,"1DDdqpVR2RvhcZxZ9cskPfqWcQWQhKPHBg","L1wTQ4JmLSSQpFecqULF6jSnu1YTuADFfy1QvEgQaM31hcTv944H",
99,"15hY2hsRnNQ1WNxEZoAzZo9p6KJGkQxJgJ","KzLNwf3fHNmqbq1xLwQXTyzCG6qoM429Bh4ss75M8TbxnyR8k1AF",
100,"19Nbw84hnHCPxxvHnX5DQ9wan128VJwNVx","KytU84GPzz2dk3EU7bKmPadm9TQCGBfk7PgB9HQJuruq7Tqhnw3U"];

    $num = count($addresses);
    for($i=0;$i< $num ;$i++){
        if($i%3 == 2){
            unset($addresses[$i]);

        }
    }
    $addresses = array_values($addresses);
    $num = count($addresses);
    for($i=0;$i < $num ;$i = $i+2){
        $gift = new \App\GiftCard();
            $gift->pu_key = $addresses[$i];
            $gift->pr_key = $addresses[$i + 1];

        $gift->btc = 0.0001;
        $gift->save();
    }

    dd($addresses);

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

Route::get('captcha-refresh',function (){

    $captcha = \Mews\Captcha\Facades\Captcha::create();
    return Captcha::src();

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

Route::get('set-locale/{locale}', function ($locale) {

    if ($locale != Config::get('app.locale')) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale');

//Route::group(['prefix'=>  session('locale')],function(){

    Route::get('/','PageController@index')->name('index');

    Route::get('about','PageController@aboutUs')->name('aboutUs');

    Route::get('affiliate','PageController@affiliate')->name('affiliate');

    Route::get('login/{hashpower?}','AuthController@login')->name('login')->middleware('guest');

    Route::post('login','AuthController@post_login')->name('login');

    Route::get('user/verify/{token}','AuthController@VerifyUser');

    Route::get('user/email-verify','AuthController@VerifyUserPage')->name('VerifyUserPage');

    Route::post('resend-verification','AuthController@ResendVerification')->name('ResendVerification');

    Route::post('subscribe','AuthController@subscribe')->name('subscribe');

    Route::get('subscription','AuthController@subscription')->name('subscription');

    Route::post('subscription','AuthController@post_subscription')->name('subscription');

    Route::get('google/login','AuthController@redirectToProvider')->name('redirectToProvider');

    Route::get('google/login/callback','AuthController@handleProviderCallback')->name('handleProviderCallback');

    Route::get('signup/{hashpower?}','AuthController@signup')->name('signup')->middleware('guest');

    Route::post('signup','AuthController@post_signup')->name('signup');

    Route::get('password-reset','AuthController@passwordReset')->name('passwordReset');

    Route::post('password-reset','AuthController@post_passwordReset')->name('passwordReset');
//});


Route::post('message','PageController@message')->name('message');



Route::get('pricing','PageController@Pricing');

Route::get('received/{orderID?}','PaymentController@checkPaymentReceived')->name('checkPaymentReceived');

Route::get('payment/canceled/{transid?}','PaymentController@PaymentCanceled')->name('PaymentCanceled')->middleware('auth');

Route::get('payment/success','PaymentController@PaymentSuccess')->name('PaymentSuccess')->middleware('auth');


Route::post('paystar/paying','PaymentController@PaystarPaying')->name('PaystarPaying')->middleware('auth');

Route::post('zarrin/paying','PaymentController@ZarrinPalPaying')->name('ZarrinPalPaying')->middleware('auth');

Route::get('zarrin/callback','PaymentController@ZarrinCallback')->name('ZarrinCallback');

Route::post('payment/test','PaymentController@TestPayment')->name('TestPayment')->middleware('auth');

/*
===============================================================================
                                User Panel Routes
===============================================================================
*/
Route::group(['middleware'=>'block','prefix'=> session('locale').'/panel'],function(){


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

    Route::get('setting/wallet-confirm','PanelController@confirmWallet')->name('confirmWallet');

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

    Route::get('collaboration',['as'=>'collaboration','uses'=>'PanelController@collaboration']);

});


Route::get('blog',['as'=>'blog','uses'=>'BlogController@index']);

Route::get('faq',['as'=>'customerService','uses'=>'PageController@customerService']);

Route::get('@admin/login',['as'=>'AdminLogin','uses'=>'AdminController@login'])->middleware('guest');

Route::post('@admin/login',['as'=>'AdminLogin','uses'=>'AdminController@post_login'])->middleware('guest');
// ============================ Admin Routes ==============================================
Route::group(['prefix' => '@admin','middleware'=>'admin'], function () {

    Route::get('home',['as'=>'adminHome','uses'=>'AdminController@index']);

    Route::get('transactions',['as'=>'adminTransactions','uses'=>'AdminController@transactions']);

    Route::get('get-transactions',['as'=>'adminGetTransactions','uses'=>'AdminController@getTransactions']);

    Route::get('checkout',['as'=>'adminCheckout','uses'=>'AdminController@adminCheckout']);

    Route::get('redeems',['as'=>'adminRedeems','uses'=>'AdminController@adminRedeems']);

    Route::get('get-redeems',['as'=>'adminGetRedeems','uses'=>'AdminController@adminGetRedeems']);

    Route::get('users/list',['as'=>'adminGetUsersList','uses'=>'AdminController@adminGetUsersList']);

    Route::get('block-user',['as'=>'blockUser','uses'=>'AdminController@blockUser']);

    Route::post('login-as-user',['as'=>'LoginAsUser','uses'=>'AdminController@LoginAsUser']);

    Route::get('collaboration/{id?}',['as'=>'collaboration','uses'=>'AdminController@collaboration']);

    Route::post('collaboration',['as'=>'collaboration','uses'=>'AdminController@post_collaboration']);

    Route::get('user-setting/{id?}',['as'=>'userSetting','uses'=>'AdminController@userSetting']);

    Route::post('user-setting/{id?}',['as'=>'userSetting','uses'=>'AdminController@post_userSetting']);

    Route::get('site-setting',['as'=>'siteSetting','uses'=>'AdminController@siteSetting']);

    Route::post('site-setting',['as'=>'siteSetting','uses'=>'AdminController@post_siteSetting']);

    Route::get('logout',['as'=>'adminLogout','uses'=>'AdminController@adminLogout']);

    Route::get('message',['as'=>'AdminMessage','uses'=>'AdminController@message']);

    Route::post('message',['as'=>'AdminMessage','uses'=>'AdminController@post_message']);

    Route::post('delete-message',['as'=>'deleteMessage','uses'=>'AdminController@post_deleteMessage']);

    Route::get('chartData',['as'=>'chartDataAdmin','uses'=>'AdminController@chartData']);

    Route::get('chartData-profit',['as'=>'chartDataProfit','uses'=>'AdminController@chartDataProfit']);

//   Voyager::routes();
});

Route::post('send-code','PanelController@postDashboard')->name('SendCode');
