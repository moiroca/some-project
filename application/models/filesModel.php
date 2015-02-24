<?php

class filesModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function getFilesByFolderId($id, $office_id)
	{
		$filesInFolder = $this->db->select("files.id, files.name, files.name_in_folder, users.last_name,users.first_name,users.middle_name, files.file_title, files.file_description, files.other_info, files.user_id")
								 ->from("files")
								 ->join("users", "files.user_id = users.id","left")
								 ->where("files.folder_id",$id)
								 ->where("files.office_id",$office_id)
								 ->order_by("files.office_id", 'asc')
								 ->get()
								 ->result();
		return $filesInFolder;		 
	}
	public function getOfficeByUserId($user_id, $user_role){
		if ($user_role==2) {
			return $this->db->select("office_heads.office_id")
						->from("office_heads")
						->join("users", "users.id = office_heads.users_id")
						->where('users.id', $user_id)
						->get()
						->result();
		} else if ($user_role==3) {
			return $this->db->select("secretaries.office_id")
						->from("secretaries")
						->join("users", "users.id = secretaries.users_id")
						->where('users.id', $user_id)
						->get()
						->result();
		}
	}
	public function saveFile($data){
		return $this->db->insert('files', $data);
	}
	public function deleteFile($file_id){
		$this->db->where("id", $file_id);
		$this->db->delete("files");
	}
	public function searchFile()
	{
		$searchFile = $this->input->get("searchFile");
		$user_id = loginLibrary::loggedInUser()["user_id"];
		return $this->db->query("(SELECT id, name, file_type, folder_id FROM files where user_id = ".$user_id." and name LIKE '%$searchFile%')
UNION
(SELECT id, name, parent_id,user_id FROM folders where user_id = ".$user_id." and name LIKE '%$searchFile%')")->result_object();

		//return $this->db->select("*")->from("files")->like("name",$searchFile)->get()->result();
	}
}