<?php
class db{
	protected $conn;

      function __construct(){
		$server = "localhost";
    	$username = "root";
    	$password = "";
    	$databasename = "chat";
		$this->conn = new mysqli($server, $username, $password, $databasename);
		$this->conn->set_charset('utf8mb4');
		if ($this->conn->connect_error) {
			$this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
		}
	}

	 function query($getquery){
		return $this->conn->query($getquery);
	}
}
	
	global $dbObject;
	$dbObject= new db();
?>