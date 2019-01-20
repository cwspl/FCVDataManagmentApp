<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid', function (Blueprint $table) {
            $table->increments('paid_id');
            $table->integer('customer_id');
            $table->integer('paid_amount');
            $table->integer('paid_at')->nullable()->default(NULL);
            $table->integer('paid_created_at')->nullable()->default(NULL);
            $table->integer('paid_updated_at')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paid');
    }
}
