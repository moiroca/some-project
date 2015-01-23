<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		//$this->load->view('upload_form', array('error' => ' ' ));
		$this->load->model("foldersModel");
		$folders = $this->foldersModel->getRootFolderNames(2);
		
		//echo "<pre>",print_r($folders);
		$i = sizeOf($folders);
		for($i ; $i > 0; $i--)
		{
			if($i == 1)
			{
				echo $folders[$i-1][1];
			}
			else
				echo $folders[$i-1][1]." | ";
		}
		
	}
	public function createFolder()
	{
		$this->load->model("foldersModel");
		$this->load->model("filesModel");
		$this->load->library('breadcrumbs');
		$parent_folder_id = (int)$this->input->get("folder_id");
		if(!empty($parent_folder_id) && !$this->foldersModel->isFolderExistById($parent_folder_id,1))
		{
			show_404();
			return false;
		}
		if($parent_folder_id != 0)
			$folders = $this->foldersModel->getChildFolderById((int)$parent_folder_id,1);
		else
			$folders = $this->foldersModel->getRootFoldersByUserId(1);
		
		$files = $this->filesModel->getFilesByFolderId($parent_folder_id,1);
		
		/*
		if(empty($files))
		{
			show_404();
			return false;
		}
		*/
		$data = array(
			'folders' => $folders,
			'breadCrumbs' => $parent_folder_id,
			'files'	=> $files,
			'content'	=> 'createFolder'
		);
		
		$this->load->view("template/content",$data);
	}
	public function saveFolder()
	{
		if(lib_request::isPost())
		{
			$this->load->model('foldersModel');
			$this->foldersModel->saveFolder();
		}
		else
		{
			show_404();
		}
	}
	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('upload_success', $data);
		}
	}
	public function breadCrumbs($id)
	{
		$this->load->model("foldersModel");
		$folders = $this->foldersModel->getRootFolderNames($id);
		
		//echo "<pre>",print_r($folders);
		$i = sizeOf($folders);
		if($i != 0)
		{
			for($i ; $i > 0; $i--)
			{
				if($i == 1)
				{
					echo "<a href=".base_url("index.php/upload/createFolder?folder_id=".$folders[$i-1][0]).">".$folders[$i-1][1]."</a>";
				}
				else
					echo "<a href=".base_url("index.php/upload/createFolder?folder_id=".$folders[$i-1][0]).">".$folders[$i-1][1]."</a>"." | ";
			}
		}
	}
	public function result()
	{
		$this->load->model("foldersModel");
		$parent_folder_id = (int)$this->input->post("folder_id");
		if($this->foldersModel->isFolderExistById($parent_folder_id,1))
		{
			echo $this->foldersModel->saveFolder();
		}else
			echo $parent_folder_id;
	}
	
}
?>