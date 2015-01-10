<?php

class customLoader
{
	public static function js($params = NULL)
	{
		if(!empty($params))
		{
			foreach($params as $key => $values)
			{
				echo "<script src='".base_url("public/js/")."/".$values.".js'></script>";
			}
		}
	}
}