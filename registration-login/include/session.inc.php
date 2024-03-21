<?php

class chsession{

	public function __construct(){
		if (!isset($_SESSION['lguser'])) {
			header("Location: logout.php");
		}
	}
}

$chsession = new chsession();
?>