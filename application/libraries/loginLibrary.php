<?php

class LoginLibrary
{
	public $ci;
	public function __constuct()
	{
		$this->ci =& get_instance();
	}
	public static function isLoggedIn()
	{
		self::startSession();
		return (isset($_SESSION['user_id']) && $_SESSION['user_id'] != 0)?true:false;
	}
	public static function startSession()
	{
		if(!isset($_SESSION))
		{
			session_start();
		}
	}
	public static function setter($user)
	{
		$_SESSION['user_id']    = $user[0]->id;
		$_SESSION['name']  		= $user[0]->first_name." ".$user[0]->middle_name." ".$user[0]->last_name;
		$_SESSION['user_role']  = $user[0]->role_id;
	}
	public static function resetter()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['name']);
		unset($_SESSION['user_role']);
	}
	public static function goToUser()
	{
		if($_SESSION['user_role'] == 1)
			redirect("administrator/dashboard");
		elseif($_SESSION['user_role'] == 2)
			redirect("OfficeHead");
		else
			redirect("OfficeSecretary");
	}
	public function isLoggedInAdministrator()
	{
		self::startSession();
		return ($_SESSION['user_role']==1)?true:false;
	}
	public function isLoggedInOfficeHead()
	{
		self::startSession();
		return ($_SESSION['user_role']==2)?true:false;
	}
	public function isLoggedInOfficeSecretary()
	{
		self::startSession();
		return ($_SESSION['user_role']==3)?true:false;
	}
	public function loggedInUser()
	{
		self::startSession();
		$user = array(
			'user_id'=> $_SESSION['user_id'],
			'name' => $_SESSION['name'],  	
			'user_role'=>$_SESSION['user_role']
		);
		return $user;
	}
}