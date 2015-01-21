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
	public function editOfficeById()
	{
		$id = $this->input->get('id');
		$data = array('description' => $this->input->get('description'));
		
		$this->db->where('id',$id);
		return	$this->db->update('offices', $data);
	}

	//add new name of office
	public function addOffice()
	{
		
		$data = array('description' => $this->input->post('description'));
	
		return	$this->db->insert('offices', $data);
	}
	// add new office head
	public function addOfficeHead()
	{
		$data = array('office_id' => $this->input->post('office_id'),
						'lastname' => $this->input->post('lastname'),
						'firstname' => $this->input->post('firstname'),
						'middlename' => $this->input->post('middlename'),
						'username' => $this->input->post('lnu_id'),
						'password' => sha1($this->input->post('lnu_id')),
						'status' => $this->input->post('status'));
	
		return	$this->db->insert('office_heads', $data);
	}
	// edit office head
	public function editOfficeHead()
	{
		$id = $this->input->post('officeHeadId');
		$data = array('office_id' => $this->input->post('office_id'),
						'lastname' => $this->input->post('lastname'),
						'firstname' => $this->input->post('firstname'),
						'middlename' => $this->input->post('middlename'),
						'username' => $this->input->post('lnu_id'),
						'password' => sha1($this->input->post('lnu_id')),
						'status' => $this->input->post('status'));
	
		
		$this->db->where('id',$id);
		return	$this->db->update('office_heads', $data);
	}
	// change the current status of the office head
	public function changeStatusOfficeHead()
	{
		$id = $this->input->get('id');
		if ($this->input->get('status')==1) {
			$status = 0;
		}else{
			$status = 1;
		}
		$data = array('status' => $status);
		
		$this->db->where('id',$id);
		return	$this->db->update('office_heads', $data);
	}
		// return the list of office heads
	public function getOfficeHeads()
	{
		return $this->db->select('office_heads.id, office_heads.lastname, office_heads.firstname,office_heads.username, office_heads.middlename, office_heads.status,  offices.description, offices.id as officeId')
							->from("office_heads")->join('offices', 'offices.id = office_heads.office_id')->get()->result();
	}
	// return the list of secretaries
	public function getSecretaries()
	{
		return $this->db->select('secretaries.id,  secretaries.lastname, secretaries.firstname, secretaries.middlename, offices.description, secretaries.status, secretaries.username, , offices.id as officeId')
							->from("secretaries")->join('offices', 'offices.id = secretaries.office_id')->order_by("offices.description", "asc")->get()->result();
	}
	//add new secretary
	public function addOfficeSecretary()
	{
		$data = array('office_id' => $this->input->post('office_id'),
						'lastname' => $this->input->post('lastname'),
						'firstname' => $this->input->post('firstname'),
						'middlename' => $this->input->post('middlename'),
						'username' => $this->input->post('lnu_id'),
						'password' => sha1($this->input->post('lnu_id')),
						'status' => $this->input->post('status'));
	
		return	$this->db->insert('secretaries', $data);
	}
	// edit office Secretary
	public function editOfficeSecretary()
	{
		$id = $this->input->post('officeHeadId');
		$data = array('office_id' => $this->input->post('office_id'),
						'lastname' => $this->input->post('lastname'),
						'firstname' => $this->input->post('firstname'),
						'middlename' => $this->input->post('middlename'),
						'username' => $this->input->post('lnu_id'),
						'password' => sha1($this->input->post('lnu_id')),
						'status' => $this->input->post('status'));
	
		
		$this->db->where('id',$id);
		return	$this->db->update('secretaries', $data);
	}
	// change the current status of the office secretary
	public function changeStatusOfficeSecretary()
	{
		$id = $this->input->get('id');
		if ($this->input->get('status')==1) {
			$status = 0;
		}else{
			$status = 1;
		}
		$data = array('status' => $status);
		
		$this->db->where('id',$id);
		return	$this->db->update('secretaries', $data);
	}
}