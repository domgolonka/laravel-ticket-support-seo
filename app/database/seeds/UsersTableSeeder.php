<?php

class UsersTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0'); 
		\DB::table('users')->truncate();
        	DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 
		\DB::table('users')->insert(array (
			0 => 
			array (
				'id' => '1',
				'firstname' => 'mx',
				'lastname' => '15',
				'username' => 'admin',
				'password' => '$2a$08$6rofU7gCMChat6QmGt0eL.CkQ3WPXLfs7p5smTwglrsuliWLg/ai2',
				'email' => 'admin@admin.com',
				'remember_token' => 'Uz8dnLH8h23ENp8tAGXhM6jCx5PKj06UCSF5VcdxoA2vann4Vtuq5unqswOr',
				'theme' => '',
				'status' => 'active',
				'language' => '',
				'country' => '',
				'currency' => '0',
				'credit' => '0.00',
				'lastlogin' => '2014-07-06 18:56:33',
				'ip' => '127.0.0.1',
				'host' => 'domz-N550JV',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2014-07-06 18:56:33',
			),
			1 => 
			array (
				'id' => '2',
				'firstname' => 'test',
				'lastname' => 'test',
				'username' => 'test',
				'password' => '$2y$10$o3HX/Lw16CYX5KVpvjXwn.xl4OT.AlZ7fNW5v2tr8n2J0NfcrKkmO',
				'email' => 'test@test.com',
				'remember_token' => '',
				'theme' => '',
				'status' => 'active',
				'language' => '',
				'country' => '',
				'currency' => '0',
				'credit' => '0.00',
				'lastlogin' => '2014-06-27 22:19:26',
				'ip' => '::1',
				'host' => 'domz-PC',
				'created_at' => '2014-06-26 11:38:31',
				'updated_at' => '2014-06-27 22:19:26',
			),
			2 => 
			array (
				'id' => '15',
				'firstname' => 'test',
				'lastname' => 'test',
				'username' => 'test3',
				'password' => '$2y$10$1QcbgSRSLTdtoxnCh7flEO90LDcP8cemsw6VrjAlFrClwoIu0TVIy',
				'email' => 'test3@test.com',
				'remember_token' => 'Bt00167lPDR5eS65ISBjhakrcx0RLsZvPmC6n3l3k1NyftZtnw1BkrdlPwd0',
				'theme' => '',
				'status' => 'active',
				'language' => '',
				'country' => '',
				'currency' => '0',
				'credit' => '0.00',
				'lastlogin' => '2014-06-27 22:17:46',
				'ip' => '::1',
				'host' => '::1',
				'created_at' => '2014-06-26 22:59:33',
				'updated_at' => '2014-06-27 22:19:15',
			),
		));
	}

}
