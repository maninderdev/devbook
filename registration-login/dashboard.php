<?php
session_start();
include "include/session.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Client area</title>
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


	include "db.php";
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
			<div class="freind-list-wrapper">
				<div class="friend-requests">
					<div class="request-heading">
						Requests
					</div>
					<?php include 'friend-requests.php'; ?>
				</div>
				<div class="add-freinds">
					<div class="suggestion-heading">
						Suggestions
					</div>
					<div class="freinds-suugestion">
						<?php include 'friend-suggestions.php'; ?>
					</div>
				</div>	
			</div>
		</div>
	</div>
</body>

    <script src="js.js"></script>
	<script>
    	


		$(document).ready(function(){
			$(".friend-btn").click(function(){
				var data_to_id = $(this).data('usertoid');
				var action = 'Send_request';
					
					$.ajax({

					url:"friend_action.php",
					type: "POST",
					data: {data_to_id:data_to_id, action:action},
					dataType: "text",
					beforeSend:function(){
						$('.request_id_'+data_to_id).attr('disabled', 'disabled');
						$('.request_id_'+data_to_id).html('<i class="fa-duotone fa-spinner"></i> Sending...');
					},
					success:function(data){
						setTimeout(function(){
							$('.request_id_'+data_to_id).html('<i class="fa-solid fa-clock"></i> Request Send');
					     },600);
					}
				});
			});
		});	
		$(document).ready(function(){
			$(".accept_friend_btn").click(function(){
				var data_from_id = $(this).data('userfromid');
				var action = 'accept_request';
					$.ajax({

					url:"friend_action.php",
					type: "POST",
					data: {data_from_id:data_from_id, action:action},
					dataType: "text",
					beforeSend:function(){
						$('#reject_id_'+data_from_id).attr('style', 'display:none');
						$('#accept_id_'+data_from_id).attr('disabled', 'disabled');
						$('#accept_id_'+data_from_id).html('<i class="fa-duotone fa-spinner"></i> Accepting...');
					},
					success:function(data){
						setTimeout(function(){
							$('#accept_id_'+data_from_id).html('<i class="fa-solid fa-user-group"></i> Accepted');
					     },600);
					}
				});
			});
		});	
		$(document).ready(function(){
			$(".reject_request_btn").click(function(){
				var reject_data_from_id = $(this).data('userfromid');
				var action = 'reject_request';
					$.ajax({

					url:"friend_action.php",
					type: "POST",
					data: {reject_data_from_id:reject_data_from_id, action:action},
					dataType: "text",
					beforeSend:function(){
						$('#accept_id_'+reject_data_from_id).attr('style', 'display:none');
						$('#reject_id_'+reject_data_from_id).attr('disabled', 'disabled');
						$('#reject_id_'+reject_data_from_id).html('<i class="fa-duotone fa-spinner"></i> Rejecting...');
					},
					success:function(data){
						setTimeout(function(){
							$('#reject_id_'+reject_data_from_id).html('<i class="fa-solid fa-user-group"></i> Rejected');
					     },600);
					}
				});
			});
		});	
    </script>
</html>