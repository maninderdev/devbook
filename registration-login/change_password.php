<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
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
		.confirm-wrapper input.input {
		    width: 100%;
		    max-width: calc(100% - 20px);
		}
		.confirm-wrapper {
		    position: relative;
		}
		.confirm-wrapper i {
		    position: absolute;
		    top: 50%;
		    right: 12px;
		    transform: translateY(-50%);
		    width: 22px;
		}
		.fa-eye.active:before {
	    	content: "\f070";
		}
	</style>
</head>
<body>
<?php
	require "database.php";
	session_start();
	$cgpassword = "";
	$cfcgpassword = "";
	$passcgerror = $cfcgpass = "";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (empty($_POST['password'])) {
			$passcgerror = "Password is Required";
		}
		if(empty($_POST['cfpassword'])){
			$cfcgpass = "Confirm-Password is Required";
		}
		if (!$_POST['password'] == "") {
			if(!$_POST['cfpassword'] == ""){
				if($_POST['password'] == $_POST['cfpassword']){
					if(isset($_SESSION['otpcfemail'])){

						$cgpassword = $_POST['password'];
						$cgpasshash = password_hash($cgpassword,PASSWORD_DEFAULT);
						$emailcheckcg = $_SESSION['otpcfemail'];
						$cgquerycheck = "UPDATE lgndetail SET password='$cgpasshash' WHERE email= '$emailcheckcg'";
						$lgresult = $conn->query($cgquerycheck);

						if ($lgresult) {
				            header("Location: login.php"); 
						}else{echo "<div class='form-output'>
			                  <h3>Password Not Changed</h3><br/></div>";}
			
					}else{
						echo "<div class='form-output'>
				                  <h3>OTP Validation Expired</h3><br/>
				                  <p class='link'>Click here to <a href='forget-password.php'>OTP</a> again.</p>
				                  </div>";
					}
				}else{
					$passcgerror = "Password Not Match";
					$cfcgpass = "Password Not Match";
				}

			

			}	
		}

	}
?>	
<div class="form-wrap">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="on">
		<h2>Change Password</h2>
		<input type="password" name="password" placeholder="Password" class="input" >
		<?php echo "<p class='error'>".$passcgerror."</p>"; ?>
		<div class="confirm-wrapper">
			<input type="password" name="cfpassword" placeholder="Confirm-Password" class="input" id= "cfpassword" >
			<i class="fa-solid fa-eye active"></i>
		</div>
		<?php echo "<p class='error'>".$cfcgpass."</p>"; ?>
		<input type="submit" class="submit_btn">
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