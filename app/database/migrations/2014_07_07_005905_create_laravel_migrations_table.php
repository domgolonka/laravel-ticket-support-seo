<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLaravelMigrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laravel_migrations', function(Blueprint $table)
		{
			$table->string('bundle', 50);
			$table->string('name', 200);
			$table->integer('batch');
			$table->primary(['bundle','name']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('laravel_migrations');
	}

}
