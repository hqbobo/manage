<?php include_once  dirname(__FILE__).'/../frwk/inculde.php'; ?>
<?php
	$usr = $session->get("usrSession");
	if($usr->t_level < User::GroupAdminLevel)
	{
		$json['status'] = ErrorCode::E_LEVEL_REQUIRED;
		$json['msg'] = ErrorCode::GetErr($json['status']);
	}
	else 
	{
		$act = $_GET['act'];
		$entity = new User();	
		$json["msg"] = $usr;
		
	}
	echo json_encode($json);
?>