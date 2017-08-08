<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payments_id')->unsigned();
            $table->foreign('payments_id')->references('id')->on('payments');
            $table->integer('bills_id')->unsigned();
            $table->foreign('bills_id')->references('id')->on('bills');
            $table->float('amount',8,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments_bills');
    }
}
