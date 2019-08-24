<?php

namespace App\Http\Controllers\Remote;

use App\Http\Helpers;
use App\Jobs\subscriptionMailJob;
use App\RemoteData;
use App\RemoteUser;
use App\User;
use App\VerifyUser;
use Illuminate\Support\Facades\App;
use Laravel\Socialite\Facades\Socialite;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class RemoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('remoteAuth')->except('remoteApi');
    }

    // Gets Miners data by API
    public function remoteApi(Request $request){

        $remote = new RemoteData();
        $remote->data = serialize($request->minersInfo);
        $data = $request->all();
        $user = DB::connection('mysql')->table('remote_users')->where('code',$data['token'])->first();
        if(is_null($user)){
            return ['error'=> 404 ,'body'=>'Incorrect Token'];
        }else{
            $remote->remote_id = $user->id;
            $remote->save();
        }

        return ['code'=>200,'message'=> 'done'];
    }

    // Shows Miners Data
    public function remoteDataPage(){
        $minerData = DB::connection('mysql')->table('remote_data')->orderBy('id','desc')->where('remote_id',Auth::guard('remote')->id())->first();
        return view('remote.minersStatus',compact('minerData'));
    }


}
