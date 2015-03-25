<?php include_once  dirname(__FILE__).'/../frwk/inculde.php'; ?>
<?php
	if(isset($userSessionObj))
	{
		$json['status'] = ErrorCode::E_SUCCESS;
	}
	else
	{
		$json['status'] = ErrorCode::E_UNAUTHORIZED_USER;
		$json['msg'] = ErrorCode::GetErr(ErrorCode::E_UNAUTHORIZED_USER);
	}
	echo json_encode($json);
?>