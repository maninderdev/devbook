<?php
//include auth_session.php file on all user panel pages
session_start();
include "include/session.inc.php";
require "database.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body class="other_user">
<?php

	if (isset($_POST['searchbtn'])) {
		$search_query = preg_replace("#[^a-z 0-9?!]#i", "", $_POST['searchbar']);
		header('Location: search.php?query='.urlencode($search_query).'');
	}
	$userimg = $firstname = $lastname = $usernameget = $useremail = "";
	if (isset($_GET['query'])) {
		$querygetid = urldecode($_GET['query']);

		$querygetuserdata = "SELECT * FROM lgndetail WHERE id='".$querygetid."'";

		$querygetuserrslt = $conn->query($querygetuserdata);

		if ($querygetuserrslt->num_rows == 1) {
			$userrow = $querygetuserrslt->fetch_assoc();
			$userimg = $userrow['img'];
			$firstname = $userrow['fname'];
			$lastname = $userrow['lname'];
			$usernameget = $userrow['username'];
			$useremail = $userrow['email'];
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
			<div class="home-search-bar">
				<?php include 'input_search.php'; ?>
			</div>
			<div class="user_profile">
				<div class="user_heading">
					Profile
				</div>
				<div class="user-details">
					<div class="user-image">
						<img src='<?php echo $userimg; ?>'>
					</div>
					<div class="user-text-detail">
						<h2 style="text-transform: capitalize;"><span><?php echo $firstname; ?></span> <span><?php echo $lastname; ?></span></h2>
						<p><i class="fa-solid fa-user"></i> <?php echo $usernameget; ?></p>
						<p><i class="fa-solid fa-envelope"></i> <?php echo $useremail; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script src="js.js"></script>
    <script>
    	 var ajaxObject=false;
    	$(document).ready(function(){
        	$("#searchbar").keyup(function(){
        		$('#query_result').addClass("active");
        		if ($(this).val() == "") {
        			$('#query_result').removeClass("active");
        		}
        		var search_query = $(this).val();
                   if(ajaxObject)
                   	  ajaxObject.abort();
        	ajaxObject=	$.ajax({

        			url:"search_action.php",
        			type: "POST",
        			data: {search_query:search_query},
        			dataType: "json",
        			success:function(html){
        				//console.log(html,html.length);
                           var itemHtml='<ul>';
                           var btntype = '';
                          for(i=0;i<html.length;i++){
                          		switch(html[i].type){
                          			case 'Accept':
                          			btntype = '<button class="friend-btn">Message</button>';
                          			break;
                          			case 'Pending':
                          			btntype = '<button class="friend-btn" disabled="disabled">Pending</button>';
                          			break;
                          			case 'Reject':
                          			btntype = '<button class="friend-btn" disabled="disabled">Rejected</button>';
                          			break;
                          			default:
                          			btntype = '<button href="javascript:void(0)" data-usertoid="'+html[i].id+'" class="friend-btn request_id_'+html[i].id+'">Add Friend</button>';
                          		}
                               itemHtml+='<li class="search_result">\
											<a href="#">\
												<img src="'+html[i].img+'">\
											</a>\
											<h4 class="user-name">'+html[i].fname+' '+html[i].lname+'</h4>\
											'+btntype+'\
										</li>';
                          }
                          itemHtml+='</ul>';
        				$('#query_result').html(itemHtml);
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
								        $('.request_id_'+data_to_id).html(data);
										$('.request_id_'+data_to_id).html('<i class="fa-solid fa-clock"></i> Request Send');
								     },600);
								}
							});
						});
        			}
        		});
        	});
        });
    </script>
</body>
</html>