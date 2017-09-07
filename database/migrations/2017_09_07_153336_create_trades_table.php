<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('description', 16777215)->nullable();
			$table->float('amount')->default(0.00);
			$table->integer('qty');
			$table->integer('customers_id')->unsigned()->index('trades_customers_id_foreign');
			$table->integer('employees_id')->unsigned()->index('trades_employees_id_foreign');
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
		Schema::drop('trades');
	}

}
