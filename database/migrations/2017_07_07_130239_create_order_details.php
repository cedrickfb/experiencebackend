<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',80);
            $table->mediumText('description')->nullable();
            $table->integer('qty')->default(1);
            $table->boolean('received')->default(0);
            $table->integer('trades_id')->unsigned();
            $table->foreign('trades_id')->references('id')->on('trades');
            $table->integer('products_id')->unsigned();
            $table->foreign('products_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
