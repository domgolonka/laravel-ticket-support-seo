<?php

/**
* Messages model
*
*/
class Message extends Eloquent {
	protected $connection = 'mysql';
        protected $fillable = array('ticket_id', 'content', 'user_id');

	/**
	* Adds a new message to a ticket
	*
	* @param	int		- the ticket id
	* @param	array	- complete data of the ticket
	* @return	bool	- returns true if not failed.
	* @access	public
	*/
	public static function add($ticket_id, $data) {
            
                //check rules first
		$rules = array(
			'content'	=> 'required',
			'user_id'	=> 'required',
			'ticket_id'	=> 'required'
		);

		// if ticket_id is set
		if (!isset($data['ticket_id'])) {
			$data['ticket_id'] = $ticket_id;	
		}

		$validation = Validator::make($data, $rules);

		if ($validation->fails()) {
			return 'validation_failed';
		}

		$insert = array(
			'ticket_id'             => $data['ticket_id'],
			'user_id'		=> $data['user_id'],
			'content'		=> $data['content'],
			'created_at'	=> DB::raw('NOW()'),
			'updated_at'	=> DB::raw('NOW()')
		);

		return DB::table('messages')->insert($insert);
	}
}