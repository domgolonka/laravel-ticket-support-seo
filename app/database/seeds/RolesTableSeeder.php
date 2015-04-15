<?php

class RolesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0'); 
		\DB::table('roles')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
        
		\DB::table('roles')->insert(array (
			0 => 
			array (
				'id' => '1',
				'name' => 'Administrator',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => '3',
				'name' => 'Member',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
