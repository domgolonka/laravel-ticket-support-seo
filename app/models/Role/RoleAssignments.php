<?php


class RoleAssignments extends Eloquent {
	protected $connection = 'mysql';
        protected $fillable = array('role_id');

	/**
	* A role can have several users
	**/
	public function users() {
		return $this->hasMany('User');
	}
}