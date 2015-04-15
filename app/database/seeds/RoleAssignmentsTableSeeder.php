<?php

class RoleAssignmentsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('role_assignments')->truncate();
        
		\DB::table('role_assignments')->insert(array (
			0 => 
			array (
				'id' => '1',
				'role_id' => '1',
				'user_id' => '1',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => '4',
				'role_id' => '3',
				'user_id' => '2',
				'created_at' => '2014-06-26 11:51:28',
				'updated_at' => '2014-06-26 11:51:28',
			),
		));
	}

}
