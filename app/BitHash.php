<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitHash extends Model
{
    protected $fillable = ['confirmed','remained_day'];
    protected $connection = 'mysql';

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function plan(){

        return $this->belongsTo(Plan::class,'plan_id');
    }
}
