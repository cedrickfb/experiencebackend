<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('company_name', 100);
			$table->string('show_name', 20);
			$table->string('no_tps', 50);
			$table->float('tps', 10, 0)->nullable()->default(0.05);
			$table->string('no_tvq', 50);
			$table->float('tvq', 10, 0)->nullable()->default(0.09975);
			$table->string('address', 100);
			$table->string('city', 50);
			$table->string('province', 50);
			$table->string('country', 50);
			$table->string('postal_code', 6);
			$table->string('telephone', 9);
			$table->string('fax', 50);
			$table->string('email', 80);
			$table->boolean('active')->default(0);
			$table->float('bonidollar')->default(0.00);
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
		Schema::drop('settings');
	}

}
