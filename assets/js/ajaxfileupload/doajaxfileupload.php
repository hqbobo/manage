<?php include_once '../../../frwk/inculde.php'; ?>
<?php
	$error = "";
	$msg = "";
	$fileElementName = $_POST['id'];
	//$json['msg'] = 'ok'; 
	$url = "";
	$mediaManager = new UploadManager();

	$url = $mediaManager->GetUpLoadFileArr($_FILES);		
	$json['msg'] =$url;
	$json['error'] = "";
	echo json_encode($json);
?>