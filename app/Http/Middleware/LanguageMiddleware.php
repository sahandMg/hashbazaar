<?php

namespace App\Http\Middleware;

use App\Http\Helpers;
use Closure;
use Illuminate\Support\Facades\Config;
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

        try{

            $country = strtolower(Location::get(Helpers::userIP())->countryCode);
        }catch (\Exception $exception){
            $country = 'fr';
        }

        if($country == 'ir' || empty($country)){

            Config::set('app.locale','fa');
        }else{
            Config::set('app.locale','en');
        }
        
        return $next($request);

    }


}
