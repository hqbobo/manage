<?php include_once  dirname(__FILE__).'/../frwk/inculde.php'; ?>
<?php
$id = $_GET['id'];

$entity = new AttachEntity();
$attach = $entity->GetById($id);
$name = $attach->name;
$filename = $attach->url;
//$name = "547cb7e874e0f.doc";

$end = end(explode('.', $file));
//Header("Content-type: application/octet-stream");
Header("Accept-Ranges: bytes");
header("Expires: 0");
header('Content-Type: '.$end);
Header("Accept-Length: ".filesize("..".$filename));
//header("Cache-Component: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=\"".$name."\"");
//header("Content-Transfer-Encoding: binary");
readfile("..".$filename);
?>