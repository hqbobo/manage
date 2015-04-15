<?php include_once  dirname(__FILE__).'/../frwk/inculde.php'; ?>
<?php

$usr = $session->get ( "usrSession" );
$json ['status'] = ErrorCode::E_SUCCESS;
$act = isset ( $_POST ['act'] ) ? $_POST ['act'] : 'getAll';

switch ($act) {
	case 'savetbl' :
		$id = $_POST ['id'];
		$tbl = $_POST ['tbl'];
		$pj = new Project ();
		$tbl = str_replace ( '\\', '\\\\', $tbl );
		$tbl = str_replace ( '"', '\"', $tbl );
		// $json['msg'] = $pj->TableSave($id, $tbl);
		
		if ($pj->TableSave ( $id, $tbl ) == true)
			$json ['msg'] = '执行成功';
		else {
			$json ['status'] = ErrorCode::E_ERROR;
			$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
		}
		break;
	case 'get' :
		$id = $_POST ['id'];
		$pj = new Project ();
		$json ['msg'] = '执行成功';
		$json ['data'] = $pj->Get ( $id );
		break;
	case 'getAll' :
		$pj = new Project ();
		$json ['msg'] = '执行成功';
		$json ['data'] = $pj->GetAllProject ();
		break;
	case 'add' :
		if ($usr->t_level < User::RootAdminLevel) {
			$json ['status'] = ErrorCode::E_LEVEL_REQUIRED;
			$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
		} else {
			if (! (isset ( $_POST ['pjname'] )) || ! (isset ( $_POST ['year'] )) || ! (isset ( $_POST ['month'] )) || ! (isset ( $_POST ['day'] ))) {
				$json ['status'] = ErrorCode::E_INVALID_PRAMETER;
				$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
			} else {
				$pjname = $_POST ['pjname'];
				$year = $_POST ['year'];
				$month = $_POST ['month'];
				$day = $_POST ['day'];
				$pj = new Project ();
				if ($pj->PrameterCheck ( $pjname, $year, $month, $day ) != ErrorCode::E_SUCCESS) {
					$json ['status'] = $pj->PrameterCheck ( $pjname, $year, $month, $day );
					$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
				} else {
					$json ['msg'] = $pj->Insert ( $pjname, $year, $month, $day );
					$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
				}
			}
		}
		break;
	case 'edit' :
		
		if ($usr->t_level < User::RootAdminLevel) {
			$json ['status'] = ErrorCode::E_LEVEL_REQUIRED;
			$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
		} else {
			if (! (isset ( $_POST ['pjname'] )) || ! (isset ( $_POST ['year'] )) || ! (isset ( $_POST ['month'] )) || ! (isset ( $_POST ['day'] ))) {
				$json ['status'] = ErrorCode::E_INVALID_PRAMETER;
				$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
			} else {
				
				$pjname = $_POST ['pjname'];
				$year = $_POST ['year'];
				$month = $_POST ['month'];
				$day = $_POST ['day'];
				$id = $_POST ['id'];
				$pj = new Project ();
				
				if ($pj->PrameterCheck ( $pjname, $year, $month, $day ) != ErrorCode::E_SUCCESS) {
					$json ['status'] = $pj->PrameterCheck ( $pjname, $year, $month, $day );
					$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
				} else {
					$json ['msg'] = $pj->Update ( $id, $pjname, $year, $month, $day );
					$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
				}
			}
		}
		break;
	case 'del' :
		if ($usr->t_level < User::RootAdminLevel) {
			$json ['status'] = ErrorCode::E_LEVEL_REQUIRED;
			$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
		} else {
			if (! isset ( $_POST ['id'] )) {
				$json ['status'] = ErrorCode::E_INVALID_PRAMETER;
				$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
			} else {
				$id = $_POST ['id'];
				$pj = new Project ();
				if ($pj->Del ( $id ) != ErrorCode::E_SUCCESS) {
					$json ['status'] = ErrorCode::E_DB_ERR;
					$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
				} else {
					$json ['status'] = ErrorCode::E_SUCCESS;
					$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
				}
			}
		}
		break;
	case 'changeTitle' :
		if ($usr->t_level < User::RootAdminLevel) {
			$json ['status'] = ErrorCode::E_LEVEL_REQUIRED;
			$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
		} else {
			
			if (! isset ( $_POST ['id'] )) {
				$json ['status'] = ErrorCode::E_INVALID_PRAMETER;
				$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
			} else {
				$id = $_POST ['id'];
				$title = $_POST ['title'];
				$pj = new Project ();
				if ($pj->UpdateTitle ( $id, $title ) != ErrorCode::E_SUCCESS) {
					$json ['status'] = ErrorCode::E_DB_ERR;
					$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
				} else {
					$json ['status'] = ErrorCode::E_SUCCESS;
					$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
				}
			}
		}
		break;
	case 'getAllAttach' :
		$id = $_POST ['id'];
		$entity = new AttachEntity ();
		$json ['msg'] = '执行成功';
		$json ['data'] = $entity->GetByProject ( $id );
		break;
		
	case 'getAttach' :
		$id = $_POST ['id'];
		$pjname = $_POST ['pjname'];
		$entity = new AttachEntity ();
		$json ['msg'] = '执行成功';
		$json ['data'] = $entity->GetByProjectAndName ( $id ,$pjname);
		break;	
			
	case 'delAttach' :
		$id = $_POST ['id'];
		$entity = new AttachEntity ();
		$json ['msg'] = '执行成功';
		$json ['data'] = $entity->Del ( $id );
		break;
	default :
		$json ['status'] = ErrorCode::E_UNKOWN_ACT;
		$json ['msg'] = ErrorCode::GetErr ( $json ['status'] );
}
echo json_encode ( $json );
?>