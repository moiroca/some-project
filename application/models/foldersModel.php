<?php

class foldersModel extends CI_Model
{
	private $ci;
	public function __construct()
	{
		parent::__construct();
	}
	public function getFolderById($id,$user_id)
	{
		$this->db->select("*")
				 ->from("folders")
				 ->where("id",$id)
				 ->where("create_by_id",$user_id)
				 ->get()
				 ->result();
	}
	public function getParentFolder()
	{
		
	}
	public function getRootFoldersByUserId($id)
	{
		$getFolderSQL =	$this->db->select("*")
									 ->from("folders")
									 ->where("parent_id",0)
									 ->where("create_by_id",$id)
									 ->get()
									 ->result();
		return $getFolderSQL;
	}
	public function getChildFolderById($id,$user_id)
	{
		$this->db->where("parent_id",$id);
		$root_folders = $this->db->select("*")
						 ->from("folders")
						 ->where("user_id",$user_id)
						 ->get()
						 ->result();
						 
		return $root_folders;
	}
	public function isRootFolder($id)
	{
		$getFolderSQL =	$this->db->select("count(*) as isRootFolder")
									 ->from("folders")
				 					 ->where("id",$id)
									 ->where("parent_id",0)
									 ->limit(1)
									 ->get()
									 ->result();
		return ($getFolderSQL[0]->isRootFolder != 0)?true:false;
	}
	public function isFolderExistById($id, $user_id)
	{
		$getFolderSQL =	$this->db->select("*")
									 ->from("folders")
				 					 ->where("id",$id)
									 ->where("create_by_id",$user_id)
									 ->get()
									 ->result();						 					 
		return (empty($getFolderSQL))?false:true;							 
	}
	public function getRootFolderNames($id)
	{
		$folderName = array();
		$getFolderSQL =	$this->db->select("id,name,parent_id")
									 ->from("folders")
				 					 ->where("id",$id)
									 ->limit(1)
									 ->get()
									 ->result();
		if(!empty($getFolderSQL))							 							 
		$folderName[] = array($getFolderSQL[0]->id,$getFolderSQL[0]->name);
		
		while(isset($getFolderSQL[0]->parent_id) && $getFolderSQL[0]->parent_id != 0)
		{
			$getFolderSQL =	$this->db->select("id,name,parent_id")
									 ->from("folders")
				 					 ->where("id",$getFolderSQL[0]->parent_id)
									 ->limit(1)
									 ->get()
									 ->result();
			$folderName[] = array($getFolderSQL[0]->id,$getFolderSQL[0]->name);
		}
		return $folderName;
	}
	public function saveFolder()
	{	
			$user_id 		=	loginLibrary::loggedInUser()['user_id'];//$this->input->post('user_id');
			$created_by   	 =	loginLibrary::loggedInUser()['user_id']; //$this->input->post('created_by_user_id');
			$folder_name	= 	$this->input->post('name');
			$parent_id	  = 	(int)$this->input->post('folder_id');
			
			$data  = array(
				'user_id' 	=> $user_id,
				'create_by_id' => $created_by,
				'name'=> $folder_name,
				'parent_id'  => $parent_id
			);
			//echo json_encode($data);
			return $this->db->insert('folders',$data);
	}
	//delete folder with files inside the folder
	public function deleteFolder()
	{
		$folder_id = $this->input->post("folder_id");
		
		$this->db->where("folder_id",$folder_id);
		$this->db->delete("files");
		
		$this->db->where("parent_id",$folder_id);
		$this->db->delete("folders");
		
		$this->db->where("id",$folder_id);
		$this->db->delete("folders");
	}
}