<?php
	$filename = $_FILES['file']['name'];
	
	$location = "../chat_files/".$filename;
	if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
		echo "upload";
	}else{
		echo "error";
	}
?>