<?php

class regisration extends registrationaction{
	public $fname;
	public $lname;
	public $email;
	public $username;
	public $password;
	public $cfpassword;

	public function __construct($fname, $lname, $email, $username, $password, $cfpassword){
		$this->fname =  $fname;
		$this->lname =  $lname;
		$this->email =  $email;
		$this->username =  $username;
		$this->password =  $password;
		$this->cfpassword =  $cfpassword;
	}

	public function register(){
		$result = true;
		$hashpassword;
		if ($this->inputEmpty() == false) {
			echo "<script>alert('Input is Empty');</script>";
			$result = false;
		}else{
			if ($this->validusername() == false) {
				echo "<script>alert('Username Contain Only letters and white space');</script>";
				$result = false;	
			}
			if ($this->validemail() == false) {
				echo "<script>alert('Invalid Email Address');</script>";
				$result = false;
			}
			if ($this->matchpasswords() == false) {
				echo "<script>alert('Passwords Not Match');</script>";
				$result = false;
			}else{
				$hashpassword = password_hash($this->password,PASSWORD_DEFAULT);
			}

			if($this->checkuser($this->username) == false){
				echo "<script>alert('Username Already Exist');</script>";
				$result = false;
			}
			if($this->checkemail($this->email) == false){
				echo "<script>alert('Email Already Used');</script>";
				$result = false;
			}
		}
		if ($result == true) {
			if ($this->setdata($this->fname, $this->lname, $this->username, $this->email, $hashpassword	) == true) {
				echo "<div class='form-output'>
	                  <h3>You are registered successfully.</h3><br/>
	                  <p class='link'>Click here to <a style='text-decoration: underline;' href='../registration-login/login.php'>Login</a></p>
	                  </div>";
			}else{
				echo "<div class='form-output'>
	                  <h3>Required fields are missing.</h3><br/>
	                  <p class='link'>Click here to <a href='../registration-login/registration.php'>registration</a> again.</p>
	                  </div>";
			}
			
		}
	}

	private function inputEmpty(){
		$result;
		if (empty($this->fname) || empty($this->lname) || empty($this->email) || empty($this->username) || empty($this->password) || empty($this->cfpassword) ) {
			$result = false;
		}else{
			$result = true;
		}

		return $result;
	}

	private function validusername(){
		$result;
		if (!preg_match("/^[a-zA-Z-'0-9 ]*$/",$this->username)) {
	      $result = false;
		}else{
			$result = true;
		}

		return $result;
	}

	private function validemail(){
		$result;
		if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$result = false;
		}else{
			$result = true;
		}

		return $result;
	}

	private function matchpasswords(){
		$result;
		if ($this->password != $this->cfpassword ) {
			$result = false;
		}else{
			$result = true;
		}

		return $result;
	}

}

?>