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

Route::get('/','PageController@index')->name('index');

Route::post('message','PageController@message')->name('message');

Route::post('subscribe','AuthController@subscribe')->name('subscribe');

Route::get('subscription','AuthController@subscription')->name('subscription');

Route::post('subscription','AuthController@post_subscription')->name('subscription');

Route::get('pricing','PageController@Pricing');
Route::get('test',function (){

//    subscriptionMailJob::dispatch('sss@gmial.com','dsadsadaxzmczxmczx11231321');


});
