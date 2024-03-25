<?php
session_start();
	include "include/session.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Messaging</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
</head>
<body>
<?php

	if (isset($_POST['searchbtn'])) {
		$search_query = preg_replace("#[^a-z 0-9?!]#i", "", $_POST['searchbar']);
		header('Location: search.php?query='.urlencode($search_query).'');
	}


?>

	<!-- <div class="top-bar">
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
	</div> -->
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
				<?php include 'include/message.friend.inc.php';?>
			</div>
			<div class="messaging-wrapper" id="0">
				<div class="content-wrapper">
					<div class="msg-form-close">
						<i class="fa-solid fa-xmark"></i>	
					</div>
					<div class="messages">
						
					</div>
					<div class="message-inputs" >
								<div id="imagePreview">
								
								</div>
						<form method="POST" id="message-form">
								<textarea type="textarea" name="message" placeholder="Type a message" id="message" ></textarea>
							<div class="files">
								<i class="fa-solid fa-paperclip"></i>
								<input type="file" name="msg_file" id="file" onchange="return fileValidation()">
							</div>
							<div class="submit-wrapper">
								<a href="javascript:void(0)" id="a_submit">
									<i class="fa-solid fa-paper-plane"></i>
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script src="js.js"></script>
    <script>
    	/*$(".emojionearea").keypress(function(){
    		console.log("dfgdfgg");
		if (e.keyCode == 13 && !e.shiftKey)
		{
		    e.preventDefault();
		}
		});*/
    	$("#message").emojioneArea({
    		pickerPosition: "top",
    		events: {
					keydown: function (editor, event) {
						if(event.which == 13 && !event.shiftKey){
							event.preventDefault();
							$("#message-form").submit();
						}
					}
				}
    	});
    	$("#a_submit").click(function() {
		   $("#message-form").submit();
		});
    </script>
    <script src="js/message.filevalidation.js"></script>
    <script src="js/message.fetch.js"></script>
    <script src="js/message.get.js"></script>
    <script src="js/message.submit.js"></script>
</body>
</html>