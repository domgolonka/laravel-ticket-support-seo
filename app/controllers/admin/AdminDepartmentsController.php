<?php

/**
* Manages user roles inside the application
*
*/
class AdminDepartmentsController extends BaseController {

	public $restful = true;

	/**
	* Shows the roles management view
	*
	* @access	public
	* @return	View
	*/
	public function getIndex() {
		$departments	= Department::all();
		$users			= User::all();
		
		// calculate the amount of users each department has
		foreach ($departments as $d) {
			$members[$d->id] = array();
		}

		// yo, it's easier to modify the array this way!
		$dm =& $members;

		foreach ($members as $key => $m) {
			$dm[$key] = count(DepartmentMembers::where('department_id',$key)->get());
		}

		return View::make('admin.departments.index')
			->with('title', 'Departments')
			->with('departments', $departments)
			->with('users', $users)
			->with('members', $members);
	}

	/**
	* Adds a new department
	*
	* @access	public
	*/
	public function postAdd() {
		$department = Input::get('department');

		if (empty($department)) {
			return Redirect::to('admin/departments')
				->with('notification', 'form_required');
		}

		$department = Department::create(array('name' => $department));

		if ($department != false) {
			return Redirect::to('admin/departments')
				->with('notification', 'department_added');
		}
	}

	/**
	* Updates the department members
	*
	* @access	public
	* @return	View
	*/
	public function putUpdateUsers() {
		$users	= Input::get('users');
		$to		= Input::get('to');
		$rules	= array(
			'users'	=> 'required',
			'to'		=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		if ($validation->fails()) {
			return Redirect::to('admin/departments')->with('notification', 'form_required');
		}

		DB::transaction(function() use ($users, $to) {
			// remove previous assignments
			$users_string = implode("','", $users);
			$users_string = "('" . $users_string . "')";

			DepartmentMembers::where('user_id', 'IN', DB::raw($users_string))->delete();

			// assign new memberships
			foreach($users as $user) {
				DepartmentMembers::create(array('user_id' => $user, 'department_id' => $to));
			}
		});

		return Redirect::to('admin/departments')->with('notification', 'department_members_updated');
	}
}