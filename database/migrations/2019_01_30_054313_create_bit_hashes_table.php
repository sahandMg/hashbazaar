<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitHashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bit_hashes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('life')->nullable();
            $table->unsignedInteger('trans_id')->nullable();
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
        Schema::dropIfExists('bit_hashes');
    }
}
