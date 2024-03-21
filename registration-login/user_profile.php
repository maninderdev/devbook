<?php
//include auth_session.php file on all user panel pages
session_start();
include "include/session.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Profile</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script>
	function fileValidation() {
            var fileInput = document.getElementById('file');
            var filePath = fileInput.value;
            var extensionpreview = "false";
            var sizepreview = "false";
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
              
            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fileInput.value = '';
                return false;
            } 
            else {
	            if (fileInput.files && fileInput.files[0]) {
	                var extensionpreview = "true";
	            }
            }

            if (fileInput.files.length > 0) {
            for (var i = 0; i <= fileInput.files.length - 1; i++) {
  
	                const fsize = fileInput.files.item(i).size;
	                const file = Math.round((fsize / 1024));
	                // The size of the file.
	                if (file >= 2000) {
	                	fileInput.value = '';
	                	document.getElementById('imagePreview').innerHTML = "";
	                    alert("File too Big, please select a file less than 2mb");
	                }else{
	                	sizepreview = "true";
	                }
	            }
	        }
	        if(extensionpreview == "true" && sizepreview == "true"){
	        	var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(
                        'imagePreview').innerHTML = 
                        '<img src="' + e.target.result
                        + '"/>';
                };
                reader.readAsDataURL(fileInput.files[0]);
                <?php
					require "database.php";
                	$password = $passerror = $incpasserror = "";
                	$file = $fileerror = $reqpasserror = "";
                	if ($_SERVER['REQUEST_METHOD'] == "POST") {
                		if (empty($_POST['imgpassword'])) {
							$passerror = "Password is Required";
							$reqpasserror = "alert('Password Is Required');";
						}else{

							$password = $_POST['imgpassword'];
							$useremail = $_SESSION['lgemail'];
							$username = $_SESSION['lguser'];

							$imgquerycheck = "SELECT * FROM lgndetail WHERE (email='$useremail' OR username = '$username')";
							$lgresult = $conn->query($imgquerycheck);

							if ($lgresult->num_rows == 1) {
								$row = $lgresult->fetch_assoc();
								$strpassword = strval($password);
								$strhashpass = strval($row['password']);
								if(password_verify($strpassword, $strhashpass)){
									if(isset($_FILES['uploadimage'])){
										$filename = $_FILES['uploadimage']['name'];
										$insertimg = "UPDATE lgndetail SET img='../images/$filename' WHERE (email='$useremail' OR username = '$username')";
										$result = $conn->query($insertimg);
										move_uploaded_file($_FILES['uploadimage']['tmp_name'], '../images/' . $_FILES['uploadimage']['name']);
									}
								}else{
									$incpasserror = "alert('Incorrect Password');";
									$passerror = "Incorrect Password";
								}
							}
						}
            		}
	                
                ?>
            }
        }

         /*<?php 
         if(isset($_SESSION['incpass'])){
         	echo $_SESSION['incpass'];
         	unset($_SESSION['incpass']);
         }
         ?>
         <?php echo $incpasserror; ?>*/
</script>
<script>
        $(document).ready(function(){
        	$("#username").blur(function(){
        		var username = $(this).val();

        		$.ajax({

        			url:"usercheck.php",
        			method: "POST",
        			data: {user_name:username},
        			datatype: "text",
        			success:function(html){
        				$('#avalability').html(html);
        			}
        		});
        	});
        });
        $(document).ready(function(){
        	$("#email").blur(function(){
        		var email = $(this).val();

        		$.ajax({

        			url:"usercheck.php",
        			method: "POST",
        			data: {email_check:email},
        			datatype: "text",
        			success:function(html){
        				$('#emailavailable').html(html);
        			}
        		});
        	});
        });
</script>
</head>
<body>
<?php
	if (!isset($_SESSION['lguser'])) {
		header("Location: logout.php");
	}else{


		$userid = $_SESSION['lgid'];
		$username = $_SESSION['lguser'];

		$userdetail = "SELECT * FROM lgndetail WHERE (id='$userid' OR username = '$username')";
		$userresult = $conn->query($userdetail);

		if ($userresult->num_rows == 1) {
			$row = $userresult->fetch_assoc();
			$firstname = $row['fname'] ;
			$lastname = $row['lname'] ;
			$usernameget = $row['username'] ;
			$userimg = $row['img'] ;
			$useremail = $row['email'] ;
			$lastupdatedate = $row['reg_date'] ;

		}
	}

