<?php

namespace App\Http\Middleware;

use App\Http\Helpers;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd(session()->all());
        $lang = isset($request->lang)?$request->lang:null;
        try {

            $country = strtolower(Location::get(Helpers::userIP())->countryCode);
        } catch (\Exception $exception) {
            $country = 'fr';
        }

        if(Session::has('locale')){
            App::setLocale(Session::get('locale'));
        }elseif(is_null($lang)){
            if($country == 'ir' || empty($country)){

                Session::put('locale','fa');
                App::setLocale('fa');
            }else{
                Session::put('locale','en');
                App::setLocale('en');
            }

        }else{
            Session::put('locale',$lang);
            App::setLocale($lang);
        }
        return $next($request);

    }
}
