<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('cryptobox.callback.php','PaymentController@paymentCallback')->name('paymentCallback');

Route::any('payment/confirmed',['as'=>'PaymentConfirmed','uses'=>'PaymentController@PaymentConfirmed']);
Route::any('payment/created',['as'=>'PaymentCreated','uses'=>'PaymentController@PaymentCreated']);
Route::any('payment/failed',['as'=>'PaymentFailed','uses'=>'PaymentController@PaymentFailed']);
Route::any('payment/pending',['as'=>'PaymentPending','uses'=>'PaymentController@PaymentPending']);
Route::any('payment/delayed',['as'=>'PaymentDelayed','uses'=>'PaymentController@PaymentDelayed']);
Route::any('payment/resolved',['as'=>'PaymentResolved','uses'=>'PaymentController@PaymentResolved']);
