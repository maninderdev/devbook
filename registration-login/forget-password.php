<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forget Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
	<style>
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
	</style>
</head>
<body>
<?php
	require "database.php";
	$fpemailusername = "";
	$fpemailerror = "";
	$fpemailcheck = "";
	$fpsessionemail = "";
	if(isset($_SESSION['lgemail'])){
		$fpsessionemail = $_SESSION['lgemail'];
	}
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (empty($_POST['email'])) {
			$fpemailerror = "Email is Required";
		}
		if (!$_POST['email'] == "") {

				$fpemailcheck = $_POST['email']; 
				if (!filter_var($fpemailcheck, FILTER_VALIDATE_EMAIL)) {
					$fpemailerror = "Invalid Email Format";
				}else{
					$fpemailusername = $_POST['email'];

					$querycheck = "SELECT * FROM lgndetail WHERE email='$fpemailusername'";
					$lgresult = $conn->query($querycheck);

					if ($lgresult->num_rows == 1) {
						$row = $lgresult->fetch_assoc();
						$_SESSION['fgemail'] = $row['email'];
						$otp = rand(10000, 999999);
						$otphash = password_hash($otp,PASSWORD_DEFAULT);
						$codeupdate = "UPDATE lgndetail SET code='$otphash' WHERE email= '$fpemailusername'";
						$cdupdaters = $conn->query($codeupdate);
						require 'PHPMailerAutoload.php';
						require 'credential.php';

						$mail = new PHPMailer;

						//$mail->SMTPDebug = 3;                               // Enable verbose debug output

						$mail->isSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
						$mail->Username = EMAIL;                 // SMTP username
						$mail->Password = PASS;                           // SMTP password
						$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 465;                                    // TCP port to connect to

						$mail->setFrom(EMAIL, 'Maninder');
						$mail->addAddress($fpemailusername);     // Add a recipient
						$mail->addReplyTo(EMAIL);

						//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
						$mail->isHTML(true);                                  // Set email format to HTML

						$mail->Subject = 'Forget Password';
						$mail->Body    = "<div><p>Forget Your Password?</p><p>We received a request to reset the password for your account.</p><p>Here is Your OTP : </p><p style='width: 50%; margin: auto; font-size: 40px'>".$otp."</p></div>";
						$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						if(!$mail->send()) {
						    echo "<div class='form-output'>
	                  <h3>Message could not be sent.</h3><br/>
	                  <p class='link'>Mailer Error: ". $mail->ErrorInfo."</p>
	                  </div>";
						}else{
							header("Location: otp-authentication.php");
						}
					}else{
						$fpemailerror = "Invalid Email";
					}

				}
		}	
	}
?>	
<div class="form-wrap">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<h2>Forget Password</h2>
		<input type="text" name="email" placeholder="Email" class="input" value="<?php echo $fpsessionemail; ?>">
		<?php echo "<p class='error'>".$fpemailerror."</p>"; ?>
		<input type="submit" class="submit_btn">
		<p>Already have an account? <a href="login.php">Login here</a></p>
	</form>
</div>
</body>
</html>