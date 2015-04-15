<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDepartmentMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('department_members', function(Blueprint $table)
		{
			$table->foreign('department_id')->references('id')->on('departments')->onUpdate('CASCADE')->onDelete('RESTRICT');
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
		Schema::table('department_members', function(Blueprint $table)
		{
			$table->dropForeign('department_members_department_id_foreign');
			$table->dropForeign('department_members_user_id_foreign');
		});
	}

}
