<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesFuelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_fuel', function (Blueprint $table) {
            $table->id();
            $table->string('vehicleId');
            $table->string('fleetId');
            $table->string('fillingStationId');
            $table->string('fuelLitre');
            $table->string('fuelPrice');
            $table->string('fuelTotalPrice');
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
        Schema::dropIfExists('vehicles_fuel');
    }
}
