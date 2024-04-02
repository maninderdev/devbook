<?php 	$userid = $_SESSION['lgid'];
		$username = $_SESSION['lguser'];

		$fullName = "SELECT fname, lname FROM lgndetail WHERE (id='$userid' OR username = '$username')";
		$fullNameQuery = $conn->query($userdetail);

		if ($fullNameQuery->num_rows == 1) {
			$fullNameFetch = $fullNameQuery->fetch_assoc();
			$searchfirstname = substr($fullNameFetch['fname'],0,1);
			$searchlastname = substr($fullNameFetch['lname'],0,1);
		}
?>
<div class="header-search">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete="off">
		<div class="search_input_wrapper">
			<input type="search" name="searchbar" placeholder="Search" id="searchbar">
			<span id="search_close">
				<i class="fa-solid fa-xmark"></i>
			</span>
		</div>
		<div id="query_result" class=""></div>
	</form>
	<div class="header-user">
		<div class="admin-name">
			<p>👋 Hey, <?php echo $_SESSION['lgfname']; ?></p>
		</div>
		<div class="user-profile-wrapper dropdown-wrapper">
			<button class="btn user-drop-toggle" title="<?php echo $searchfirstname.$searchlastname;?>"><?php echo $searchfirstname.$searchlastname;?></button>
			<div class="dropdown user-dropdown" style="display: none;">
				<ul class="dropdown-list">
					<li class="dropdown-item">
						<a href="user_profile.php"><i class="fa-solid fa-user"></i> Edit Profile</a>
					</li>
					<li class="dropdown-item">
						<a href="forget-password.php"><i class="fa-solid fa-gear"></i> Change Password</a>
					</li>
					<li class="dropdown-item">
						<a href="../registration-login/logout.php"><i class="fa-solid fa-power-off"></i> Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>