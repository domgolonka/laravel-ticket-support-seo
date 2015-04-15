<?php

class SettingsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('settings')->truncate();
        
		\DB::table('settings')->insert(array (
			0 => 
			array (
				'id' => '1',
				'name' => 'smtp_host',
				'value' => 'mail.example.com',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2013-12-10 09:33:28',
			),
			1 => 
			array (
				'id' => '2',
				'name' => 'smtp_port',
				'value' => '587',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2013-12-10 09:33:28',
			),
			2 => 
			array (
				'id' => '3',
				'name' => 'smtp_user',
				'value' => 'user@example.com',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2013-12-10 09:33:28',
			),
			3 => 
			array (
				'id' => '4',
				'name' => 'smtp_pass',
				'value' => 'pass',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2013-12-10 09:33:28',
			),
			4 => 
			array (
				'id' => '5',
				'name' => 'smtp_crypto',
				'value' => 'off',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2013-12-10 09:33:28',
			),
			5 => 
			array (
				'id' => '6',
				'name' => 'smtp_name',
				'value' => 'Name',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2013-12-10 09:33:28',
			),
			6 => 
			array (
				'id' => '7',
				'name' => 'smtp_enabled',
				'value' => '1',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			7 => 
			array (
				'id' => '8',
				'name' => 'per_page',
				'value' => '50',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2013-12-10 09:33:28',
			),
			8 => 
			array (
				'id' => '9',
				'name' => 'system_message',
				'value' => '',
				'created_at' => '2013-05-24 11:55:51',
				'updated_at' => '2013-12-10 09:33:28',
			),
			9 => 
			array (
				'id' => '10',
				'name' => 'system_message_title',
				'value' => '',
				'created_at' => '2013-05-24 11:55:51',
				'updated_at' => '2013-12-10 09:33:28',
			),
		));
	}

}
