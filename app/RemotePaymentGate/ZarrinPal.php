<?php
namespace App\RemotePaymentGate;

use App\Http\Helpers;
use App\RemoteTransaction;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stevebauman\Location\Facades\Location;

class ZarrinPal
{

    public $request;
    protected $connection = 'mysql';

    public function __construct($request)
    {
        $this->request = $request;
    }
    public function create(){

        $settings = Setting::first();
        $country = strtolower(Location::get(Helpers::userIP())->countryCode);

        $data = array('MerchantID' => $settings->zarrin_pin,
            'Amount' => $this->request->amount,
            'Email' =>  Auth::guard('remote')->user()->email,
            'CallbackURL' => env('Zarrin_Remote_Callback'),
            'Description' => 'فروشگاه اینترنتی قطعات الکترونیکی');
        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        if ($err) {
            return 404;
        } else {
            if ($result["Status"] == '100' ) {

                $trans = new RemoteTransaction();
                $trans->code = strtoupper(uniqid());
                $trans->status = 'unpaid';
                $trans->amount = $this->request->amount;
                $trans->country = $country;
                $trans->authority = $result['Authority'];
                $trans->save();

                return $result;
            } else {
                return 404;
            }
        }

    }

    public function verify(){

        $transactionId = $this->request->Authority;
        $trans = RemoteTransaction::where('authority',$transactionId)->first();
        if(is_null($trans)){
            return 'کد تراکنش نادرست است';
        }
        $settings = Setting::first();

        $data = array('MerchantID' => $settings->zarrin_pin, 'Authority' => $transactionId, 'Amount'=>$trans->amount);

        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            if ($result['Status'] == '100') {

                $this->ZarrinPaymentConfirm($trans);

                return redirect()->route('RemotePaymentSuccess');

            } else {

                return redirect()->route('RemotePaymentCanceled', ['transid' => $trans->code]);
            }
        }
    }
    private function ZarrinPaymentConfirm($trans)
    {

        $transactionId = $trans->code;
        $orderID = $transactionId;
        // update created transaction record
        DB::connection('mysql')->table('remote_transactions')->where('code', $orderID)->update([
            'status' => 'paid'
        ]);
        // TODO Transaction Mail
//        Mail::send('email.paymentConfirmed', ['hashPower' => $hashPower, 'trans' => $trans], function ($message) use ($user) {
//            $message->from('Admin@HashBazaar');
//            $message->to($user->email);
//            $message->subject('Payment Confirmed');
//        });
//
//        Mail::send('email.newTrans', [], function ($message) use ($user) {
//            $message->from('Admin@HashBazaar');
//            $message->to('Admin@HashBazaar');
//            $message->subject('New Payment');
//        });
    }

}
