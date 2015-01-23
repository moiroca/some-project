<?php

class filesModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function getFilesByFolderId($id,$user_id)
	{
		$filesInFolder = $this->db->select("*")
								 ->from("files")
								 ->where("folder_id",$id)
								 ->where("uploaded_by_id",$user_id)
								 ->get()
								 ->result();
		return $filesInFolder;		 
	}
}