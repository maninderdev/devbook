<?php
session_start();
	include "include/session.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Friends</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php

	if (isset($_POST['searchbtn'])) {
		$search_query = preg_replace("#[^a-z 0-9?!]#i", "", $_POST['searchbar']);
		header('Location: search.php?query='.urlencode($search_query).'');
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
		<div class="home-search-bar">
				<?php include 'input_search.php'; ?>
		</div>
		<div class="friend-List-wrapper">
			<div class="friends-heading">
				Friend List
			</div>
			<?php 
				include "include/friend.list.inc.php";
				$friends = new friendList();
				$friends->friend();
			?>
		</div>
	</div>
</div>
<script src="js.js"></script>

</body>
</html>