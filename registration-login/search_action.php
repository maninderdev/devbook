<?php
	session_start();
	require "database.php";

	if(isset($_POST['search_query'])){
           global $conn;
        function getbtn($connect, $request_from_id, $request_to_id){
			$btnstatus = "";
			$querybtn = "SELECT request_status FROM requests WHERE (request_from_id = ".$request_from_id." AND request_to_id = 	".$request_to_id.") OR (request_from_id = ".$request_to_id." AND request_to_id = ".$request_from_id.") "; 
			$btnqueryrslt = $connect->query($querybtn);

			foreach ($btnqueryrslt as $value) {
				$btnstatus = $value['request_status'];
			}

			return $btnstatus;

		}
         $search_query=$_POST['search_query'] ;
         $query = "SELECT img, fname, lname, id FROM lgndetail WHERE  fname like '%$search_query%' OR lname like '%$search_query%'";
         $avaresult = $conn->query($query);
        
		if ($avaresult->num_rows > 0) {
			$results=array();
			foreach ($avaresult as $searchrow) {
				$btntype = getbtn($conn, $_SESSION['lgid'], $searchrow['id']);
				$searchrow['type'] = $btntype;
				if ($searchrow['id'] !== $_SESSION['lgid']) {
					$results[]=$searchrow;
				}
				/*while($row=$avaresult->fetch_array(MYSQLI_ASSOC)){
	               $results[]=$row;
				}*/
			}
				
		}

		echo json_encode($results);

		/*$querystr = explode("", $_POST['search_query']);

		$condition = '';

		foreach ($querystr as $search) {
			
		}

		$query = "SELECT * FROM lgndetail WHERE  fname ";
		
		*/
	}

?>