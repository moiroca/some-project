<?php

class EmployeeModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function getAllEmployee()
	{
		$this->db->where("role_id",4);
		return $this->db->select("*")->from("users")
						->join("employee","employee.user_id=users.id")
						->get()->result();
	}

	public function getAllEmployeeLastName($lastName)
	{
		return $this->db->select("*")->from("users")
						->where("role_id",3)
						->like("users.last_name",$lastName)
						->get()->result();
	}
	public function getEmployeeById($username)
	{
		return $this->db->select("*")->from("users")
						->where("role_id",3)
						->like("users.username",$username)
						->get()->result();
	}
}