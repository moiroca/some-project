<?php

class OfficesModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function getOffices()
	{
		return $this->db->select("*")->from("offices")->get()->result();
	}
	public function deleteOfficeById()
	{
		$id = $this->input->get('id');
		
		$this->db->where('id',$id);
		return	$this->db->delete('offices');
	}
}