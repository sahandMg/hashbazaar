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

        try {

            $country = strtolower(Location::get(Helpers::userIP())->countryCode);
        } catch (\Exception $exception) {
            $country = 'fr';
        }

        if(Session::has('locale')){
            App::setLocale(Session::get('locale'));
        }else{
            if($country == 'ir' || empty($country)){

                Session::put('locale','fa');
                App::setLocale('fa');
            }else{
                Session::put('locale','en');
                App::setLocale('en');
            }

        }
        return $next($request);

    }
}
