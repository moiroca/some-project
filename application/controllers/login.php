<?php

class login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		if(loginLibrary::isLoggedIn())
			loginLibrary::goToUser();	
		
		$this->load->library("form_validation");
		$this->load->view("login/login");
	}

	public function userLogin()
	{
		$this->load->library("form_validation");
		$this->load->library("Request");
		
		if(Request::isPost())
		{
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i>', '</div>');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view("login/login");
			}
			else
			{
				$username = $this->input->post("username");
				$password = $this->input->post("password");
				
				$this->load->model("UserModel");
				
				$user = $this->UserModel->getUser($username,$password);
						
				if(!empty($user))
				{
					loginLibrary::startSession();
					loginLibrary::setter($user);				
					loginLibrary::goToUser($user[0]->role_id); //redirect each roles to its corresponding controller
				}
				else
				{	
					$data = array(
						'usernotfound' => TRUE
					);
					$this->load->view("login/login",$data);
				}
				
			}
		}
		
	}
	public function logout()
	{
		loginLibrary::startSession();
		loginLibrary::resetter();
		
		session_destroy();
		redirect("login");
	}
}
