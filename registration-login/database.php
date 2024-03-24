<?php

    $server = "localhost";
	$username = "root";
	$password = "";
	$databasename = "chat";
	
	$conn = new mysqli($server, $username, $password, $databasename);
	$conn->set_charset('utf8mb4');

	if(!$conn){
		echo "Not connected to database";
	}

	
?>