<?php

class DepartmentsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0'); 
		\DB::table('departments')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
        
		\DB::table('departments')->insert(array (
			0 => 
			array (
				'id' => '1',
				'name' => 'Technical Support',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => '2',
				'name' => 'Billing Department',
				'created_at' => '2014-06-26 11:55:44',
				'updated_at' => '2014-06-26 11:55:44',
			),
		));
	}

}
