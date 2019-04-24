<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('sharing_number');
            $table->string('discount');
            $table->string('expired')->default(0);
            $table->string('user_id')->default(serialize([]));
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
        Schema::dropIfExists('custom_codes');
    }
}
