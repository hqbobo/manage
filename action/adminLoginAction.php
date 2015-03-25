<?php include_once  dirname(__FILE__).'/../frwk/inculde.php'; ?>
<?php
	
	$json['status'] = ErrorCode::E_SUCCESS;
	$act = $_POST['act'];
	switch ($act)
	{
		case 'login':
			$usr = $_POST["usrname"];
			$pwd = $_POST["usrpwd"];

			$session = new Session();
			$entity = new User();
			if($entity->Auth($usr, $pwd) == 1)
			{
				$usrDao = $entity->Get($usr);
				if($usrDao->t_level < User::GroupAdminLevel)
				{
					$json['status'] = ErrorCode::E_LEVEL_REQUIRED;
					$json['msg'] = ErrorCode::GetErr($json['status']);
				}
				else 
				{
					$session->add("usrSession",$usrDao);
					$json["msg"] = ErrorCode::GetErr(ErrorCode::E_SUCCESS);
				}
			}
			else {
				$json['status'] = ErrorCode::E_LOGIN_FAIL;
				$json["msg"] = ErrorCode::GetErr(ErrorCode::E_LOGIN_FAIL);
			}	
		break;
		
	}
	
	echo json_encode($json);
?>