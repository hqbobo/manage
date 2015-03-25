<?php
class Configure
{
	public static $HOME = 'index.html';
	public static $DIRECTORY_INDEXS = array (
			'index.php',
			'index.html' 
	);
	public static $DIRECTORY_PACKAGES = array (
			'/extension/*/',
	);
	public static $DIRECTORY_TEMPLATE = '/templates/';
	public static $REQUEST_PAGE_NOT_FOUND = '404.php';
	// public static $BASE_CONTROLLER = 'Controller';
	public static $BASE_CONTROLLER = 'WxBaseController';
	public static $DISPATCHER_FILTERS = array (
			//'VisitedUrlFilter',
			'LoginFilter',
	);
	// public static $ENCODING = 'UTF-8';
}

define('WEB_ROOT', Functions::getWebRoot());
define('APP_DIR', Functions::getAppDir());
?>