<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname',50)->nullable();
            $table->string('lastname',50)->nullable();
            $table->string('tel_prefix',3)->default('418');
            $table->string('telephone',7);
            $table->string('address',70)->nullable();
            $table->string('city',50)->nullable();
            $table->string('province',25)->default('QC');
            $table->string('country',50)->nullable();
            $table->string('postal_code',7)->nullable();
            $table->mediumText('comments')->nullable();
            $table->string('password',25)->nullable();
            $table->float('credits',8,2)->default(0.00);
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
        Schema::dropIfExists('customers');
    }
}
