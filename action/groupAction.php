<?php include_once  dirname(__FILE__).'/../frwk/inculde.php'; ?>
<?php

$usr = $session->get ( "usrSession" );
if ($usr->t_level < User::RootAdminLevel) {
	$json['status'] = ErrorCode::E_LEVEL_REQUIRED;
	$json['msg'] = ErrorCode::GetErr ( $json['status'] );
} else {
	$act = $_POST ['act'];
	$entity = new GroupEntity ();
	switch ($act) {
		case 'add' :
			$name = $_POST ['name'];
			if ($entity->Add ( $name ) == true)
				$json['status'] = ErrorCode::E_SUCCESS;
			else
				$json['status'] = ErrorCode::E_DB_ERR;
			$json['msg'] = ErrorCode::GetErr ( $json['status'] );
			break;
		case 'delete' :
			$id = $_POST ['id'];
			if ($entity->Del ( $id ) == true)
				$json['status'] = ErrorCode::E_SUCCESS;
			else
				$json['status'] = ErrorCode::E_DB_ERR;
			$json['msg'] = ErrorCode::GetErr ( $json['status'] );
			break;
		case 'getall':
			$list = $entity->GetAll();
		
			if($list != false){
				$json['status'] = ErrorCode::E_SUCCESS;
				$json['data'] = $list;
			}
			else if (count($list) == 0)
				$json['status'] = ErrorCode::E_DB_EMPTY;
			else
				$json['status'] = ErrorCode::E_DB_ERR;
			$json['msg'] = ErrorCode::GetErr ( $json['status'] );
			break;
		case 'update' :
			$name = $_POST ['name'];
			$id = $_POST ['id'];
			if ($entity->Update($id, $name) == true)
				$json['status'] = ErrorCode::E_SUCCESS;
			else
				$json['status'] = ErrorCode::E_DB_ERR;
			$json['msg'] = ErrorCode::GetErr ( $json['status'] );
			break;
	}
	// $json["msg"] = $usr;
}
echo json_encode ( $json );
?>