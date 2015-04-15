<?php include_once dirname(__FILE__).'/../frwk/inculde.php'; ?>
<?php

$uid = $userSessionObj->pk_id;
$error = "";
$msg = "";
$num = $_POST ['num'];
$url = "";
$pjname = $_POST['pjname'];

$mediaManager = new UploadManager ();
// foreach($_FILES as $file)
// {
// $msg.= $file['name'];
// }
$list = $mediaManager->GetUpLoadFileArr ( $_FILES );
$entity = new AttachEntity ();
foreach ( $list as $file ) {
	$msg .= $file->name;
	$entity->Insert (  $file->url, $num,$file->name ,$uid,$pjname);
}
$json ['msg'] = $list;
$json ['error'] = "";
echo json_encode ( $json );
?>