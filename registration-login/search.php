<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php

	session_start();
	require "database.php";
if (isset($_SESSION['lguser'])) {
$query = "Search A Query";
	if (isset($_GET['query'])) {
		$query = urldecode($_GET['query']);
		//$query = preg_replace("#[^a-z 0-9?!]#i", "", $query]);
	}
	if (!isset($query)) {
		if (isset($_POST['searchbtn'])) {
			$search_query = preg_replace("#[^a-z 0-9?!]#i", "", $_POST['searchbar']);
			header('Location: search.php?query='.urlencode($search_query).'');
		}
	}
	
}else{
	header('Location: logout.php');
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
			<div class="search-row-wrapper">
				<h2>Search Result For <b>"<?php echo $query; ?>"</b></h2>
				<div id="search_result_area">
				</div>
			</div>
		</div>
</div>



</body>
	<script>
		var ajaxObject=false;
    	$(document).ready(function(){
        		var search_query = '<?php echo $query; ?>';
                   if(ajaxObject)
                   	  ajaxObject.abort();
        	ajaxObject=	$.ajax({

        			url:"search_action.php",
        			type: "POST",
        			data: {search_query:search_query},
        			dataType: "json",
        			success:function(html){
                           var itemHtml='<ul>';
                          var btntype = '';
                          for(i=0;i<html.length;i++){
                          		switch(html[i].type){
                          			case 'Accept':
                          			btntype = '<a class="friend-btn" href="messaging.php">Message</a>';
                          			break;
                          			case 'Pending':
                          			btntype = '<button class="friend-btn" disabled="disabled">Pending</button>';
                          			break;
                          			case 'Reject':
                          			btntype = '<button class="friend-btn" disabled="disabled">Rejected</button>';
                          			break;
                          			default:
                          			btntype = '<a href="javascript:void(0)" class="friend-btn request_id_'+html[i].id+'" data-usertoid="'+html[i].id+'" >Add Friend</a>';
                          		}
                               itemHtml+='<li class="search_result">\
											<a href="profile_user.php?query='+html[i].id+'">\
												<img src="'+html[i].img+'">\
											</a>\
											<h4 class="user-name">'+html[i].fname+' '+html[i].lname+'</h4>\
											'+btntype+'\
										</li>';
                          }
                          itemHtml+='</ul>';
        				$('#search_result_area').html(itemHtml);
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
        			}
        		});
        	});
	</script>
</html>