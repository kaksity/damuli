<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetOfficerRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_officer_request', function (Blueprint $table) {
            $table->id();
            $table->string('organizationName');
            $table->string('vehicleType');
            $table->string('vehicleNumber');
            $table->string('activityPeriod');
            $table->string('location');
            $table->string('price');
            $table->string('initialCharges');
            $table->string('accountNumber');
            $table->string('accountName');
            $table->string('bankName');
            $table->string('comment');
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
        Schema::dropIfExists('fleet_officer_request');
    }
}
