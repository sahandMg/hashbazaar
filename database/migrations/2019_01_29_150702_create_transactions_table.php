<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('addr')->nullable();
            $table->string('country')->nullable();
            $table->string('amount_btc')->nullable();
            $table->string('status')->nullable();
            $table->string('code')->nullable();
            $table->string('checkout')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();
        });
    }
//, , , , , , ,
//, , , , , , , recordCreated
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
