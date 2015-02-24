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
			),
			'page' => 'office'
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
			'css' => array('foldering','admin'),
			'js'	  => array(
				'bootbox.min',
				'administrator/main',
				'foldering'
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
			'offices' => $this->OfficesModel->getOffices(),
			'css' => array('foldering','admin'),
			'js'	  => array(
				'bootbox.min',
				'administrator/main',
				'foldering',
			)
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
			$this->form_validation->set_rules('usersId', 'User', 'required|integer');

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
		$this->load->model("UserModel");
		
		$user_id = $this->uri->segment(2);
		$officeHead = $this->UserModel->getOfficeHeadById($user_id);
		
		if(empty($officeHead))
		{
			show_404();
			exit;
		}
		$data = array(
			'content' => 'administrator/officeHeads/editOfficeHead',
			'offices' => $this->OfficesModel->getOffices(),
			'officeHead' => $officeHead
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
         $this->load->model("UserModel");
		 session_Start();
		 $office = array();
		 $data = array();
		if(loginLibrary::isLoggedInOfficeHead()) {
			 $office = $this->UserModel->getOfficeHeadById($_SESSION['user_id']);
			 $data['office_id'] = $office[0]->office_id;
		 }
	    
		$data['content'] = 'administrator/officeSecretaries/addOfficeSecretary';
		$data['offices'] = $this->OfficesModel->getOffices();
		
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
		$this->load->model("UserModel");
		$user_id = $this->uri->segment(2);
		$secretary = $this->UserModel->getOfficeSecretaryById($user_id);
		
		if(empty($secretary))
		{
			show_404();
			exit;
		}
		$data = array(
			'content' => 'administrator/officeSecretaries/editOfficeSecretary',
			'offices' => $this->OfficesModel->getOffices(),
			'secretary' => $secretary
			);
		$this->load->view('template/content',$data);
	}
	public function error()
	{
		$this->load->view("errors/404");
	}
	public function deleteFolder()
	{
		$this->load->library("Request");
		if(Request::isAjax())
		{
			$this->load->model("foldersModel");
			$delete = $this->foldersModel->deleteFolder();
			
			echo $delete;
		}
		else
			show_404();
	}
	public function profile()
	{
		$user_id = loginLibrary::loggedInUser()['user_id'];
		$this->load->model("UserModel");
		$users = $this->UserModel->getUserById($user_id);
		if(empty($users))
		{
			show_404();
			exit;
		}
		$data = array(
			'content' => 'administrator/profile/profile',
			'user' => $users
		);
		$this->load->view('template/content',$data);
	}
	public function editProfile()
	{
		$this->load->library("form_validation");
		$user_id = loginLibrary::loggedInUser()['user_id'];
		$this->load->model("UserModel");
		$users = $this->UserModel->getUserById($user_id);
		if(empty($users))
		{
			show_404();
			exit;
		}
		$data = array(
			'content' => 'administrator/profile/editProfile',
			'user' => $users[0],
			'js' => array('administrator/main')
		);
		$this->load->view('template/content',$data);
	}
	public function savePersonalInformation()
	{
		$this->load->library("Request");
		if(Request::isPost())
		{
			$this->load->library("form_validation");
			
			$this->form_validation->set_error_delimiters("<div class='alert alert-danger'><i class='fa fa-warning'></i>","</div>");
			$this->form_validation->set_rules('user_id', 'User ID', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|max_length[50]|xss_clean|callback_usernameCheck');
			$this->form_validation->set_rules('firstname', 'First Name', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('middlename', 'Middle Name', 'required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required|max_length[50]|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$user_id = loginLibrary::loggedInUser()['user_id'];
				$this->load->model("UserModel");
				$users = $this->UserModel->getUserById($user_id);
				$data = array(
					'content' => 'administrator/profile/editProfile',
					'user' => $users[0],
					'js' => array('administrator/main')
				);
				$this->load->view('template/content',$data);
			}
			else
			{
				$this->load->model("UserModel");
				$update = $this->UserModel->updatePersonalInformation();
				
				if(!$update)
				{
					loginLibrary::startSession();
					loginLibrary::resetter();
				
					session_destroy();
					redirect("login?retryLogin=true");
				}else
				{
					$user_id = $this->input->post("user_id");
					redirect("edit-profile/".$user_id."?updateSuccess=true");
				}
				
			}
		}
		else
			show_404();
	}
	public function saveUserCredentials()
	{
		$this->load->library("Request");
		
		if(Request::isPost())
		{	
			$this->load->library("form_validation");
			
			$this->form_validation->set_error_delimiters("<div class='alert alert-danger'><i class='fa fa-warning'></i>","</div>");
			$this->form_validation->set_rules('user_id', 'User ID', 'required');
			$this->form_validation->set_rules('oldpassword', 'Old Password', 'required|max_length[50]|xss_clean|callback_matchOldPassword');
			$this->form_validation->set_rules('newpassword', 'New Password', 'required|max_length[50]|xss_clean|matches[cnpassword]');
			$this->form_validation->set_rules('cnpassword', 'Confirm New Password', 'required|max_length[50]|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$user_id = loginLibrary::loggedInUser()['user_id'];
				$this->load->model("UserModel");
				$users = $this->UserModel->getUserById($user_id);
				$data = array(
					'content' => 'administrator/profile/editProfile',
					'user' => $users[0],
					'js' => array('administrator/main'),
					'isActive' => true
				);
				$this->load->view('template/content',$data);
			}
			else
			{
				$this->load->model("UserModel");
				
				$update = $this->UserModel->updateUserCredentials();
				loginLibrary::startSession();
				loginLibrary::resetter();
				
				session_destroy();
				redirect("login?retryLogin=true");
			}
		}
		else
			show_404();
	}
	public function matchOldPassword($oldPassword)
	{
		$user_id = loginLibrary::loggedInUser()['user_id'];
		$this->load->model("UserModel");
		
		$user = $this->UserModel->matchOldPassword($user_id,$oldPassword);
		
		if (empty($user))
		{
			$this->form_validation->set_message('matchOldPassword', 'Your Password did not match with your old Password.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function usernameCheck($username)
	{
		$user_id = loginLibrary::loggedInUser()['user_id'];
		$this->load->model("UserModel");
		
		$isUsernameExist = $this->UserModel->isUserNameExist($user_id,$username);
		if($isUsernameExist)
		{
			$this->form_validation->set_message('usernameCheck', 'Username already Exist.');
			return FALSE;
		}
		else
			return true;
	}
	public function editOfficeHeadPassword($usr_id = false)
	{
		$user_id = (!$usr_id)?$this->uri->segment(2):$usr_id;
		$this->load->model("UserModel");
		
		$user = $this->UserModel->getUserById($user_id);
		if(empty($user) || (loginLibrary::loggedInUser()['user_role'] == 3))
		{
			show_404();
			exit;
		}
		$this->load->library("form_validation");
		$data = array(
			'content' => 'administrator/officeHeads/editOfficeHeadPassword',
			'js' => array('administrator/main'),
			'user'=> $user[0]
		);
		$this->load->view('template/content',$data);
	}
	public function updateOfficeHeadPassword()
	{
		$this->load->library("Request");
		
		if(Request::isPost())
		{	
			$this->load->library("form_validation");
			
			$this->form_validation->set_error_delimiters("<div class='alert alert-danger'><i class='fa fa-warning'></i> ","</div>");
			$this->form_validation->set_rules('user_id', 'User ID', 'required');
			$this->form_validation->set_rules('newpassword', 'New Password', 'required|max_length[50]|xss_clean|matches[cnpassword]');
			$this->form_validation->set_rules('cnpassword', 'Confirm New Password', 'required|max_length[50]|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$user_id = $this->input->post("user_id");
				$this->editOfficeHeadPassword($user_id);
			}
			else
			{
				$this->load->model("UserModel");
				$update = $this->UserModel->updateUserPassword();
				
				redirect("officeHead");
			}
		}
		else
			show_404();
	}
	public function editOfficeSecretaryPassword($usr_id = FALSE)
	{
		$user_id = (!$usr_id)?$this->uri->segment(2):$usr_id;
		$this->load->model("UserModel");
		
		$user = $this->UserModel->getUserById($user_id);
		if(empty($user) || (loginLibrary::loggedInUser()['user_role'] == 3))
		{
			show_404();
			exit;
		}
		$this->load->library("form_validation");
		$data = array(
			'content' => 'administrator/officeSecretaries/editOfficeSecretaryPassword',
			'js' => array('administrator/main'),
			'user'=> $user[0]
		);
		$this->load->view('template/content',$data);
	}
	public function updateOfficeSecretaryPassword()
	{
		$this->load->library("Request");
		
		if(Request::isPost())
		{	
			$this->load->library("form_validation");
			
			$this->form_validation->set_error_delimiters("<div class='alert alert-danger'><i class='fa fa-warning'></i> ","</div>");
			$this->form_validation->set_rules('user_id', 'User ID', 'required');
			$this->form_validation->set_rules('newpassword', 'New Password', 'required|max_length[50]|xss_clean|matches[cnpassword]');
			$this->form_validation->set_rules('cnpassword', 'Confirm New Password', 'required|max_length[50]|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$user_id = $this->input->post("user_id");
				$this->editOfficeHeadPassword($user_id);
			}
			else
			{
				$this->load->model("UserModel");
				$update = $this->UserModel->updateUserPassword();
				
				redirect("officeSecretary");
			}
		}
		else
			show_404();
	}
	public function searchFile()
	{
		$this->load->model("filesModel");
		$searchData = $this->input->get("searchFile");
		$searchFile = $this->filesModel->searchFile();

		$data = array(
				"content" => "secretary/searchFile",
				);
		if(empty($searchData) || $searchData == "")
		{
			$data["files" ] = null;
		}else{
				$data["files"] = $searchFile;
		}
		

		$this->load->view("template/content",$data);
	}
}