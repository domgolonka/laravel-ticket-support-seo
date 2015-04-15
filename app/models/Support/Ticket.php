<?php

/**
* Ticket model
*/
class Ticket extends Eloquent {
	////public static $timestamps = true;
        protected $connection = 'mysql';
        protected $fillable = array('subject','content', 'department', 'reported_by', 'status', 'assigned_to'); 
	/**
	* A ticket can have several messages, but a message
	* can only belong to one ticket
	*/
	public function messages() {
		return $this->hasMany('Message');
	}
}