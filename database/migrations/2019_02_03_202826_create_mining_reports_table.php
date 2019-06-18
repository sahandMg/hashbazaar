<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiningReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mining_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->float('mined_btc')->nullable();
            $table->float('mined_usd')->nullable();
            $table->unsignedInteger('user_id')->nullable();
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('order_id')->nullable();
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
        Schema::dropIfExists('mining_reports');
    }
}
