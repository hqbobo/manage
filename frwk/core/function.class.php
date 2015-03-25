<?php
class Functions {
	public static function geturl()
	{
		if (!empty($_SERVER['PATH_INFO']))
		{
			return $_SERVER['PATH_INFO'];
		} elseif (isset($_SERVER['REQUEST_URI'])) {
			$uri = $_SERVER['REQUEST_URI'];
		}
	
		return $uri;
	}
	
	public static function getWebRoot()
	{
		//echo $_SERVER['PHP_SELF'];
		return str_replace('frwk/index.php', '', $_SERVER['PHP_SELF']);
	}
	
	public static function getAppDir()
	{
		return $_SERVER['DOCUMENT_ROOT'];
	}
	
	public static function isHttpXRequest()
	{
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
	
	public static function getFileWithURl($url = NULL)
	{
		$interrupt = false;
	
		foreach ( Configure::$DIRECTORY_INDEXS as $key => $value )
		{
			if ($url == NULL)
			{
				$value = '/' . $value;
			} else
			{
				if (substr ( $url, - 1 ) == '/')
				{
					$value = $url . $value;
				} else
				{
					$pos = strpos($url,'?');
					if($pos !== false)
						$value = substr($url,0,$pos);
					else
						$value = $url;
					$interrupt = true;
				}
			}
			$value = $_SERVER ['DOCUMENT_ROOT'] . $value;
			if (file_exists ( $value ))
			{
				return $value;
			}
			if ($interrupt)
			{
				return false;
			}
		}
	
		return false;
	}
	public static function display($file = 'index.html',$param = 0)
	{	
		
		//include $_SERVER['DOCUMENT_ROOT'].WEB_ROOT.Configure::$DIRECTORY_TEMPLATE.$file;
		include $_SERVER['DOCUMENT_ROOT'].Configure::$DIRECTORY_TEMPLATE.$file;
	}
	
	public static function directDisplay($file = 'index.html',$param = 0)
	{
	
		//include $_SERVER['DOCUMENT_ROOT'].WEB_ROOT.Configure::$DIRECTORY_TEMPLATE.$file;
		include $_SERVER['DOCUMENT_ROOT'].$file;
	}
	public static function redirect($file)
	{
		//echo 'Location:'.$_SERVER['DOCUMENT_ROOT'].$file;
		header('Location:'.$file);
		exit;
	}
}
?>