<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('firstname', 50);
			$table->string('lastname', 50);
			$table->string('username', 50)->unique('`username_UNIQUE`');
			$table->string('password', 64);
			$table->string('email', 100)->unique('`email_UNIQUE`');
			$table->string('remember_token');
			$table->string('theme', 10);
			$table->string('status', 10)->default('active');
			$table->text('language');
			$table->string('country', 20);
			$table->integer('currency');
			$table->decimal('credit', 10);
			$table->dateTime('lastlogin');
			$table->string('ip', 20);
			$table->string('host');
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
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('users');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
