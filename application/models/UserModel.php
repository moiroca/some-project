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
	public function getUserById($user_id)
	{
		//$this->db->where("id",$user_id);
		//$this->db->select("*");
	}
	public function getOfficeHeadById($user_id)
	{
		$this->db->where("role_id",2);
		$this->db->where("users.id",$user_id);
		$officeHead = $this->db->select("username,users.first_name,users.last_name,middle_name,role_id,status,office_id,users.id as user_id")->from("users")
								->join("office_heads","office_heads.users_id=users.id","inner")
		->get()->result();
		return $officeHead;
	}
	public function getOfficeSecretaryById($user_id)
	{
		$this->db->where("role_id",3);
		$this->db->where("users.id",$user_id);
		$officeSec= $this->db->select("username,users.first_name,users.last_name,middle_name,role_id,status,office_id,users.id as user_id")->from("users")
								->join("secretaries","secretaries.users_id=users.id","inner")
		->get()->result();
		return $officeSec;
	}
}