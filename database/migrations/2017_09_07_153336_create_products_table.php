<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('codebar', 191);
			$table->boolean('used')->default(0);
			$table->string('name', 191);
			$table->float('original_cost')->default(0.00);
			$table->float('selling_price');
			$table->integer('min_qty')->default(0);
			$table->integer('max_qty')->default(1);
			$table->boolean('tps');
			$table->boolean('tvq');
			$table->float('deposit')->default(0.00);
			$table->boolean('allow_notif')->default(0);
			$table->integer('qty')->nullable()->default(0);
			$table->integer('category_id')->unsigned()->default(0)->index('products_category_id_foreign');
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
		Schema::drop('products');
	}

}
