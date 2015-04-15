<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 200)->nullable();
			$table->string('iso_alpha2', 2)->nullable();
			$table->string('iso_alpha3', 3)->nullable();
			$table->integer('iso_numeric')->nullable();
			$table->char('currency_code', 3)->nullable();
			$table->string('currency_name', 32)->nullable();
			$table->string('currrency_symbol', 3)->nullable();
			$table->string('flag', 6)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('countries');
	}

}
