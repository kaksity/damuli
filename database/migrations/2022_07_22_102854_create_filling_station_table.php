<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFillingStationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filling_station', function (Blueprint $table) {
            $table->id();
            $table->string('fillingStationName');
            $table->string('fillingStationLocation');
            $table->string('fillingStationLitres');
            $table->string('fillingStationBalance');
            $table->string('fillingStationTotalLitre');
            $table->string('fillingStationTotalBalance');
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
        Schema::dropIfExists('filling_station');
    }
}
