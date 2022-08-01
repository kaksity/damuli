<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_request', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('specification');
            $table->string('unitPrice');
            $table->string('accountNumber');
            $table->string('accountName');
            $table->string('bankName');
            $table->string('comment');
            $table->string('status');
            $table->string('user');
            $table->string('verify');
            $table->string('approve');
            $table->string('pay');
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
        Schema::dropIfExists('finance_request');
    }
}
