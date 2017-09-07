<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 80);
			$table->text('description', 16777215)->nullable();
			$table->integer('qty')->default(1);
			$table->boolean('received')->default(0);
			$table->integer('trades_id')->unsigned()->index('order_details_trades_id_foreign');
			$table->integer('products_id')->unsigned()->index('order_details_products_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_details');
	}

}
