<?php

use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type')->default('BTC');
            $table->string('value')->nullable();
            $table->timestamps();
        });
        DB::table('plans')->insert(
            [
          ['name'=>'lt0.5','created_at'=>Carbon::now()],
          ['name'=>'0.5-1','created_at'=>Carbon::now()],
          ['name'=>'1-2','created_at'=>Carbon::now()],
          ['name'=>'gt2','created_at'=>Carbon::now()]
        ]
      );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
