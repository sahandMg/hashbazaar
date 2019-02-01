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
            $table->unsignedInteger('box_id')->nullable();
            $table->string('box_type')->nullable();
            $table->string('order_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('country')->nullable();
            $table->string('coin_label')->nullable();
            $table->string('amount')->nullable();
            $table->string('amount_usd')->nullable();
            $table->string('unrecognised')->nullable();
            $table->string('addr')->nullable();
            $table->string('tx_id')->nullable();
            $table->string('tx_date')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('txConfirmed')->nullable();
            $table->string('tx_check_date')->nullable();
//            $table->string('status')->default('unconfirmed');
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
