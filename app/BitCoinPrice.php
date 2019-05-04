<?php
/**
 * Created by PhpStorm.
 * User: Sahand
 * Date: 4/3/19
 * Time: 10:02 AM
 */

namespace App;


class BitCoinPrice
{

    public function getPrice(){

        try{

            $options = array('http' => array('method' => 'GET'));
            $context = stream_context_create($options);
            $contents = file_get_contents('https://www.blockonomics.co/api/price?currency=USD', false, $context);
            $bitCoinPrice = json_decode($contents);
            if ($bitCoinPrice->price == 0) {

                return 'bitcoin api failed';
            }
            return $bitCoinPrice;
        }catch (\Exception $exception){

            return 'bitcoin api failed';
        }
        }

}