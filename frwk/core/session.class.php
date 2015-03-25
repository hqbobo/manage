<?php

class Session
{
	public function __construct()
	{
		$this->start();
	}
	
	private function start()
	{
		if(!isset($_SESSION)){
			session_start();
		}
	}
	
	public function add($key,$value)
	{
		$_SESSION[$key] = $value;
	}
	
	public function get($key)
	{
		return @$_SESSION[$key];
	}
	
	function del($key)
	{
		unset($_SESSION[$key]);
	}
}

?>