?>
<div class="top-bar">
	<div class="logo">
		<div class="mobile-menu">
			<a href="javascript:void(0)" class="menu-bar">
				<span class="bars bar1"></span>
				<span class="bars bar2"></span>
				<span class="bars bar3"></span>
				<span class="bars bar4"></span>
			</a>
		</div>
		<a href="dashboard.php">
			<h2>Logo</h2>
		</a>
	</div>
	<div class="admin-user">
		<div class="admin-text">
			Admin User
			<i class="fa-solid fa-angle-down"></i>
		</div>
		<div class="user-opions">
			<a href="user_profile.php"><i class="fa-solid fa-user"></i> Edit Profile</a>
			<a href="forget-password.php"><i class="fa-solid fa-gear"></i> Change Password</a>
			<div class="log-out">
				<a href="../registration-login/logout.php"><i class="fa-solid fa-power-off"></i> Logout</a>
			</div>
		</div>
	</div>
</div>
<div class="body-wrapper">
	<?php include "nav-bar.php" ?>
	<div class="home-wrapper">
		<div class="user_heading">
			Admin Profile
		</div>
		<div class="user-details">
			<div class="user-image">
				<img src='<?php echo $userimg; ?>'>
				<a href="javascript:void(0)" id="user_img-update">Update</a>
			</div>
			<div class="user-text-detail">
				<h2 style="text-transform: capitalize;"><span><?php echo $firstname; ?></span> <span><?php echo $lastname; ?></span></h2>
				<p>Punjab, India <i class="fa-solid fa-location-dot"></i></p>
				<p><i class="fa-solid fa-user"></i> <?php echo $usernameget; ?></p>
				<p><i class="fa-solid fa-envelope"></i> <?php echo $useremail; ?></p>
				<p><i class="fa-solid fa-calendar-days"></i> <?php echo $lastupdatedate; ?></p>
				<a href="javascript:void(0)" id="edit-profile">Edit</a>
			</div>
		</div>
		<div class="changes-form-wrapper">
			<div class="form-close">
				<i class="fa-solid fa-xmark"></i>	
			</div>
			<form method="post" action="update-profile-content.php" autocomplete="on" onsubmit="return textform(form1)" name="form1" >
				<h2>Update Profile</h2>
				<div class="input-wrapper">
					<div>
						<label>First Name :</label>
						<input type="text" name="fname" id="first_name" placeholder="First Name" class="input" value='<?php echo $firstname; ?>'>
					</div>
					<div>
						<label>Last Name :</label>
						<input type="text" name="lname" id="last_name" placeholder="Last Name" class="input" value='<?php echo $lastname; ?>'>
					</div>
				</div>
				<div class="input-wrapper">
					<div>
						<label>Email :</label>
						<input type="email" name="email" id="email" placeholder="Email" class="input" value='<?php echo $useremail; ?>'>
						<div id="emailavailable"></div>
					</div>
					<div>
						<label>Username :</label>
						<input type="text" name="username" id="username" placeholder="Username" class="input" value='<?php echo $usernameget; ?>'>
						<div id="avalability"></div>
					</div>
				</div>
				<div class="input-wrapper">
					<div>
						<input type="password" name="textpassword" placeholder="Password" class="input" required>
					</div>
					<input type="submit" class="submit_btn" value="Update">
				</div>
			</form>
		</div>
		<div class="update-image">
			<div class="img-form-close">
				<i class="fa-solid fa-xmark"></i>	
			</div>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" onsubmit="return imgform(form2)" name="form2" >
				<h2>Update Image</h2>
				<div class="img-input-wrapper" style="border: 0;">
					<input type="file" name="uploadimage" id="file" onchange="return fileValidation()">
					<div id="imagePreview"></div>
				</div>
				<div class="img-input-wrapper" style="align-items: flex-start;">
					<div>
						<input type="password" name="imgpassword" placeholder="Password" id="imgpass" required>
						<?php echo "<p class='error'>".$passerror."</p>"?>
					</div>
					<input type="submit" value="Update" onclick="imgsubmit()">
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	function textform(form){
        if(form.lname.value.length == 0 || form.fname.value.length == 0 || form.username.value.length == 0 || form.email.value.length == 0 || form.textpassword.value.length == 0){
			alert("Input cannot be empty");
                return false;
		}else {
                return true;
        } 
	}
	function imgform(form2){
        if(form2.imgpassword.value.length == 0 ){
			alert("Input cannot be empty");
                return false;
		}else {
                return true;
        } 
	}
</script>
<script src="js.js">
    </script>
</body>
</html>