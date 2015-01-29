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
}