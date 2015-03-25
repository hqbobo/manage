<?php

class App
{
	private static $_packages = array();
	
	public static function subdir($path, $flag = false)
	{
		if(!is_dir($path))
			return;
		$dir = scandir($path);
		foreach ($dir as $key => $val)
		{
			if($val === '.' || $val === '..')
				continue;
			if(substr ( $path, -1 ) == '/')
				$val = $path.$val;
			else
				$val = $path.'/'.$val;
			if(is_dir($val)){
				if(substr ( $val, -1 ) != '/')
					$val = $val.'/';
				array_push(self::$_packages, $val);
				if($flag)
					self::subdir($val);
			}
		}
	}
	
	public static function initLoadPackages()
	{
		foreach (Configure::$DIRECTORY_PACKAGES as $path)
		{
			$path = APP_DIR.$path;			
			if(substr ( $path, -1 ) == '*'){
				$path = substr($path, 0, -1);
				self::subdir($path,true);
				continue;
			}
			if(substr ( $path, -2 ) == '*/'){
				$path = substr($path, 0, -2);
				self::subdir($path);
				continue;
			}
			if(is_dir($path)){
				if(substr ( $path, -1 ) != '/')
					$path = $path.'/';
				array_push(self::$_packages, $path);
			}
		}
	}
	
	public static function init()
	{
		self::initLoadPackages();
	}
	
	public static function load($className)
	{
		foreach (self::$_packages as $path)
		{
			$file = $path.$className . '.class.php';

			if(file_exists($file))
				return require_once $file;
		}
// 		foreach (Configure::$DIRECTORY_PACKAGES as $path)
// 		{
// 			$file = APP_DIR.$path.$className . '.class.php';
// 			if(file_exists($file))
// 				return require_once $file;
// 		}
		return false;
	}
	
	public static function uuid()
	{
		if (function_exists('com_create_guid')){
			return com_create_guid();
		}else{
			mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
			$charid = strtoupper(md5(uniqid(rand(), true)));
			$uuid = substr($charid, 0, 8)
			.substr($charid, 8, 4)
			.substr($charid,12, 4)
			.substr($charid,16, 4)
			.substr($charid,20,12);
			return $uuid;
		}
	}
}
?>