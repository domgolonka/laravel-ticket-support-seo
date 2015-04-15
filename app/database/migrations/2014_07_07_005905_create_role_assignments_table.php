<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoleAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_assignments', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('role_id')->unsigned()->index('`role_id_from_role_assignment_to_role`');
			$table->bigInteger('user_id')->unsigned()->index('`user_id_from_role_assignment_to_user`');
			$table->timestamps();
			$table->unique(['role_id','user_id'], '`unique_assignment`');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('role_assignments');
	}

}
