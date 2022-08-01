<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_request', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('specification');
            $table->string('quanty');
            $table->string('unitPrice');
            $table->string('totalPrice');
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
        Schema::dropIfExists('admin_request');
    }
}
