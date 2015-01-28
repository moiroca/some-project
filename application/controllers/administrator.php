<?php

class Administrator extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function dashboard()
	{
		if(!loginLibrary::isLoggedIn())
			redirect("login");
		
		$data = array(
			'content' => 'administrator/dashboard'
		);
		$this->load->view("template/content",$data);
	}
	// this will display the name of offices
	public function office()
	{
		$this->load->model("OfficesModel");
		
		$data = array(
			'content' => 'administrator/office/index',
			'offices' => $this->OfficesModel->getOffices(),
			'js'	  => array(
				'bootbox.min',
				'administrator/main'
			)
		);
		$this->load->view('template/content',$data);
	}

	// delete an office using office id
	public function deleteOffice()
	{
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$this->load->model("OfficesModel");
			
			$del = $this->OfficesModel->deleteOfficeById();
			redirect("office");
		}
		else
		{
			show_404();
		}
	}

	// edit the office name
	public function editOffice()
	{
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$this->load->model("OfficesModel");
			
			$del = $this->OfficesModel->editOfficeById();
			redirect("office");
		}
		else
		{
			show_404();
		}
	}
	// Add new office
	public function addOffice()
	{
		
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('description', 'Office name', 'required|min_length[3]|max_length[15]|xss_clean');

			if ($this->form_validation->run() == FALSE){
				$data = array(
					'content' => 'administrator/office/addOffice'
				);
				$this->load->view('template/content',$data);
			}else{
				$this->load->model("OfficesModel");
				$add = $this->OfficesModel->addOffice();
				redirect("office");
			}
		}else{
			show_404();
		}
	}
	// Display the form for adding new office
	public function addOfficeForm()
	{
		$this->load->library('form_validation');

		$data = array(
			'content' => 'administrator/office/addOffice',
			'js'	  => array(
				'bootbox.min',
				'administrator/main')
			);
		$this->load->view('template/content',$data);
		
	}


	// working with office heads

	// display office heads
	public function officeHead()
	{
		$this->load->model("OfficesModel");
		
		$data = array(
			'content' => 'administrator/officeHeads/index',
			'officeHeads' => $this->OfficesModel->getOfficeHeads(),
			'js'	  => array(
				'bootbox.min',
				'administrator/main'
			)
		);
		$this->load->view('template/content',$data);
	}

	// add the new office head
	public function addOfficeHead()
	{

		if(isset($_SERVER['HTTP_REFERER']))
		{

			$this->load->library('form_validation');
			$this->load->model("OfficesModel");
			$this->form_validation->set_rules('office_id', 'Office', 'required');
			$this->form_validation->set_rules('firstname', 'Firstname', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('lastname', 'Lastname', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('middlename', 'Middlename', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('lnu_id', 'LNU ID', 'required|max_length[50]|is_unique[users.username]');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE){
				$data = array(
					'content' => 'administrator/officeHeads/addOfficeHead',
					'offices' => $this->OfficesModel->getOffices()
				);
				$this->load->view('template/content',$data);
			}else{
				$add = $this->OfficesModel->addOfficeHead();
				redirect("officeHead");
			}
		}
		else
		{
			show_404();
		}
	}
	// display office head form
	public function addOfficeHeadForm()
	{
		$this->load->library('form_validation');

		$this->load->model("OfficesModel");

		$data = array(
			'content' => 'administrator/officeHeads/addOfficeHead',
			'offices' => $this->OfficesModel->getOffices()
			);
		$this->load->view('template/content',$data);
	}

	// edit the office head info
	public function editOfficeHead()
	{
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$this->load->model("OfficesModel");
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('office_id', 'Office', 'required');
			$this->form_validation->set_rules('firstname', 'Firstname', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('lastname', 'lastname', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('middlename', 'Middlename', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('lnu_id', 'LNU ID', 'required|max_length[50]');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE){
				$data = array(
					'content' => 'administrator/officeHeads/index',
					'officeHeads' => $this->OfficesModel->getOfficeHeads(),
					'js'	  => array(
						'bootbox.min',
						'administrator/main'
					)
				);
				$this->load->view('template/content',$data);
			}else{
				$edit = $this->OfficesModel->editOfficeHead();
				redirect("officeHead");
			}

			
		}
		else
		{
			show_404();
		}
	}
	// display the form for editing office head
	public function editOfficeHeadForm()
	{
		$this->load->model("OfficesModel");
		$data = array(
			'content' => 'administrator/officeHeads/editOfficeHead',
			'offices' => $this->OfficesModel->getOffices()
			);
		$this->load->view('template/content',$data);
	}
	// This will change the current status of the unit head
	public function changeStatusOfficeHead()
	{
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$this->load->model("OfficesModel");
			
			$changeStatus = $this->OfficesModel->changeStatusOfficeHead();
			redirect("officeHead");
		}
		else
		{
			show_404();
		}
	}


	// working with office Secretaries

	// display list of secretaries
	public function officeSecretaries()
	{
		$this->load->model("OfficesModel");
		
		$data = array(
			'content' => 'administrator/officeSecretaries/index',
			'officeSecretaries' => $this->OfficesModel->getSecretaries(),
			'js'	  => array(
				'bootbox.min',
				'administrator/main'
			)
		);
		$this->load->view('template/content',$data);
	}
	// add the new office secretary
	public function addOfficeSecretary()
	{
		$this->load->library('form_validation');
		$this->load->model("OfficesModel");

		if(isset($_SERVER['HTTP_REFERER']))
		{
			$this->form_validation->set_rules('office_id', 'Office', 'required');
			$this->form_validation->set_rules('firstname', 'Firstname', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('lastname', 'Lastname', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('middlename', 'Middlename', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('lnu_id', 'LNU ID', 'required|max_length[50]|xss_clean|is_unique[users.username]');
			$this->form_validation->set_rules('status', 'Status', 'required|');

			if ($this->form_validation->run() == FALSE){
				$data = array(
					'content' => 'administrator/officeSecretaries/addOfficeSecretary',
					'offices' => $this->OfficesModel->getOffices()
				);
				$this->load->view('template/content',$data);
			}else{
				$add = $this->OfficesModel->addOfficeSecretary();
				redirect("officeSecretary");
			}
		}
		else
		{
			show_404();
		}
	}
	// display office Secretary form
	public function addOfficeSecretaryForm()
	{
		$this->load->model("OfficesModel");
		$this->load->library('form_validation');

		$data = array(
			'content' => 'administrator/officeSecretaries/addOfficeSecretary',
			'offices' => $this->OfficesModel->getOffices()
			);
		$this->load->view('template/content',$data);
	}
	// This will change the current status of the office Secretary
	public function changeStatusOfficeSecretary()
	{
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$this->load->model("OfficesModel");
			
			$changeStatus = $this->OfficesModel->changeStatusOfficeSecretary();
			redirect("officeSecretary");
		}
		else
		{
			show_404();
		}
	}
	// edit the info of office secretary
	public function editOfficeSecretary()
	{
		if(isset($_SERVER['HTTP_REFERER']))
		{
			$this->load->model("OfficesModel");
			$this->load->library('form_validation');
			$this->form_validation->set_rules('office_id', 'Office', 'required');
			$this->form_validation->set_rules('firstname', 'Firstname', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('lastname', 'Lastname', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('middlename', 'Middlename', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('lnu_id', 'LNU ID', 'required|max_length[50]');
			$this->form_validation->set_rules('status', 'Status', 'required');

			if ($this->form_validation->run() == FALSE){
				$data = array(
					'content' => 'administrator/officeSecretaries/index',
					'officeSecretaries' => $this->OfficesModel->getSecretaries(),
					'js'	  => array(
						'bootbox.min',
						'administrator/main'
					)
				);
				$this->load->view('template/content',$data);
			}else{
				$edit = $this->OfficesModel->editOfficeSecretary();
				redirect("officeSecretary");
			}
		}
		else
		{
			show_404();
		}
	}
	// display office secretary form for editing
	public function editOfficeSecretaryForm()
	{
		$this->load->model("OfficesModel");
		$data = array(
			'content' => 'administrator/officeSecretaries/editOfficeSecretary',
			'offices' => $this->OfficesModel->getOffices()
			);
		$this->load->view('template/content',$data);
	}

}