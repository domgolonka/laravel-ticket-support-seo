<?php

class TicketsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0'); 
		\DB::table('tickets')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
        
		\DB::table('tickets')->insert(array (
			0 => 
			array (
				'id' => '1',
				'subject' => 'First Ticket',
				'content' => 'This is a first ticket created by Dominik',
				'reported_by' => '1',
				'assigned_to' => NULL,
				'created_at' => '2014-06-26 16:40:15',
				'updated_at' => '2014-06-26 16:40:15',
				'status' => 'hold',
				'department' => '1',
			),
		));
	}

}
