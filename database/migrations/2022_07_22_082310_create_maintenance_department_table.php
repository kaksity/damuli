<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_department', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('maintenanceStationId');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('phone');
            $table->string('email')->unique();        
            $table->string('position');
            $table->string('address');
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
        Schema::dropIfExists('maintenance_department');
    }
}
