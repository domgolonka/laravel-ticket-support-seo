<?php

/**
* Manages user roles inside the application
*
*/
class AdminRolesController extends BaseController {

	public $restful = true;

	/**
	* Shows the user's roles
	*
	* @access	public
	* @return	View
	*/
	public function getIndex() {
		$users = User::all();
		
		foreach ($users as $user) {
			$users_array[$user->id] = $user;
		}

		// for quick traversing
		$users = $users_array;

		// users from each role
		$admins		= RoleAssignments::where('role_id',1)->get();
		$supports	= RoleAssignments::where('role_id',2)->get();
		$regulars	= RoleAssignments::where('role_id','>',2)->get();
		
		return View::make('admin.roles.index')
			->with('title', 'Roles')
			->with('users', $users)
			->with('admins', $admins)
			->with('supports', $supports)
			->with('regulars', $regulars);
	}

	/**
	* Update the user roles
	*
	* @return	Redirect
	*/
	public function putUpdate() {
		$input = Input::all();
		$rules = array(
			'users'	=> 'required',
			'action'	=> 'required'
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return Redirect::to('admin/roles')->with('notification', 'form_required');
		}

		DB::transaction(function() use ($input) {
			// remove roles from users
			$sql = RoleAssignments::whereIn('user_id', $input['users'])->delete();

			// add new role assignments
			foreach ($input['users'] as $user) {
				$assignment = new RoleAssignments;
				$assignment->role_id = $input['action'];
				$assignment->user_id = $user;
				$assignment->save();
			}
		});

		return Redirect::to('admin/roles')->with('notification', 'roles_assigned');
	}
}