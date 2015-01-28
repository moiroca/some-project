<?php
	class OfficeHead Extends CI_Controller{
		public function __construct(){
			parent::__construct();
		}
		public function index()
		{
			if(!loginLibrary::isLoggedIn())
				redirect("login");
				
			$data = array(
				'css' => array('foldering'),
				'content' => 'officeHead/dashboard'
			);
			$this->load->view("template/content",$data);
		}
	}

	?>