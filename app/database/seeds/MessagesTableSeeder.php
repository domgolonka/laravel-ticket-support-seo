<?php

class MessagesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0'); 
		\DB::table('messages')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');         
		DB::statement('SET FOREIGN_KEY_CHECKS = 0'); 
		\DB::table('messages')->insert(array (
			0 => 
			array (
				'id' => '1',
				'ticket_id' => '1',
				'user_id' => '1',
				'content' => 'Message.',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
	}

}
