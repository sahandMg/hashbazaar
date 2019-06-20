<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
//class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $guarded = [];
    protected $fillable = ['plan_id','email','password','ip','country','block','avatar','total_mining','pending'];

    public function minings(){

        return $this->hasMany(Mining::class);
    }

    public function transactions(){

        return $this->hasMany(Transaction::class);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function referral(){

        return $this->hasOne(Referral::class);
    }
    public function wallet(){

        return $this->hasOne(Wallet::class);
    }

    public static function userPending($userModel){

        $AuthUser = $userModel;
        $pendingBtc = $AuthUser->minings->sum('mined_btc') - $AuthUser->transactions->where('user_id',$AuthUser->id)->where('status','paid')->where('checkout','in')->sum('amount_btc');
        return number_format($pendingBtc,8);
    }
}
