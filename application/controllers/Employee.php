<?php

class Employee extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->library('form_validation');
		$this->load->model("EmployeeModel");
		
		$data = array(
			'content' => 'employee/index',
			'css' => array('foldering','admin'),
			'employee' => $this->EmployeeModel->getAllEmployee(),
			'js'	  => array(
					'bootbox.min',
					'administrator/main',
					'foldering',
				)
			);
		$this->load->view('template/content',$data);
	}
}