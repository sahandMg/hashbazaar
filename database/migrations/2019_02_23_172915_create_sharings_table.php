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
            $table->timestamps();
        });

        DB::table('sharings')->insert([
            ['level'=>'1', 'value' => '0.01','created_at'=>\Carbon\Carbon::now()],
            ['level'=>'2','value' => '0.02','created_at'=>\Carbon\Carbon::now()],
            ['level'=>'3','value' => '0.03','created_at'=>\Carbon\Carbon::now()]
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
