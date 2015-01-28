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
		$this->load->model("OfficesModel");
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
		
		$office_id_array = $this->filesModel->getOfficeByUserId(loginLibrary::loggedInUser()['user_id'], loginLibrary::loggedInUser()['user_role']);
		$office_id = 0;
			foreach ($office_id_array as $key => $value) {
				$office_id = $value->office_id;
		}
		$files = $this->filesModel->getFilesByFolderId($parent_folder_id,$office_id);
		
		
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
		if(isset($_POST['submit'])) {
			$this->load->model('filesModel');

			$j = 0;     // Variable for indexing uploaded image.
			$target_path = 'public/documents/'; // Declaring Path for uploaded images.
			$parent_folder_id = (int)$this->input->post("folderId");
			$user_array = loginLibrary::loggedInUser();
			$uploaded_by_id = $user_array['user_id'];
			$office_id_array = $this->filesModel->getOfficeByUserId($user_array['user_id'], $user_array['user_role']);
			$office_id = 0;
			foreach ($office_id_array as $key => $value) {
				$office_id = $value->office_id;
			}
			$user_id = $this->input->post('user_id');
			for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
				// Loop to get individual element from the array
				$validextensions = array("jpeg", "jpg", "png", "pdf", "ppt", "pptx", "doc", "docx", "xls");      // Extensions which are allowed.
				$ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
				$file_extension = end($ext); // Store extensions in the variable.
				$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
				$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
				if (($_FILES["file"]["size"][$i] < 25000000)     // Approx. 100kb files can be uploaded.
				&& in_array($file_extension, $validextensions)) {
					if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
						// If file moved to uploads folder.
						$name_in_folder = md5(uniqid()) . "." . $ext[count($ext) - 1];
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
						$this->filesModel->saveFile($data);
						
						} else {     //  If File Was Not Moved.
						echo $j. ').<span id="error">please try again!.</span><br/><br/>';
					}
				} else {     //   If File Size And File Type Was Incorrect.
				//echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
				}
			}
			redirect('createFolder');
		}
	}
}