<?php
	session_start();
	require "database.php";

	if(isset($_POST['user_name'])){

		$query = "SELECT * FROM lgndetail WHERE  username = '".$_POST['user_name']."'";
		$avaresult = $conn->query($query);
		if ($avaresult->num_rows > 0) {
			echo '<span>Username is Already Exists</span>';
			$_SESSION['changeserror'] = "true";
		}else{
			echo '<span>Username is Available</span>';
		}
	}

	if(isset($_POST['email_check'])){
		if (!filter_var($_POST['email_check'], FILTER_VALIDATE_EMAIL)) {
			echo "Invalid Email Format";
			$_SESSION['changeserror'] = "true";
		}else{

			$emailquery = "SELECT * FROM lgndetail WHERE email = '".$_POST['email_check']."'";
			$emailavaresult = $conn->query($emailquery);
			if ($emailavaresult->num_rows > 0) {
				echo '<span>Email Already Used</span>';
				$_SESSION['changeserror'] = "true";
			}else{
				echo '<span>Email is Available</span>';
			}
		}
	}
?>