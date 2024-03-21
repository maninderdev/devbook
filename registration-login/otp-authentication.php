<!DOCTYPE html>
<html>
<head>
	<title>OTP Authentication</title>
	<style>
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
		  -webkit-appearance: none;
		  margin: 0;
		}

		/* Firefox */
		input[type=number] {
		  -moz-appearance: textfield;
		}
		body {
		    margin: 0;
		    background: #3e4144;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		    height: 100vh;
		    flex-direction: column;
		    color: #fff;
		}
		.form-output {
		    font-family: sans-serif;
		    text-align: center;
		}
		.form-output p.link {
    		margin-top: 0;
		}
		.form-output h3 {
		    margin-bottom: 0;
		}
		.form-wrap {
		    background: #fff;
		    color: #7f8089;
		    text-align: center;
		    padding: 25px;
		}
		.form-wrap form {
		    display: flex;
		    flex-direction: column;
		    justify-content: center;
		}
		.form-wrap h2 {
		    font-size: 30px;
		    font-family: sans-serif;
		    font-weight: 500;
		    margin-top: 0;
		}
		input.input {
		    margin-bottom: 5px;
		    padding: 10px;
		    border: 1px solid #dbdbdb;
		    border-radius: 3px;
		}
		input.submit_btn {
		    margin-bottom: 15px;
		    padding: 12px;
		    border: none;
		    border-radius: 3px;
		    background: #55a0fc;
		    color: #fff;
		}
		input.submit_btn:hover{
			color: #d0e8fe;
		}
		.form-wrap p {
		    margin-top: 0;
		    font-size: 16px;
		    font-family: sans-serif;
		}
		.form-wrap p a, .form-output p.link a {
		    color: inherit;
		}
		p.error {
		    color: #a52a2a;
		    margin-bottom: 14px;
		    text-align: left;
		    font-size: 14px;
		}
		.form-wrap input[type="number"] {
		    height: 30px;
		    letter-spacing: 20px;
		    font-size: 18px;
		    padding: 0 45px;
		}
	</style>
</head>
<body>
<?php
	require "database.php";
	session_start();
	$otp = "";
	$otpcheck = "";
	$otperror = "";
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (empty($_POST['otp'])) {
			$otperror = "OTP is Required";
		}
		if (!$_POST['otp'] == "") {
			if(isset($_SESSION['fgemail'])){
				$otpcheck = $_POST['otp'];
				$otpemail = $_SESSION['fgemail'];
				$otpquerycheck = "SELECT * FROM lgndetail WHERE email='$otpemail'";
				$lgresult = $conn->query($otpquerycheck);

				if ($lgresult->num_rows == 1) {
					$row = $lgresult->fetch_assoc();
					$outputotp = strval($otpcheck);
					$otphashform = strval($row['code']);
					if (password_verify($outputotp, $otphashform)) {
						$_SESSION['otpcfemail'] = $row['email'];
						header("Location: change_password.php"); 
					}else{
						echo "<div class='form-output'>
		                  <h3>Incorrect OTP</h3><br/>
		                  <p class='link'>Click here to <a href='forget-password.php'>RESEND</a> OTP.</p>
		                  </div>";
					}
				}
			}

		}	
	}
?>
<div class="form-wrap">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<h2>OTP Authentication</h2>
		<input type="number" name="otp" min="10000" max="999999" placeholder="000000">
		<?php echo "<p class='error'></p>"; ?>
		<input type="submit" class="submit_btn">
	</form>
</div>
</body>
</html>