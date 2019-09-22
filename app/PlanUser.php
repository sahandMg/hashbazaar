<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanUser extends Model
{
    public $connection = 'mysql';
    public $table = 'plan_user';
}
