<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemoteTransaction extends Model
{
    protected $connection = 'mysql';
    protected $fillable = ['status'];

    public function user(){

        return $this->belongsTo(RemoteUser::class);
    }
}
