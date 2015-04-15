<?php

/**
* Department model
*
*/
class Department extends Eloquent {
	protected $connection = 'mysql';
        protected $fillable = array('name');  
	/** 
	* A department can have lots of users, and 
	* the same user can belong to different departments
	*/
	public function user() {
		return $this->belongsToMany('User', 'department_members');
	}

	/**
	* Alias of $this->user()
	*/
	public function users() {
		return $this->belongsToMany('User', 'department_members');
	}
}