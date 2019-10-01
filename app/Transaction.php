<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $connection = 'mysql';
    protected $fillable = ['ref_num','card_num'];
    public function user(){

        return $this->belongsTo(User::class);
    }
}
