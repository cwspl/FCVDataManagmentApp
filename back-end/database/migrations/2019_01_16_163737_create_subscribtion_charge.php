<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionCharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_charges', function (Blueprint $table) {
            $table->increments('charge_id');
            $table->integer('customer_id');
            $table->integer('charge_amount');
            $table->integer('charge_started_at')->nullable()->default(NULL);
            $table->integer('charge_created_at')->nullable()->default(NULL);
            $table->integer('charge_updated_at')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_charges');
    }
}
