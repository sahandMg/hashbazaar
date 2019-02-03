<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->float('total_th')->nullable();
            $table->float('usd_per_hash')->nullable();
            $table->float('maintenance_fee_per_th_per_day')->nullable();
            $table->float('bitcoin_income_per_month_per_th')->nullable();
            $table->float('available_th')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert([
            'total_th'=> 14,
            'available_th'=> 14,
            'usd_per_hash'=>50,
            'maintenance_fee_per_th_per_day'=> 0.5,
            'bitcoin_income_per_month_per_th'=> 0.1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
