<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minings', function (Blueprint $table) {
            $table->increments('id');
            $table->double('mined_btc',10,8)->nullable();
            $table->double('mined_usd',15,8)->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('order_id')->nullable();
            $table->unsignedInteger('block')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minings');
    }
}
