<?php include_once  dirname(__FILE__).'/../frwk/inculde.php'; ?>
<?php
$usr = $session->get ( "usrSession" );
	$json['status'] = ErrorCode::E_SUCCESS;
	$act = $_POST['act'];
	switch ($act)
	{
		case 'userPwdChange':
			$id = $usr->pk_id;
			$pwd = $_POST ['pwd'];
				
			$entity = new User();
			if ($entity->PwdChange($pwd, $id) == true)
				$json ['status'] = ErrorCode::E_SUCCESS;
			else
				$json ['status'] = ErrorCode::E_DB_ERR;
				
			$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
				
			break;
		case 'login':
			$usr = $_POST["usrname"];
			$pwd = $_POST["usrpwd"];

			$session = new Session();
			$entity = new User();
			if($entity->Auth($usr, $pwd) == 1)
			{
				$usrDao = $entity->Get($usr);
				$session->add("usrSession",$usrDao);
				$json["msg"] = ErrorCode::GetErr(ErrorCode::E_SUCCESS);
			}
			else {
				$json['status'] = ErrorCode::E_LOGIN_FAIL;
				$json["msg"] = ErrorCode::GetErr(ErrorCode::E_LOGIN_FAIL);
			}	
		break;
		
	}
	
	echo json_encode($json);
?>