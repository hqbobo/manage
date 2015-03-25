<?php include_once  dirname(__FILE__).'/../frwk/inculde.php'; ?>
<?php
	
	$json['status'] = ErrorCode::E_SUCCESS;
	$session = new Session();
	$entity = new User();
	$usr = $session->get("usrSession");
	$json["msg"] = $usr;

	echo json_encode($json);
?>