<?php

class Notification {

	/**
	* Creates a new notification
	*
	* @param	string	$message - a message override
	* @param	string	$type - a type override
	* @param	string	$title - a title override
	* @access	public
	*/
	public static function show($message = null, $type = 'info', $title = null) {
		// Are there session notifications?
		$notification	= Session::get('notification'); 
		// default data
		$notification	= self::notifications($notification);
                // if message isn't empty
		if (!empty($message)) {
			$notification = array(
				'message'	=> $message,
				'type'		=> $type,
				'title'		=> $title
			);
		// else return false
		} elseif (empty($notification)) {
			return false;
		}		

		$message	= $notification['message'];
		$type		= $notification['type'];

		// create a notification with a title
		if (isset($notification['title']) and !empty($notification['title'])) {
			$message = '<strong>' . $notification['title'] . '</strong><br / > ' . $message;
		}

		$start	= '<div class="alert alert-' . $type . ' fade in"><button type="button" class="close" data-dismiss="alert">&times;</button>';
		$end	= '</div>';

		// output inmediatly
		echo $start . $message . $end;
	}

	/**
	* Defines all the system notifications
	*
	* @access	public $note  anotification
	*/
	public static function notifications($note) {
		switch ($note) {
			// form fields
			case 'form_required':
				return array(
					'message' => 'All fields are required',
					'type'	=> 'warning'
				);
			break;

			case 'form_email_invalid':
				return array(
					'message' => 'Invalid email address',
					'type'	=> 'warning'
				);
			break;

			case 'form_email_exists':
				return array(
					'message' => 'The email address is already registered',
					'type'	=> 'warning'
				);
			break;

			case 'form_user_exists':
				return array(
					'message' => 'The username is already registered',
					'type'	=> 'warning'
				);
			break;

			case 'form_passwords_must_match':
				return array(
					'message' => 'Password fields must match',
					'type'	=> 'warning'
				);
			break;

			case 'form_password_invalid':
				return array(
					'message' => 'Invalid password',
					'type'	=> 'warning'
				);
			break;

			case 'form_emails_must_match':
				return array(
					'message' => 'Email addresses must match',
					'type'	=> 'warning'
				);
			break;
			// ticket messages
			case 'message_add_failed':
				return array(
					'message'	=> 'Error in database',
					'type'		=> 'error'
				);
			break;
			case 'message_add_success':
				return array(
					'message'	=> 'The staff has been notified and will respond as soon as possible',
					'type'		=> 'success',
					'title'		=> 'Check updated'
				);
			break;

			// tickets
			case 'ticket_status_changed':
				return array(
					'message'	=> 'Status of Ticket updated',
					'type'		=> 'info'
				);
			break;

			// settings
			case 'settings_success':
				return array(
					'message'	=> 'Configuration Updated',
					'type'		=> 'success'
				);
			break;

			// users
			case 'user_add_success':
				return array(
					'message'	=> 'User created',
					'type'		=> 'success'
				);
			break;

			case 'user_add_failure':
				return array(
					'message'	=> 'Could not create the user by an unknown error',
					'type'		=> 'success'
				);
			break;
                        case 'user_edit_success':
				return array(
					'message'	=> 'User edited successfully',
					'type'		=> 'success'
				);
			break;

			case 'user_edit_failure':
				return array(
					'message'	=> 'Could not edit the user by an unknown error',
					'type'		=> 'success'
				);
			break;
                        case 'user_password_success':
				return array(
					'message'	=> 'Password edited failure',
					'type'		=> 'success'
				);
			break;

			case 'user_password_failure':
				return array(
					'message'	=> 'Could not edit the user by an unknown error',
					'type'		=> 'success'
				);
			break;
                        case 'user_delete_success':
				return array(
					'message'	=> 'User was deleted',
					'type'		=> 'success'
				);
			break;

			case 'user_delete_failure':
				return array(
					'message'	=> 'Could not delete user',
					'type'		=> 'success'
				);
			break;
			// roles
			case 'roles_assigned':
				return array(
					'message'	=> 'Roles assigned',
					'type'		=> 'success'
				);
			break;


			// departments
			case 'department_members_updated':
				return array(
					'message'	=> 'Department members updated',
					'type'		=> 'success'
				);
			break;

			case 'department_added':
				return array(
					'message'	=> 'New department added',
					'type'		=> 'success'
				);
			break;

			// profile
			case 'profile_password_updated':
				return array(
					'message'	=> 'Password updated',
					'type'		=> 'success'
				);
			break;

			case 'profile_email_updated':
				return array(
					'message'	=> 'E-mail updated',
					'type'		=> 'success'
				);
			break;

			case 'profile_names_alpha_only':
				return array(
					'message'	=> 'Names must be only letters',
					'type'		=> 'warning'
				);
			break;

			case 'profile_user_invalid':
				return array(
					'message'	=> 'Usermame accepts only letters, numbers, and "_"',
					'type'		=> 'success'
				);
			break;

			case 'profile_updated':
				return array(
					'message'	=> 'Last updated',
					'type'		=> 'success'
				);
			break;
		}
	}

	/**
	*
	* @params       string  $note   notification to fetch
	* @return	Array   returns array of notifications
	* @access	public
	*/
	public static function get($note) {
		return self::notifications($note);
	}
}