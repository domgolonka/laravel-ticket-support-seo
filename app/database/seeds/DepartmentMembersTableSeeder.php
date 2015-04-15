<?php

class DepartmentMembersTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0'); 
		\DB::table('department_members')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
        
		\DB::table('department_members')->insert(array (
			0 => 
			array (
				'id' => '1',
				'department_id' => '1',
				'user_id' => '1',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => '2',
				'department_id' => '2',
				'user_id' => '1',
				'created_at' => '2014-06-26 11:58:18',
				'updated_at' => '2014-06-26 11:58:18',
			),
		));
	}

}
