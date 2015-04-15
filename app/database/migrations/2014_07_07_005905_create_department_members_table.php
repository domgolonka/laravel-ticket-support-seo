<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartmentMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('department_members', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('department_id')->unsigned()->index('`department_id_from_department_member_to_department`');
			$table->bigInteger('user_id')->unsigned()->index('`user_id_from_department_member_to_user`');
			$table->timestamps();
			$table->index(['department_id','user_id'], '`unique_user`');
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
		Schema::drop('department_members');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
