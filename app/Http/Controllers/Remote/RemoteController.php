<?php

namespace App\Http\Controllers\Remote;

use App\Http\Helpers;
use App\Jobs\subscriptionMailJob;
use App\RemoteData;
use App\RemoteUser;
use App\User;
use App\VerifyUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
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

        $requestArr = $request->all();
        if(!isset($requestArr['minersInfo'])){

            return ['code'=>500,'message'=> 'No Info on request'];
        }
        if(!isset($requestArr['id'])){

            return ['code'=>500,'message'=> 'No id on request'];
        }
        $data = $requestArr['minersInfo'];
        $id = $requestArr['id'];
        // ===== removing extra data from miners data
        $counter = count($data);
        for($i=0;$i<count($data);$i++){
            $ip = $data[$i]['ip'];
            for($j= $i+1;$j<$counter;$j++) {
                try {
                    if ($data[$j]['ip'] == $ip) {
                        unset($data[$j]);
                    }
                }catch (\Exception $exception){
                    continue;
                }
            }
            $data = array_values($data);
        }
        // =======
        $remote = new RemoteData();
        $remote->data = serialize($data);
        $user = DB::connection('mysql')->table('remote_users')->where('code',$id)->first();
        if(is_null($user)){
            return ['error'=> 404 ,'body'=>'Incorrect Id'];
        }else{
            $remote->remote_id = $user->id;
            $remote->save();
        }

        return ['code'=>200,'message'=> 'done'];
    }

    // Shows Miners Data
    public function remoteDataPage(){
        $minerData = DB::connection('mysql')->table('remote_data')->orderBy('id','desc')->where('remote_id',Auth::guard('remote')->id())->first();
        return view('remote.panel.dashboard',compact('minerData'));
    }


}
