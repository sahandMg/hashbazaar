<?php

namespace App\Http\Controllers\Test\HashPaymentTest;

use App\HashPaymentTest\ZarrinPal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{

    public function gateTest(){

        return view('test.hashGateTest');
    }
    public function ZarrinPalPaying(Request $request){

        Session::put('planId',$request->plan);
        $zarrin = new ZarrinPal($request);
        $result = $zarrin->create();
        if($result == 200){
            $request->session()->save();
            $this->ZarrinCallback($request);
        }else{
            return 'مشکلی در پرداخت پیش آمده';
        }
    }

    // verify payment status
    // paystar sends transactionID

    public function ZarrinCallback(Request $request){

        $zarrin = new ZarrinPal($request);

        return $zarrin->verify();
    }

}
