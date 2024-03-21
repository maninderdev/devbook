<?php

    $server = "localhost";
	$username = "id18756843_phpmysqlre";
	$password = "eR-b*U=JWgg7q5|";
	$databasename = "id18756843_phpmysqlreg";
	
	$conn = new mysqli($server, $username, $password, $databasename);
	$conn->set_charset('utf8mb4');

	if(!$conn){
		echo "Not connected to database";
	}

	
?>