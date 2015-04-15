<?php

/**
* Member model
*/
class Member extends Eloquent {
	protected $connection = 'mysql';

	// the "pivot" table does not follow conventions
	//public static $table		= 'department_members';
}