<!DOCTYPE html>
<html>
<head>
	<title>Register | DevBook</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
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
	<div class="authentication-page">
        <div class="authentication-col">
            <div class="left-content">
                <h1>DevBook</h1>
                <p>Let's Create Something New !</p>
            </div>
            <div class="authntication-thumb">
                <img src="../assets/images/undraw_sign_up_n6im.svg" alt="Authentication Thumb">
            </div>
        </div>
        <div class="authentication-col">
            <div class="authentication-inner-wrapper">
                <div class="authentication-form">
                    <!-- Nav pills -->
                    <h4>Create Account</h4>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on">
					
						<div class="input-wrapper">
							<input type="text" name="fname" placeholder="First Name" required>
							<svg width="24" height="24" viewBox="0 0 24 24"><path d="M2.264 19.81c2.506-2.658 5.933-4.314 9.728-4.314s7.222 1.656 9.728 4.314a1 1 0 0 1-.728 1.686h-18a1 1 0 0 1-.728-1.686zM6.492 7.996a5.5 5.5 0 1 1 11 0 5.5 5.5 0 1 1-11 0z"></path></svg>
						</div>
						<?php echo "<p class='error'>".$fnameerror."</p>" ?>
						<div class="input-wrapper">
							<input type="text" name="lname" placeholder="Last Name" required>
							<svg width="24" height="24" viewBox="0 0 24 24"><path d="M2.264 19.81c2.506-2.658 5.933-4.314 9.728-4.314s7.222 1.656 9.728 4.314a1 1 0 0 1-.728 1.686h-18a1 1 0 0 1-.728-1.686zM6.492 7.996a5.5 5.5 0 1 1 11 0 5.5 5.5 0 1 1-11 0z"></path></svg>
						</div>
						<?php echo "<p class='error'>".$lnameerror."</p>" ?>
						<div class="input-wrapper">
							<input type="email" name="email" placeholder="Email" required>
							<svg width="24" height="24" viewBox="0 0 24 24"><path d="M1.469 7.845l.084.002c.131.014.281.121.581.335h0l7.569 5.407c.543.389 1.02.731 1.566.872a3 3 0 0 0 1.456.011c.547-.133 1.03-.467 1.579-.849h0l7.742-5.36.284-.177c.274-.1.581.061.655.343.016.062.016.152.016.33h0v6.483l-.044 2.01c-.046.562-.145 1.079-.392 1.564a4 4 0 0 1-1.748 1.748c-.485.247-1.002.346-1.564.392-.541.044-1.206.044-2.011.044h0H6.759c-.805 0-1.469 0-2.011-.044-.562-.046-1.079-.145-1.564-.392a4 4 0 0 1-1.748-1.748c-.247-.485-.346-1.002-.392-1.564C1 16.711 1 16.046 1 15.241V8.613c.001-.27.009-.418.064-.516.097-.171.293-.272.488-.251zM17.578 3l1.674.044c.562.046 1.079.144 1.564.392.621.317 1.168.804 1.548 1.394.099.154.149.231.162.348.01.091-.015.217-.059.297-.057.103-.149.167-.334.294h0l-8.852 6.128c-.735.509-.89.597-1.027.63a1 1 0 0 1-.485-.004c-.136-.035-.291-.126-1.018-.645h0L1.975 5.61c-.192-.137-.288-.206-.344-.314a.56.56 0 0 1-.049-.308c.019-.12.077-.198.192-.356.367-.501.851-.913 1.41-1.197.485-.247 1.002-.346 1.564-.392C5.289 3 5.954 3 6.759 3z"></path></svg>
						</div>
						<?php echo "<p class='error'>".$emailerror."</p>"; ?>
						<div class="input-wrapper">
							<input type="text" name="username" placeholder="Username" required>
							<svg width="24" height="24" viewBox="0 0 24 24"><path d="M2.264 19.81c2.506-2.658 5.933-4.314 9.728-4.314s7.222 1.656 9.728 4.314a1 1 0 0 1-.728 1.686h-18a1 1 0 0 1-.728-1.686zM6.492 7.996a5.5 5.5 0 1 1 11 0 5.5 5.5 0 1 1-11 0z"></path></svg>
						</div>
						<?php echo "<p class='error'>".$usernameerror."</p>"; ?>
						<div class="input-wrapper">
							<input type="password" name="password" placeholder="Password" required>
							<svg width="24" height="24" viewBox="0 0 24 24"><path d="M12 1.995a6 6 0 0 1 6 6v1.15c.283.062.554.152.816.286a4 4 0 0 1 1.748 1.748c.247.485.346 1.002.392 1.564.044.541.044 1.206.044 2.011v1.483l-.044 2.01c-.046.562-.144 1.079-.392 1.564a4 4 0 0 1-1.748 1.748c-.485.247-1.002.346-1.564.392-.541.044-1.206.044-2.01.044H8.759c-.805 0-1.469 0-2.011-.044-.562-.046-1.079-.144-1.564-.392a4 4 0 0 1-1.748-1.748c-.247-.485-.346-1.002-.392-1.564-.038-.464-.043-1.018-.044-1.674v-1.819l.044-2.011c.046-.562.144-1.079.392-1.564a4 4 0 0 1 1.748-1.748c.262-.134.533-.224.816-.286v-1.15a6 6 0 0 1 6-6zm0 11.5a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm0-9.5a4 4 0 0 0-4 4h0v1.002h8V7.995a4 4 0 0 0-4-4z"></path></svg>
						</div>
						<?php echo "<p class='error'>".$passworderror."</p>"; ?>
						<div class="input-wrapper confirm-wrapper">
							<input type="password" id= "cfpassword" name="cfpassword" placeholder="Confirm Password" required>
							<svg width="24" height="24" viewBox="0 0 24 24"><path d="M12 1.995a6 6 0 0 1 6 6v1.15c.283.062.554.152.816.286a4 4 0 0 1 1.748 1.748c.247.485.346 1.002.392 1.564.044.541.044 1.206.044 2.011v1.483l-.044 2.01c-.046.562-.144 1.079-.392 1.564a4 4 0 0 1-1.748 1.748c-.485.247-1.002.346-1.564.392-.541.044-1.206.044-2.01.044H8.759c-.805 0-1.469 0-2.011-.044-.562-.046-1.079-.144-1.564-.392a4 4 0 0 1-1.748-1.748c-.247-.485-.346-1.002-.392-1.564-.038-.464-.043-1.018-.044-1.674v-1.819l.044-2.011c.046-.562.144-1.079.392-1.564a4 4 0 0 1 1.748-1.748c.262-.134.533-.224.816-.286v-1.15a6 6 0 0 1 6-6zm0 11.5a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm0-9.5a4 4 0 0 0-4 4h0v1.002h8V7.995a4 4 0 0 0-4-4z"></path></svg>
							<i class="fa-solid fa-eye active"></i>
						</div>
						<?php echo "<p class='error'>".$passworderror."</p>"; ?>
						<button type="submit" class="btn btn-primary">Register</button>
						<p>Already have an account? <a style="text-decoration: underline;" href="login.php">Login here</a></p>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/custom.js"></script>
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