<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name',100);
            $table->string('no_tps',50);
            $table->string('no_tvq',50);
            $table->string('address',100);
            $table->string('city',50);
            $table->string('province',50);
            $table->string('country',50);
            $table->string('postal_code',6);
            $table->string('telephone',9);
            $table->string('fax',50);
            $table->string('email',80);
            $table->boolean('active')->default(false);
            $table->float('bonidollar',8,2)->default(0.00);
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
        Schema::dropIfExists('settings');
    }
}
