<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
                 if (Auth::check())
                {
                     $id = Auth::user()->getId();
                }
                
		if (!empty($id)) {

			$user = User::find($id);

			$role = $user->role()->first()->role_id;
                        $userdetails = $user->userdetails();
                        $configtable = ConfigTable::where('id', '1')->first();
                        
			Session::put('firstname', $user->firstname);
			Session::put('lastname', $user->lastname);
			Session::put('username', $user->username);
			Session::put('fullname', $user->fullname);
			Session::put('email', $user->email);
			Session::put('role', $role);
                        Session::put('id', Auth::user()->getId());
			Session::put('status', $user->status);
			Session::put('pagecontainer', $configtable->pagecontainer);
			Session::put('navbar', $configtable->navbar);
			Session::put('header_content', $configtable->header_content);
			if (!empty($user->theme)){
			Session::put('theme',$user->theme);
			}
                        View::share('username', $user->username); // Share $user with all views
			View::share('role', $role); // Share $user with all views
			View::share('firstname', $user->firstname); // Share $user with all views
			View::share('lastname', $user->lastname); // Share $user with all views
			View::share('fullname', $user->fullname); // Share $user with all views
			View::share('userid', User::find($id)); // Share $user with all views
                        View::share('email', $user->email); // Share $user with all views
			View::share('avatar', $user->avatar);
		}
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
