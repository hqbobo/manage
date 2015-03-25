<?php
	$error = "";
	$msg = "===";
	$upFilePath = "./";
			foreach($_FILES as $file)
			{
				
				$msg .= $file['name'];
				@move_uploaded_file($file['tmp_name'],$upFilePath.$file['name']);
				@unlink($file['tmp_name']);
			}
			//$msg .= " File Name: " . $_FILES['fileToUpload1']['name'] . ", ";
			//$msg .= " File Size: " . @filesize($_FILES['fileToUpload']['tmp_name']);
			//for security reason, we force to remove all uploaded file
			//@unlink($_FILES['fileToUpload1']);		
	
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>