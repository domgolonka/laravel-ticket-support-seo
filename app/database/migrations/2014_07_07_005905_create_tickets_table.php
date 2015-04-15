<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('subject', 100);
			$table->text('content');
			$table->bigInteger('reported_by')->unsigned();
			$table->bigInteger('assigned_to')->unsigned()->nullable();
			$table->timestamps();
			$table->string('status', 50)->default('open');
			$table->bigInteger('department')->unsigned()->index('`department_from_ticket_to_department`');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tickets');
	}

}
