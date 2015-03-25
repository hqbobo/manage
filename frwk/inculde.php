<?php include_once 'core/function.class.php';?>
<?php include_once 'core/session.class.php';?>
<?php include_once 'configure.php';?>
<?php include_once 'core/app.class.php';?>
<?php include_once 'core/filter.class.php';?>
<?php
	App::init();
	spl_autoload_register(array('App', 'load'));
	$auth = new AuthManager();
	$session = new Session();
	$userSessionObj = $session->get('usrSession');
	
	if($auth->AuthTest(Functions::geturl(), $userSessionObj) == false)
	{
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
		&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest")
		{
			$json['status'] = ErrorCode::E_UNAUTHORIZED_USER;
			$json['msg'] = ErrorCode::GetErr(ErrorCode::E_UNAUTHORIZED_USER);			
			echo json_encode($json);
			exit();
		}
		else
			Functions::redirect(AuthManager::getLoginPage());
	}
	
?>