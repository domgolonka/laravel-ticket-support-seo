<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCreditTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('credit', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->date('date');
			$table->text('description');
			$table->decimal('amount', 10);
			$table->integer('relid');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('credit');
	}

}
