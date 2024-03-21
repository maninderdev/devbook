<?php
class loginaction {
	
	protected function action($email, $password, $ip){
		global $dbObject;
		$queryselect = "SELECT * FROM lgndetail WHERE email = '$email' OR username = '$email' limit 1";

		$querycheck = $dbObject->query($queryselect);
		$result;
		if ($querycheck->num_rows == 1) {
			$row = $querycheck->fetch_assoc();
			$strlgpassword = strval($password);
			$strhashpass = strval($row['password']);
			if(password_verify($strlgpassword, $strhashpass)){
				$queryip = "UPDATE lgndetail SET login_ip='$ip' WHERE (id=".$row['id'].")";
				$queryipget = $dbObject->query($queryip);
				$_SESSION['lguser'] = $row['username'];
				$_SESSION['lgid'] = $row['id'];
				$_SESSION['lgemail'] = $row['email'];
				$_SESSION['lgfname'] = $row['fname'];
				$_SESSION['lglname'] = $row['lname'];
				$result = 'true';
			}else{
				$result = 'passfalse';
			}
		}else{
			$result = false;
		}
		return $result;
	}
	
}

?>