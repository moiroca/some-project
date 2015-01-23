<?php

class UserModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function getUser($username, $password)
	{
		return $this->db->select("id,first_name,middle_name,last_name,username,role_id")
						->from("users")
						->where("username",$username)
						->where("password",md5($password))
						->get()
						->result();				
	}
}