<?php include_once  dirname(__FILE__).'/../frwk/inculde.php'; ?>
<?php
$usr = $session->get ( "usrSession" );
$json['status'] = ErrorCode::E_SUCCESS;
if ($usr->t_level < User::RootAdminLevel) {
	$json['status'] = ErrorCode::E_LEVEL_REQUIRED;
	$json ['data'] = '/show-1.html';
} 
echo json_encode ( $json );
?>