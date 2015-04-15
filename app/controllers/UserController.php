<?php
 
class UserController extends BaseController
{
   public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    }
  public function login()
  {
    if ($this->isPostRequest()) {
      $validator = $this->getLoginValidator();
  
      if ($validator->passes()) {
        $credentials = $this->getLoginCredentials();
  
        if (Auth::attempt($credentials)) {
            
          return Redirect::route("user/home");
        }
  
        return Redirect::back()->withErrors([
          "password" => ["Credentials invalid."]
        ]);
      } else {
        return Redirect::back()
          ->withInput()
          ->withErrors($validator);
      }
    }
  
    return View::make("login");
  }
  
  protected function isPostRequest()
  {
    return Input::server("REQUEST_METHOD") == "POST";
  }
  
  protected function getLoginValidator()
  {
    return Validator::make(Input::all(), [
      "username" => "required",
      "password" => "required"
    ]);
  }
  
  protected function getLoginCredentials()
  {
    return [
      "username" => Input::get("username"),
      "password" => Input::get("password")
    ];
  }
  public function logout()
  {
    Auth::logout();
    return Redirect::route("/");
  }
  
  public function profile()
	{
                $configtable = ConfigTable::where('id', '1')->first();
                if (Auth::check())
                {
                     $id = Auth::user()->getId();
                     $name = Auth::user()->getFullName();
                }
		return View::make("clients.profile")->with(array("config" => $configtable,"id" =>$id, "name" =>$name));
	}
  public function getRegister()
  {
    $countries = Country::orderBy('id', 'asc')->lists('name', 'name');   
    return View::make("home/register")->with(array("countries" => $countries));
  }
   public function postCreate() {
         $validator = Validator::make(Input::all(), User::$rules);
 
            if ($validator->passes()) {
            $user = new User;
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
            $user->username = Input::get('username');
            $user->password = Hash::make(Input::get('password'));
            $user->language = Input::get('language');
            $user->country = Input::get('country');
            $user->save();
            $role = new RoleAssignments(array('role_id' => '3'));
            $user->role()->save($role);
            foreach (Input::get('question_1') as $question){
                $userdetails = new UserDetails(array('field'=> "Question", 'value'=> $question));
                $user->userdetails()->save($userdetails);
            }
              return Redirect::to('register')->with('success', 'Thanks for registering!');
            } else {
                return Redirect::to('register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
            }
    }     
}