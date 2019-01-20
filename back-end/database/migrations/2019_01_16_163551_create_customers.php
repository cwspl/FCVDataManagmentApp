<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->integer('area_id');
            $table->string('customer_name');
            $table->string('customer_name_english');
            $table->string('customer_mobile_number');
            $table->tinyInteger('customer_status')->default('1');
            $table->integer('customer_created_at')->nullable()->default(NULL);
            $table->integer('customer_updated_at')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
