<?php

class Administrator extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
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
}