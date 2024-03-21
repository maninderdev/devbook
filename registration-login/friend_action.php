<?php
	session_start();
	require "database.php";

	if(isset($_POST['data_to_id'])){
		$datatoid = $_POST['data_to_id'];
		$datafromid = $_SESSION['lgid'];
		$request_status = 'Pending';
		$datafriend = 'No';

		$queryrequestinsert = "INSERT INTO requests (request_from_id, request_to_id, request_status, friend)
								VALUES ('$datafromid', '$datatoid', '$request_status', '$datafriend')";

		$requestinsertresult = $conn->query($queryrequestinsert);					
	}
	if (isset($_POST['data_from_id'])) {
		$accept_status = 'Accept';
		$acceptdatafriend = 'Yes';

		$friendupdate = "UPDATE requests SET request_status='".$accept_status."' , friend='".$acceptdatafriend."' WHERE request_from_id= '".$_POST['data_from_id']."' AND request_to_id ='".$_SESSION['lgid']."' AND request_status='Pending'";

		$friendupdaterslt = $conn->query($friendupdate);					
	}
	if (isset($_POST['reject_data_from_id'])) {
		$accept_status = 'Reject';
		$acceptdatafriend = 'NO';

		$friendupdate = "UPDATE requests SET request_status='".$accept_status."' , friend='".$acceptdatafriend."' WHERE request_from_id= '".$_POST['reject_data_from_id']."' AND request_to_id ='".$_SESSION['lgid']."' AND request_status='Pending'";

		$friendupdaterslt = $conn->query($friendupdate);					
	}


?>