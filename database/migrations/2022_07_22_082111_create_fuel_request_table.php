<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_request', function (Blueprint $table) {
            $table->id();
            $table->string('fuelLitre');
            $table->string('fuelPrice');
            $table->string('fuelTotalPrice');
            $table->string('accountNumber');
            $table->string('accountName');
            $table->string('bankName');
            $table->string('fuelComment');
            $table->string('batch');
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
        Schema::dropIfExists('fuel_request');
    }
}
