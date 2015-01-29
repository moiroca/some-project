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
		
		$this->db->where("users.id",$user_id);
		$user = $this->db->select("users.first_name,users.id as id, users.last_name,users.middle_name, users.username,users.status")->from("users")
						 ->join("roles","roles.id = users.role_id","inner")->get()->result();
		return $user;
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
	public function matchOldPassword($user_id,$password)
	{
		$this->db->where("id",$user_id);
		$this->db->where("password",md5($password));
		
		return $this->db->select("*")->from("users")->get()->result();
	}
	public function updateUserCredentials()
	{
		$newPassword = $this->input->post("newpassword");
		
		$user_id = $this->input->post("user_id");
		
		$this->db->where("id",$user_id);
		
		$data = array(
			'password' => md5($newPassword)
		);
		
		return $this->db->update("users",$data);
	}
	public function updatePersonalInformation()
	{
		$username = $this->input->post("username");
		$firstname = $this->input->post("firstname");
		$lastname = $this->input->post("lastname");
		$middlename = $this->input->post("middlename");
		$user_id = loginLibrary::loggedInUser()['user_id'];
		
		$returnData = false;
		if($this->isUserNameExist($user_id,$username,TRUE))
		{
			$returnData = true;
		}
		$data = array(
			'username' => $username,
			'last_name' => $lastname,
			'middle_name' => $middlename,
			'first_name' => $firstname
		);
		
		$this->db->where("id",$user_id);
		$update = $this->db->update("users",$data);
		
		return $returnData;
	}
	public function isUserNameExist($user_id,$username,$willUpdate = false)
	{
		$this->db->where("username",$username);
		if($willUpdate)
		{
			$this->db->where("id",$user_id);
		}else
			$this->db->where("id !=",$user_id);
		
		$user = $this->db->select("*")->from("users")->get()->result();
		return (empty($user))?false:true;
	}
	public function updateUserPassword()
	{
		$user_id = $this->input->post("user_id");
		$password = $this->input->post("newpassword");
		
		$this->db->where("id",$user_id);
		return $this->db->update("users",array('password' => md5($password)));
		
	}
}