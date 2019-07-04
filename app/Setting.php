<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['available_th','usd_toman','total_th','usd_per_hash',
        'usd_toman','maintenance_fee_per_th_per_day','bitcoin_income_per_month_per_th',
        'available_th','sharing_discount','hash_life','minimum_redeem','zarrin_active','paystar_active','alarms'
    ];

}
