<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('total_benefit')->default(0);// total_sharing_income benefit
            $table->string('total_sharing_num')->default(0);// number of sharing
            $table->string('total_sharing_income')->default(0);// total amount of money that earned from sharing
            $table->string('user_income_share')->default(0);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('share_level')->default(0);
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
        Schema::dropIfExists('referrals');
    }
}
