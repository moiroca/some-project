<?php

class fileLibrary
{
	public static function getDescriptionById($file_id)
	{
		$ci =& get_instance();

		return $ci->db->select("file_description")->from("files")->where("id",$file_id)->get()->result();
	}
}