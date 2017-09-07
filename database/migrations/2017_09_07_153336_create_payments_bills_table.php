<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsBillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments_bills', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('payments_id')->unsigned()->index('payments_bills_payments_id_foreign');
			$table->integer('bills_id')->unsigned()->index('payments_bills_bills_id_foreign');
			$table->float('amount');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments_bills');
	}

}
