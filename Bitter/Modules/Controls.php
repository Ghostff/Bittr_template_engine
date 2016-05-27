<?php
class Controls
{
	public function __construct()
	{
		$url = "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		//var_dump($url, ROOT);
		//exit;
		
	}
}