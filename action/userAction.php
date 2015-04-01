<?php include_once  dirname(__FILE__).'/../frwk/inculde.php'; ?>
<?php

$usr = $session->get ( "usrSession" );

if ($usr->t_level < User::RootAdminLevel) {
	$json ['status'] = ErrorCode::E_LEVEL_REQUIRED;
	$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
} else {
	$act = isset ( $_POST ['act'] ) ? $_POST ['act'] : 'getall';
	$entity = new User ();
	switch ($act) {
		case 'add' :
			$acct = $_POST ['acct'];
			$pwd = $_POST ['pwd'];
			$level = $_POST ['level'];
			$name = $_POST ['name'];
			$group = $_POST ['group'];
			if ($level == 2)
				$level = 9;
			
			if ($entity->DuplicateAcct ( $acct ) == true) {
				if ($entity->Add ( $acct, $pwd, $name, $group, $level ) == true)
					$json ['status'] = ErrorCode::E_SUCCESS;
				else
					$json ['status'] = ErrorCode::E_DB_ERR;
			} else
				$json ['status'] = ErrorCode::E_USER__DUPLICATE;
			
			$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
			
			break;
		case 'del' :
			$id = $_POST ['id'];
			if ($entity->Del ( $id ) == true)
				$json ['status'] = ErrorCode::E_SUCCESS;
			else
				$json ['status'] = ErrorCode::E_DB_ERR;
			
			$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
			
			break;
		case 'update' :
			$id = $_POST ['id'];
			$level = $_POST ['level'];
			if ($level == 2)
				$level = 9;
			
			if ($entity->Update ( $id, $level ) == true)
				$json ['status'] = ErrorCode::E_SUCCESS;
			else
				$json ['status'] = ErrorCode::E_DB_ERR;
			
			$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
			
			break;
		case 'getall' :
			$list = $entity->GetAllWithOrder ();
			
			if ($list != false) {
				$json ['status'] = ErrorCode::E_SUCCESS;
				$json ['data'] = $list;
			} else if (count ( $list ) == 0)
				$json ['status'] = ErrorCode::E_DB_EMPTY;
			else
				$json ['status'] = ErrorCode::E_DB_ERR;
			$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
			break;
		case 'getbygroup' :
			$group = $_POST['group'];
			$list = $entity->GetByGroup($group);
			
			if ($list != false) {
				$json ['status'] = ErrorCode::E_SUCCESS;
				$json ['data'] = $list;
			} else if (count ( $list ) == 0)
				$json ['status'] = ErrorCode::E_DB_EMPTY;
			else
				$json ['status'] = ErrorCode::E_DB_ERR;
			$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
			break;
	}
}
echo json_encode ( $json );
?>