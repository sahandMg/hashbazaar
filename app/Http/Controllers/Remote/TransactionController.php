<?php

namespace App\Http\Controllers\Remote;

use App\RemotePaymentGate\Paystar;
use App\RemotePaymentGate\ZarrinPal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function successPayment(){

        return view('Payment.success');
    }

    public function failedPayment(){

        return view('Payment.failed');
    }

    public function ZarrinPalPaying(Request $request){

        $zarrin = new ZarrinPal($request);
        $result = $zarrin->create();
        if($result != 404){
            $request->session()->save();
            return redirect()->to('https://www.zarinpal.com/pg/StartPay/' . $result["Authority"]);
        }else{
            return 'مشکلی در پرداخت پیش آمده';
        }
    }

    public function ZarrinCallback(Request $request){

        $zarrin = new ZarrinPal($request);

        return $zarrin->verify();
    }

    public function PaystarPaying(Request $request){

        $payStar = new Paystar($request);
        $result = $payStar->create();
        if($payStar->create() != 404){
            $request->session()->save();

            return redirect()->to('https://paystar.ir/paying/'.$result);
        }else{
            return 'مشکلی در پرداخت پیش آمده';
        }
    }


    public function PaystarCallback(Request $request){

        $payStar = new Paystar($request);

        return $payStar->verify();

    }
}
