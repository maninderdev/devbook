<?php

class registrationaction {

	protected function setdata($fname, $lname, $username, $email, $password){
		global $dbObject;
		$setdata = "INSERT INTO lgndetail (fname, lname, username, password, email)
					VALUES ('$fname', '$lname', '$username', '$password', '$email')";

		$setdataget = $dbObject->query($setdata);

		if ($setdataget) {
			$resultget = true;
		}else{
			$resultget = false;
		}

		return $resultget;
	}

	protected function checkuser($username){
		global $dbObject;
		$usernamecheck = "SELECT username FROM lgndetail WHERE username = '$username'";
		$usernamecheckget = $dbObject->query($usernamecheck);
		$resultusername;
		if ($usernamecheckget->num_rows > 0) {
			$resultusername = false; 
		}else{
			$resultusername = true;
		}

		return $resultusername;
	}

	protected function checkemail($email){
		global $dbObject;
		$emailnamecheck = "SELECT email FROM lgndetail WHERE email = '$email'";
		$emailnamecheckget = $dbObject->query($emailnamecheck);
		$resultemail;
		if ($emailnamecheckget->num_rows > 0) {
			$resultemail = false; 
		}else{
			$resultemail = true;
		}

		return $resultemail;
	}
}

?>