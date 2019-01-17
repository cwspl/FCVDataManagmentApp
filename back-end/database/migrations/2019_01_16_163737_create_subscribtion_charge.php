<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribtionCharge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribtion_charge', function (Blueprint $table) {
            $table->increments('charge_id');
            $table->integer('customer_id');
            $table->integer('charge_amount');
            $table->timestamp('charge_time_stamp');
            $table->timestamp('created_time_stamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribtion_charge');
    }
}
