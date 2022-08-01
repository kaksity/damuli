<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_maintenance', function (Blueprint $table) {
            $table->id();
            $table->string('vehicleId');
            $table->string('fleetId');
            $table->string('maintenanceStationId');
            $table->string('maintenanceType');
            $table->string('maintenanceTotalPrice');
            $table->string('accountNumber');
            $table->string('accountName');
            $table->string('bankName');            
            $table->string('maintenanceStatus');            
            $table->string('maintenanceComment');
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
        Schema::dropIfExists('vehicles_maintenance');
    }
}
