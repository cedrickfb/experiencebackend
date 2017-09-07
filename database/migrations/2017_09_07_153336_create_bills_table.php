<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bills', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type', 50)->default('F');
			$table->float('tps');
			$table->float('tvq');
			$table->float('total');
			$table->float('taxable');
			$table->float('non_taxable');
			$table->float('bonidollars');
			$table->integer('customers_id')->unsigned()->index('bills_customers_id_foreign');
			$table->integer('employees_id')->unsigned()->index('bills_employees_id_foreign');
			$table->integer('company_id')->unsigned()->index('bills_company_id_foreign');
			$table->float('consigne', 10, 0);
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
		Schema::drop('bills');
	}

}
