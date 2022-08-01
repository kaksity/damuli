<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization', function (Blueprint $table) {
            $table->id();
            $table->string('organizationName');
            $table->string('activityType');
            $table->string('vehicleType');
            $table->string('activityLocation');
            $table->string('organizationPrice');
            $table->string('organizationPriceUnit');
            $table->string('organizationTotalPrice');
            $table->string('organizationContractStart');
            $table->string('organizationContractEnd');
            $table->string('organizationContractDays');
            $table->string('organizationStatus');
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
        Schema::dropIfExists('organization');
    }
}
