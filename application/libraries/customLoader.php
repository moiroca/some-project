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
	public static function css($params = NULL)
	{
		if(!empty($params))
		{
			foreach($params as $key => $values)
			{
				echo "<link type='text/css'	rel='stylsheet'	href='".base_url("public/css/")."/".$values.".css'></script>";
			}
		}
	}
}