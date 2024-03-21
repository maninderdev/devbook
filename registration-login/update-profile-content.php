<?php

	require "database.php";
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (empty($_POST['textpassword'])) {
			$reqpasserror = "alert('Password Is Required');";
		}
		if (!$_POST['textpassword'] == "") {

			$textpassword = $_POST['textpassword'];
			$getuseremail = $_SESSION['lgemail'];
			$getusername = $_SESSION['lguser'];

			$textquerycheck = "SELECT * FROM lgndetail WHERE (email='$getuseremail' OR username = '$getusername')";
			$textresult = $conn->query($textquerycheck);

			if ($textresult->num_rows == 1) {
				$textrow = $textresult->fetch_assoc();
				$strtxtpassword = strval($textpassword);
				$strtxthashpass = strval($textrow['password']);
				if(password_verify($strtxtpassword, $strtxthashpass)){
					$inserttxt = "UPDATE lgndetail SET fname='".$_POST['fname']."', lname = '".$_POST['lname']."', username='".$_POST['username']."', email='".$_POST['email']."' WHERE (email='$getuseremail' OR username = '$getusername')";
					$result = $conn->query($inserttxt);
					header("Location: user_profile.php");
				}else{
					$_SESSION['incpass'] = "alert('Incorrect Password');";
					header("Location: user_profile.php");
				}
			}
		}
	}

?>