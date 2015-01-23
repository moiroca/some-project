<?php

class breadCrumbs 
{
	public function showBreadCrumbs($id)
	{
		$ci =& get_instance();
		$ci->load->model("foldersModel");
		$folders = $ci->foldersModel->getRootFolderNames($id);
		
		$i = sizeOf($folders);
		
		echo "<ol class='breadcrumb'>";
		echo "<li><i class='fa fa-folder-o'></i> <a href=".base_url('secretary/createFolder').">Main Folder</a></li>";
		if($i != 0)
		{
			for($i ; $i > 0; $i--)
			{
				if($i == 1)
				{
					echo "<li class='active'><i class='fa fa-folder'></i> <a href=".base_url("secretary/createFolder?folder_id=".$folders[$i-1][0]).">".$folders[$i-1][1]."</a> </li>";
				}
				else
					echo "<li> <i class='fa fa-folder-o'></i> <a href=".base_url("secretary/createFolder?folder_id=".$folders[$i-1][0]).">".$folders[$i-1][1]."</a>"." </li>";
			}
		}
		echo "</ol>";
		
	}
}