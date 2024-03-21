<?php

session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script>
		$.getJSON("https://api.ipify.org?format=json", function(data) {
			var ip = data.ip;
			$('.ip').val(ip);
		});
	</script>
	<title>Login</title>
	<style>
	body{
		background:#000;
	}
.form-wrap {
    background: #fff;
    color: #7f8089;
    text-align: center;
    padding: 25px;
    position: absolute;
    left: 50%;
    right: 0;
    top: 50%;
    margin: 0 auto;
    transform: translate(-50%, -50%);
    width: 40%;
}.form-wrap {
    margin: 0;
}
	input.ip {
	    position: absolute;
	    top: 0;
	    left: 0;
	    display: none !important;
	    visibility: hidden !important;
	    opacity: 0 !important;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
$lgusernameerror = $lgpassworderror = "";
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$ip = $_POST['ip'];
	include "db.php";
	include "action/login.action.php";
	include "include/login.inc.php";
	$login = new login($email, $password, $ip);
	$login->login();
}



?>
<div class="form-wrap">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<h2>Login</h2>
		<input type="text" name="email" placeholder="Email/Username" class="input" >
		<?php echo "<p class='error'>".$lgusernameerror."</p>"; ?>
		<input type="password" name="password" placeholder="Password" class="input" >
		<?php echo "<p class='error'>".$lgpassworderror."</p>"; ?>
		<input type="text" name="ip" value="" class="ip">
		<input type="submit" class="submit_btn" value="Submit" name="submit">
		<p>
		<a href="forget-password.php">Forget Password?</a></p>
		<p>Don't have an account? <a href="registration.php">Registration Now</a></p>
	</form>
</div>

</body>
</html>