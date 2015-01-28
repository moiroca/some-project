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

		$DataUsers = array('last_name' => $this->input->post('lastname'),
						'first_name' => $this->input->post('firstname'),
						'middle_name' => $this->input->post('middlename'),
						'username' => $this->input->post('lnu_id'),
						'role_id' => 2,
						'status' => $this->input->post('status'),
						'password' => md5($this->input->post('lnu_id')));
	
		$this->db->trans_start();
		
		$this->db->insert('users', $DataUsers);
		$userId = $this->db->insert_id();
		$DataOfficeHead = array('office_id' => $this->input->post('office_id'),
								'users_id' => $userId); 
		$this->db->insert('office_heads', $DataOfficeHead);
		
		$this->db->trans_complete();

		return $this->db->trans_status();

	}
	// edit office head
	public function editOfficeHead()
	{
		$id = $this->input->post('usersId');
		$data1 = array(	'last_name' => $this->input->post('lastname'),
						'first_name' => $this->input->post('firstname'),
						'middle_name' => $this->input->post('middlename'),
						'username' => $this->input->post('lnu_id'),
						'password' => md5($this->input->post('lnu_id')),
						'status' => $this->input->post('status'));
						
		$data2 = array('office_id' => $this->input->post('office_id'));
		
		$this->db->where('id',$id);
		$this->db->update('users', $data1);
		
		$this->db->where('users_id',$id);
		$this->db->update('office_heads', $data2);
		

		return $this->db->trans_status();
		
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
		return	$this->db->update('users', $data);
	}
		// return the list of office heads
	public function getOfficeHeads()
	{
		return $this->db->select('users.id, users.last_name, users.first_name,users.username, users.middle_name, users.status,  offices.description, offices.id as officeId')
							->from("office_heads")->join('offices', 'offices.id = office_heads.office_id')->join('users', 'users.id = office_heads.users_id')->get()->result();
	}
	// return the list of secretaries
	public function getSecretaries()
	{
		return $this->db->select('users.id, users.last_name, users.first_name,users.username, users.middle_name, users.status,  offices.description, offices.id as officeId')
							->from("secretaries")->join('offices', 'offices.id = secretaries.office_id')->join('users', 'users.id = secretaries.users_id')->get()->result();
	}
	//add new secretary
	public function addOfficeSecretary()
	{		
		$DataUsers = array('last_name' => $this->input->post('lastname'),
						'first_name' => $this->input->post('firstname'),
						'middle_name' => $this->input->post('middlename'),
						'username' => $this->input->post('lnu_id'),
						'role_id' => 3,
						'status' => $this->input->post('status'),
						'password' => md5($this->input->post('lnu_id')));
	
		$this->db->trans_start();
		
		$this->db->insert('users', $DataUsers);
		$userId = $this->db->insert_id();
		$DataOfficeHead = array('office_id' => $this->input->post('office_id'),
								'users_id' => $userId); 
		$this->db->insert('secretaries', $DataOfficeHead);
		
		$this->db->trans_complete();

		return $this->db->trans_status();
	}
	// edit office Secretary
	public function editOfficeSecretary()
	{
		$id = $this->input->post('usersId');
		$data1 = array(	'last_name' => $this->input->post('lastname'),
						'first_name' => $this->input->post('firstname'),
						'middle_name' => $this->input->post('middlename'),
						'username' => $this->input->post('lnu_id'),
						'password' => md5($this->input->post('lnu_id')),
						'status' => $this->input->post('status'));
		$data2 = array('office_id' => $this->input->post('office_id'));
		$this->db->trans_start();
		
		$this->db->where('id',$id);
		$this->db->update('users', $data1);
		$this->db->where('users_id',$id);
		$this->db->update('secretaries', $data2);
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
		return	$this->db->update('users', $data);
	}
}