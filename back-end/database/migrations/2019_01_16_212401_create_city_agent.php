<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityAgent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_agents', function (Blueprint $table) {
            $table->increments('agent_id');
            $table->string('agent_name');
            $table->string('agent_email_address');
            $table->string('agent_phone_number');
            $table->string('password');
            $table->integer('agent_created_at')->nullable()->default(NULL);
            $table->integer('agent_updated_at')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_agents');
    }
}
