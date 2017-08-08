<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codebar');
            $table->boolean('used');
            $table->string('name');
            $table->float('original_cost',8,2)->default(0.00);
            $table->float('selling_price',8,2);
            $table->integer('min_qty')->default(0);
            $table->integer('max_qty')->default(1);
            $table->float('deposit',8,2)->default(0.00);
            $table->boolean('allow_notif')->default(false);
            $table->integer('qty');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->boolean('bonidollar')->nullable();
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
        Schema::dropIfExists('products');
    }
}
