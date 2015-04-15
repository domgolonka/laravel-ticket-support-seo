<?php
 
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
 
class User
  extends Eloquent
  implements UserInterface, RemindableInterface
{
  
  protected $fillable = array('firstname','lastname','username', 'email', 'password');
  protected $connection = 'mysql';
  protected $table  = "users";
  protected $hidden = ["password"];
  
  public static $rules = array(
    'firstname'=>'required|alpha|min:2',
    'lastname'=>'required|alpha|min:2',
    'email'=>'required|email|unique:users',
    'username'=>'required|alpha_num|between:4,15|unique:users',
    'password'=>'required|alpha_dash|between:6,20|confirmed',
    'password_confirmation'=>'required|alpha_dash|between:6,20'
    );
  
  public function getAuthIdentifier()
  {
    return $this->getKey();
  }
  
  public function getAuthPassword()
  {
    return $this->password;
  } 
  
  public function getRememberToken()
  {
    return $this->remember_token;
  }
  
  public function setRememberToken($value)
  {
    $this->remember_token = $value;
  }
  
  public function getRememberTokenName()
  {
    return "remember_token";
  }
  
  public function getReminderEmail()
  {
    return $this->email;
  }
  public function getId()
  {
      return $this->id;
  }
  public function getFullName()
  {
   return $this->firstname." ".$this->lastname;
  }
  public function getRole() {
      return $this->role_id;
  }
public function getCredits()
    {
        return $this->hasOne('credit');
    }
    
    /** 
	* An user can belong to different departments, and 
	* a department can have a lot of users
	*/
	public function department() {
		return $this->belongsToMany('Department', 'department_members');
	}

	/**
	* An user can have many messages in tickets, but a message
	* can belong only to a single user
	*/
	public function messages() {
		return $this->hasMany('Message');
	}

	/**
	* An user can only be part of one company, but the
	* company can have unlimited users
	*/
	public function company() {
		return $this->hasOne('Company_User');
	}

	/**
	* An user can have only one role
	*/
	public function role() {
		return $this->hasOne('RoleAssignments', 'user_id');

        }
        
        public function userdetails() {
		return $this->hasMany('UserDetails');

        }
        
}