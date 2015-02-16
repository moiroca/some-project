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
		
		
		
		$this->load->model("filesModel");
		$this->load->library('breadcrumbs');
		$parent_folder_id = (int)$this->input->get("folder_id");
		
		$this->load->model("foldersModel");

		if(!empty($parent_folder_id) && !$this->foldersModel->isFolderExistById($parent_folder_id,loginLibrary::loggedInUser()['user_id']))

		if(!empty($parent_folder_id) && !$this->foldersModel->isFolderExistById($parent_folder_id,loginLibrary::loggedInUser()['user_id']))
		{
			show_404();
			return false;
		}
		$this->load->model("OfficesModel");
		if($parent_folder_id != 0)
			$folders = $this->foldersModel->getChildFolderById((int)$parent_folder_id,loginLibrary::loggedInUser()['user_id']);
		else
			$folders = $this->foldersModel->getRootFoldersByUserId(loginLibrary::loggedInUser()['user_id']);
		
		
		$office_id_array = $this->filesModel->getOfficeByUserId(loginLibrary::loggedInUser()['user_id'], loginLibrary::loggedInUser()['user_role']);
		
		
		$files = $this->filesModel->getFilesByFolderId($parent_folder_id, $office_id_array[0]->office_id);
		
		
		$data = array(
			'folders' => $folders,
			'breadCrumbs' => $parent_folder_id,
			'files'	=> $files,
			'users'	=> $this->OfficesModel->getUsers(),
			'js' => array('foldering','bootbox.min'),
			'css' => array('file_upload','foldering','admin'),
			'content'	=> 'secretary/createFolder'
		);
		
		$this->load->view("template/content",$data);
		
		/*
		$data = array(
			'folders' => $folders,
			'breadCrumbs' => $parent_folder_id,
			'files'	=> $files,
			'users'	=> $this->OfficesModel->getUsers(),
			'js' => array('foldering','bootbox.min'),
			'css' => array('file_upload','foldering','admin'),
			'content'	=> 'secretary/createFolder'
		);
		
		$this->load->view("template/content",$data);
		*/
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
	public function updateFolder()
	{
		$this->load->library("request");
		if(request::isAjax())
		{
			$this->load->model("foldersModel");
			echo $this->foldersModel->updateFolder();
		}
		else
			show_404();
	}
	public function fileUploadForm(){
		if(!loginLibrary::isLoggedIn())
			redirect("login");
		
		$data = array(
			'content'	=> 'secretary/fileUpload'
		);
		
		$this->load->view("template/content",$data);
	}
	public function fileUpload(){
		if(!loginLibrary::isLoggedIn())
			redirect("login");

			$user_id = 0;
			$this->load->model('filesModel');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('user_id', 'Employee', 'required');
			if ($this->form_validation->run() == FALSE){
				redirect('createFolder');
			}else{
				$user_id = $this->input->post('user_id');
			}
			

			$j = 0;     // Variable for indexing uploaded image.
			$parent_folder_id = (int)$this->input->post("folderId");
			$user_array = loginLibrary::loggedInUser();
			$uploaded_by_id = $user_array['user_id'];
			$office_id_array = $this->filesModel->getOfficeByUserId($user_array['user_id'], $user_array['user_role']);
			$office_id = $office_id_array[0]->office_id;
			for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
				$target_path = 'public/documents/'; // Declaring Path for uploaded images.
				// Loop to get individual element from the array
				$validextensions = array("jpeg", "jpg", "png", "pdf", "ppt", "pptx", "doc", "docx", "xls");      // Extensions which are allowed.
				$ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
				$file_extension = end($ext); // Store extensions in the variable.
				$name_in_folder = $office_id."-".date("Y-m-d")."-".rand(1,10000). "." . $ext[count($ext) - 1];
				$target_path = $target_path . $name_in_folder;     // Set the target path with a new name of image.
				$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
			// echo $name_in_folder;
				if (($_FILES["file"]["size"][$i] > 0)     // Approx. 25mb files can be uploaded.
				&& in_array($file_extension, $validextensions)) {
					if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
						// If file moved to uploads folder.
						
						$original_file_name = $_FILES["file"]["name"][$i];
						$file_type = $ext[count($ext) - 1];
						$data = array('name' => $original_file_name,
										'name_in_folder' => $name_in_folder, 
										'user_id' => $user_id, 
										'uploaded_by_id' => $uploaded_by_id, 
										'file_type' => $file_extension, 
										'office_id' => $office_id, 
										'folder_id' => $parent_folder_id  
							);
						// var_dump($data);
						$this->filesModel->saveFile($data);
						
						} else {     //  If File Was Not Moved.
						//echo $j. ').<span id="error">please try again!.</span><br/><br/>';
					}
				} else {     //   If File Size And File Type Was Incorrect.
				//echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
				}
			}
			redirect("createFolder?folder_id=".$parent_folder_id);
		}
	public function fileDownload(){
			
			$name_in_folder = $this->input->get('name'); 
			$name = $this->input->get('original_name');
		
			$path = $_SERVER['DOCUMENT_ROOT']."/public/documents/".$name_in_folder;
			
        if (file_exists($path)) {
            // required for IE
            if (ini_get('zlib.output_compression')) {
                ini_set('zlib.output_compression', 'Off');
            }

            // get the file mime type using the file extension
            $this->load->helper('file');
            $mime = get_mime_by_extension($path);
            // Build the headers to push out the file properly.
            header('Pragma: public');     // required
            header('Expires: 0');         // no cache
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
            header('Cache-Control: private', false);
            header('Content-Type: ' . $mime);  // Add the mime type from Code igniter.
            header('Content-Disposition: attachment; filename="' . basename($name) . '"');  // Add the file name
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($path)); // provide file size
            header('Connection: close');
            readfile($path); // push it out
     	}
     	redirect('createFolder');
	}
	public function fileDelete(){
		$this->load->model("filesModel");
		$file_id = $this->input->post("file_id");
		$name_in_folder = $this->input->post("name");
		$path = $_SERVER['DOCUMENT_ROOT']."/public/documents/".$name_in_folder;
		
		unlink($path);
		$this->filesModel->deleteFile($file_id);
	}
}