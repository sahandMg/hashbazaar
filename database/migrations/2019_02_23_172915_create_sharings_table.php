<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sharings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('level');
            $table->string('value');
            $table->integer('sharing_number')->default(100);
            $table->timestamps();
        });

        DB::table('sharings')->insert([
            ['level'=>'1', 'value' => '0','sharing_number'=>0,'created_at'=>\Carbon\Carbon::now()],
            ['level'=>'2', 'value' => '0.01','sharing_number'=>100,'created_at'=>\Carbon\Carbon::now()],
            ['level'=>'3','value' => '0.02','sharing_number'=>500,'created_at'=>\Carbon\Carbon::now()],
            ['level'=>'4','value' => '0.03','sharing_number'=>1000,'created_at'=>\Carbon\Carbon::now()]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sharings');
    }
}
