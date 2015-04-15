<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRoleAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('role_assignments', function(Blueprint $table)
		{
			$table->foreign('role_id')->references('id')->on('roles')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('role_assignments', function(Blueprint $table)
		{
			$table->dropForeign('role_assignments_role_id_foreign');
			$table->dropForeign('role_assignments_user_id_foreign');
		});
	}

}
