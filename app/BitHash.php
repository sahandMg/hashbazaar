<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitHash extends Model
{
    protected $fillable = ['confirmed','remained_day'];
}
