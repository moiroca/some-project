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
			'js' => array('foldering','bootbox.min','bootstrap-toggle.min'),
			'css' => array('foldering','admin','bootstrap-toggle.min'),
			'content'	=> 'secretary/createFolder',
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
		if (isset($_POST['submit'])) {
			$j = 0;     // Variable for indexing uploaded image.
			$target_path = 'public/documents/'; // Declaring Path for uploaded images.
			$parent_folder_id = (int)$this->input->post("folder_id");
			echo "string"+$parent_folder_id;
			for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
				// Loop to get individual element from the array
				$validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
				$ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
				$file_extension = end($ext); // Store extensions in the variable.
				$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
				$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
				if (($_FILES["file"]["size"][$i] < 25000000)     // Approx. 100kb files can be uploaded.
				&& in_array($file_extension, $validextensions)) {
					if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
						// If file moved to uploads folder.
						echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
					} else {     //  If File Was Not Moved.
						echo $j. ').<span id="error">please try again!.</span><br/><br/>';
					}
				} else {     //   If File Size And File Type Was Incorrect.
				echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
				}
			}
		}
	}
}