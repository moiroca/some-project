<?php

class Secretary extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		if(!loginLibrary::isLoggedIn())
			redirect("login");
			
		$data = array(
			'css' => array('foldering'),
			'content' => 'secretary/dashboard'
		);
		$this->load->view("template/content",$data);
	}
	public function createFolder()
	{
		if(!loginLibrary::isLoggedIn())
			redirect("login");
		
		
		
		$this->load->model("foldersModel");
		$this->load->model("filesModel");
		$this->load->library('breadcrumbs');
		$parent_folder_id = (int)$this->input->get("folder_id");
		
		if(!empty($parent_folder_id) && !$this->foldersModel->isFolderExistById($parent_folder_id,loginLibrary::loggedInUser()['user_id']))
		{
			show_404();
			return false;
		}
		if($parent_folder_id != 0)
			$folders = $this->foldersModel->getChildFolderById((int)$parent_folder_id,loginLibrary::loggedInUser()['user_id']);
		else
			$folders = $this->foldersModel->getRootFoldersByUserId(loginLibrary::loggedInUser()['user_id']);
		
		$files = $this->filesModel->getFilesByFolderId($parent_folder_id,loginLibrary::loggedInUser()['user_id']);
		
		
		$data = array(
			'folders' => $folders,
			'breadCrumbs' => $parent_folder_id,
			'files'	=> $files,
			'js' => array('foldering','bootbox.min'),
			'css' => array('foldering'),
			'content'	=> 'secretary/createFolder'
		);
		
		$this->load->view("template/content",$data);
	}
	public function saveFolder()
	{
		$this->load->library("request");
		if(request::isAjax())
		{
			$this->load->model("foldersModel");
			$parent_folder_id = (int)$this->input->post("folder_id");
			$user_id  = loginLibrary::loggedInUser()['user_id'];
			
			echo $this->foldersModel->saveFolder();
		}
		else
			show_404();
	}
}