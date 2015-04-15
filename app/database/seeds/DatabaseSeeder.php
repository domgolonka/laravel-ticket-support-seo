<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('CountriesTableSeeder');
		$this->call('ConfigTableSeeder');
		$this->call('CreditTableSeeder');
		$this->call('DepartmentsTableSeeder');
		$this->call('DepartmentMembersTableSeeder');
		$this->call('MessagesTableSeeder');
		$this->call('PricingTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('RoleAssignmentsTableSeeder');
		$this->call('SettingsTableSeeder');
		$this->call('TicketsTableSeeder');
		$this->call('UserDetailsTableSeeder');
	}

}