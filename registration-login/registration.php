<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
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
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
$fnameerror = $lnameerror = $usernameerror = $emailerror = $passworderror = "";

if (isset($_POST['submit'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$cfpassword = $_POST['cfpassword'];
	include "db.php";
	include "action/registration.action.php";
	include "include/registration.inc.php";
	$registration = new regisration($fname, $lname, $email, $username, $password, $cfpassword);
	$registration->register();
}

?>
	
<div class="form-wrap">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on">
		<h2>Registration</h2>
		<div class="input-wrapper">
			<div>
				<input type="text" name="fname" placeholder="First Name" class="input">
				<?php echo "<p class='error'>".$fnameerror."</p>" ?>
			</div>
			<div>
				<input type="text" name="lname" placeholder="Last Name" class="input">
				<?php echo "<p class='error'>".$lnameerror."</p>" ?>
			</div>
		</div>
		<div class="input-wrapper">
			<div>
				<input type="email" name="email" placeholder="Email" class="input" >
				<?php echo "<p class='error'>".$emailerror."</p>"; ?>
			</div>
			<div>
				<input type="name" name="username" placeholder="Username" class="input" >
				<?php echo "<p class='error'>".$usernameerror."</p>"; ?>
			</div>
		</div>
		<div class="input-wrapper">
			<div>
				<input type="password" name="password" placeholder="Password" class="input" >
				<?php echo "<p class='error'>".$passworderror."</p>"; ?>
			</div>
			<div>
				<div class="confirm-wrapper">
					<input type="password" name="cfpassword" placeholder="Confirm-Password" class="input" id= "cfpassword" >
					<i class="fa-solid fa-eye active"></i>
				</div>
				<?php echo "<p class='error'>".$passworderror."</p>"; ?>
			</div>
		</div>
		<input type="submit" class="submit_btn" name="submit">
		<p>Already have an account? <a style="text-decoration: underline;" href="login.php">Login here</a></p>
	</form>
</div>

<script>
	var icons = document.querySelector('.confirm-wrapper i');
	var cfpassword = document.querySelector('#cfpassword');
			icons.addEventListener("click", function icons(){

				const type = cfpassword.getAttribute("type") === "password" ? "text" : "password";
           		cfpassword.setAttribute("type", type);

			     this.classList.toggle("active");
			});
</script>
</body>
</html>