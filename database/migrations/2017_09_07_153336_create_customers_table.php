<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('firstname', 50)->nullable();
			$table->string('lastname', 50)->nullable();
			$table->string('tel_prefix', 3)->default('418');
			$table->string('telephone', 7)->nullable();
			$table->string('address', 70)->nullable();
			$table->string('city', 50)->nullable();
			$table->string('province', 25)->default('QC');
			$table->string('country', 50)->nullable();
			$table->string('postal_code', 7)->nullable();
			$table->text('comments', 16777215)->nullable();
			$table->string('password', 25)->nullable();
			$table->float('credits')->default(0.00);
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
		Schema::drop('customers');
	}

}
