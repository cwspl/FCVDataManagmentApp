<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountNumbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_numbers', function (Blueprint $table) {
            $table->increments('account_number_id');
            $table->integer('customer_id');
            $table->integer('account_number');
            $table->tinyInteger('account_status')->default('1');
            $table->integer('account_expired_at')->nullable()->default(NULL);
            $table->integer('account_created_at')->nullable()->default(NULL);
            $table->integer('account_updated_at')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_numbers');
    }
}
