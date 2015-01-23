<?php

class Request
{
	public function isPost()
	{
		return ($_SERVER['REQUEST_METHOD'] == "POST")?true:false;
	}
	public function isGet()
	{
		return ($_SERVER['REQUEST_METHOD'] == "GET")?true:false;
	}
	public function isAjax()
	{
		return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')?true:false;
	}
}