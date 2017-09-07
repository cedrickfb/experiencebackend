<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillsDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bills_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('qty');
			$table->float('discount')->default(0.00);
			$table->integer('bill_id')->unsigned()->index('bills_details_bill_id_foreign');
			$table->integer('products_id')->unsigned()->index('bills_details_products_id_foreign');
			$table->float('bonidollar')->default(0.00);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bills_details');
	}

}
