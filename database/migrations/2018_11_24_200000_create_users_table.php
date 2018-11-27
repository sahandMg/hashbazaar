<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('reset_password')->nullable();
            $table->string('code');
            $table->index('code');
            $table->float('interest')->nullable();
            $table->unsignedInteger('plan_id')->default(1);
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->unsignedInteger('period_id')->default(1);
            $table->foreign('period_id')->references('id')->on('periods');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
