<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitHash extends Model
{
    protected $fillable = ['confirmed','remained_day'];


    public function user(){

        return $this->belongsTo(User::class);
    }
}
