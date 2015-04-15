<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePricingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pricing', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->enum('type', array('product','addon','account'));
			$table->integer('currency');
			$table->integer('relid');
			$table->decimal('monthly', 10);
			$table->decimal('quarterly', 10);
			$table->decimal('semiannually', 10);
			$table->decimal('annually', 10);
			$table->decimal('biennially', 10);
			$table->decimal('triennially', 10);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pricing');
	}

}
