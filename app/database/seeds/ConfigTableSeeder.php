<?php

class ConfigTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0'); 
		\DB::table('config')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
        
		\DB::table('config')->insert(array (
			0 => 
			array (
				'id' => '1',
				'navbar' => 'navbar-default',
				'pagecontainer' => 'sidebar-visible-lg',
				'header_content' => '',
			),
		));
	}

}
