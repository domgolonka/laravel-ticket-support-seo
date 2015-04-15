<?php

/**
* Mmnages users and roles in the system
*
* @package		SAAV
*/
class AdminUsersController extends BaseController {

	public $restful = true;

	/**
	* Shows the users list and new user form
	*
	* @access	public
	* @return	View
	*/
	public function getIndex() {
		$users = User::orderBy('id', 'desc')->paginate(10);

		return View::make('admin.users.index')
		->with('title', 'Users')
		->with('users', $users);
	}
        /**
	* Deletes a user(get)
	*
	* @access	public
	* @return	View
	*/
	public function getDelete($input) {
                $user = User::find($input);
                $user->delete();
		if ($user != false) {
			return Redirect::to('admin/users')->with('notification', 'user_delete_success');
		} else {
			return Redirect::to('admin/users')->with('notification', 'user_delete_failure');
		}
	}
        /**
	* Edits a user (get)
	*
	* @access	public
	* @return	View
	*/
	public function getEdit($input) {
                $user = User::find($input);
		return View::make('admin.users.edit')
		->with('title', 'Users')
		->with('id', $input)
                ->with('user', $user);
	}
        
         /**
	* Edits a user (post)
	*
	* @access	public
	* @return	View
	*/
	public function postEdit($id) {
                $input = Input::all();
		$input	= array(
			'firstname'	=> $input['firstname'],
			'lastname'	=> $input['lastname'],
			'username'	=> $input['username'],
			'email'		=> $input['email'],
		); 
                $rules = array(
			'firstname' 	=> 'required',
			'lastname'		=> 'required',
			'email'  		=> 'required',
			'username'		=> 'required',
		);
                $validator = Validator::make($input, $rules);

		// validation not passed, redirect
		if ($validator->fails())
                {
                    return Redirect::to('admin/users')->withErrors($validator);
                }
                
                $user = User::find($id);

                $user->firstname = $input['firstname'];
                $user->lastname = $input['lastname'];
                $user->username = $input['username'];
                $user->email = $input['email'];

                $user->save();
                if ($user != false) {
			return Redirect::to('admin/users')->with('notification', 'user_edit_success');
		} else {
			return Redirect::to('admin/users')->with('notification', 'user_edit_failure');
		}
	}
        
         /**
	* Edits a password (get)
	*
	* @access	public
	* @return	View
	*/
	public function getPassword($input) {
                $user = User::find($input);
		return View::make('admin.users.password')
		->with('title', 'Users')
		->with('id', $input)
                ->with('user', $user);
	}
        
         /**
	* Edits a password (post)
	*
	* @access	public
	* @return	View
	*/
	public function postPassword($id) {
                $input = Input::all();
		$input	= array(
			'password'	=> Hash::make($input['password']),
                        'repassword'	=> Hash::make($input['repassword']),
		); 
                $rules = array(
			'password'		=> 'required',
			'repassword'	=> 'required',
		);
                $validator = Validator::make($input, $rules);

		// validation not passed, redirect
		if ($validator->fails())
                {
                    return Redirect::to('admin/users')->withErrors($validator);
                }
                
                $user = User::find($id);

               $user->password = Hash::make($input['password']);

                $user->save();
                
                if ($user != false) {
			return Redirect::to('admin/users')->with('notification', 'user_password_success');
		} else {
			return Redirect::to('admin/users')->with('notification', 'user_password_failure');
		}
	}
	/**
	* Inserts a new user into the database
	*
	* @access public
	* @return Redirect
	*/
	public function postNew() {
		// get all the information and validate it
		$input = Input::all();
		$validated = $this->validate($input);

		// validation not passed, redirect
		if ($validated !== true) {
			$redirect =& $validated; // redirect 
			return $redirect->withInput('only', array('firstname', 'lastname', 'username', 'email'));
		}
                
		$user = User::create(array(
			'firstname'	=> $input['firstname'],
			'lastname'	=> $input['lastname'],
			'username'	=> $input['username'],
			'password'	=> Hash::make($input['password']),
			'email'		=> $input['email'],
		));

		//$user->company()->insert(array('company_id' => $input['company']));
                $role = new RoleAssignments(array('role_id' => '3'));
                $role = $user->role()->save($role);
		if ($user != false) {
			return Redirect::to('admin/users')->with('notification', 'user_add_success');
		} else {
			return Redirect::to('admin/users')->with('notification', 'user_add_failure');
		}
	}

	/**
	* Checks if the new user form is valid to insert
	*
	* @param		array	- the data taken from Input:all()
	* @return	Redirect|bool
	* @access	public
	*/
	public function validate($input) {
		$rules = array(
			'firstname' 	=> 'required',
			'lastname'		=> 'required',
			'email'  		=> 'required',
			'username'		=> 'required',
			'password'		=> 'required',
			'repassword'	=> 'required',
		);

		// all fields required
		$validation	= Validator::make($input, $rules);
		$redirect	= Redirect::to('admin/users');

		if ($validation->fails()) {
			return $redirect->with('notification', 'form_required');
		}

		// email must be valid
		$rules		= array('email' => 'email');
		$validation	= Validator::make($input, $rules);

		if ($validation->fails()) {
			return $redirect->with('notification', 'form_email_invalid');
		}

		// email must be unique
		$rules		= array('email' => 'unique:users');
		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return $redirect->with('notification', 'form_email_exists');
		}

		// username must be unique
		$rules		= array('username' => 'unique:users');
		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return $redirect->with('notification', 'form_user_exists');
		}

		// passwords must matcj
		$rules		= array('repassword' => 'same:password');
		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return $redirect->with('notification', 'form_passwords_must_match');
		}

		return true;
	}
}