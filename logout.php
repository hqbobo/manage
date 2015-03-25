<?php include_once  dirname(__FILE__).'/frwk/inculde.php'; ?>
<?php

	$session = new Session();
	$session->del("usrSession");
	Functions::redirect('login.html');
?>