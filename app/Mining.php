<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mining extends Model
{
    protected $fillable = ['mined_btc','mined_usd','block'];
}
