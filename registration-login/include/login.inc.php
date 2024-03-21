<?php
class login extends loginaction{
	public $email;
	public $password;
	public $ip;

	public function __construct($email, $password, $ip){
		$this->email = $email;
		$this->password = $password;
		$this->ip = $ip;
	}

	public function login(){
		$result = true;
		if ($this->inputEmpty() == false) {
			echo "<script>alert('Input is Empty');</script>";
			$result = false;
		}

		if ($result == true) {
			switch ($this->action($this->email, $this->password, $this->ip)) {
				case 'true':
					echo "<script>window.top.location='../registration-login/dashboard.php'</script>";
					break;
				case 'passfalse':
					echo "<script>alert('Incorrect Password');</script>";
					break;
				default:
					echo "<div class='form-output'>
	                  <h3>Incorrect Username/password.</h3><br/>
	                  <p class='link'>Click here to <a href='../registration-login/login.php'>Login</a> again.</p>
	                  </div>";
					break;
			}
			
		}
	}

	private function inputEmpty(){
		$result;
		if (empty($this->email) || empty($this->password)) {
			$result = false;
		}else{
			$result = true;
		}

		return $result;
	}
}

?>