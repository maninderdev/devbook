<?php
include "db.php";
class friendList{
 	private function get_user_profile_data($get_user_id){
 		global $dbObject;
		$get_user_id = "SELECT * FROM lgndetail WHERE id = '$get_user_id'";

		$get_user_id_rslt = $dbObject->query($get_user_id);

		return $get_user_id_rslt->fetch_assoc();
	}

	public function friend(){
		global $dbObject;
		$friends = "";
		$friend_id = "";
		$friendquery = "SELECT * FROM requests WHERE (request_to_id = '".$_SESSION['lgid']."' OR request_from_id = '".$_SESSION['lgid']."') AND request_status = 'Accept' AND friend = 'Yes'";
		
		$friendqueryrslt = $dbObject->query($friendquery);

		if ($friendqueryrslt->num_rows > 0) {
			foreach ($friendqueryrslt as $frow) {
				if ($frow['request_to_id'] == $_SESSION['lgid']) {
					$friend_id = $frow['request_from_id'];
				}elseif ($frow['request_from_id'] == $_SESSION['lgid']) {
					$friend_id = $frow['request_to_id'];
				}
				$friend_row = $this->get_user_profile_data($friend_id);
				$friends .= '<div class="friends">
								<a href="profile_user.php?query='.urlencode($friend_row['id']).'">
									<img src="'.$friend_row['img'].'">
								</a>
								<h4 class="user-name">'.$friend_row['fname'].' '.$friend_row['lname'].'</h4>
								<a href="profile_user.php?query='.urlencode($friend_row['id']).'" class="friend-btn" >Profile</a>
							</div>';
			}

		}else{
			$friends = '<div class="friends">No Friends</div>';	
		}
		echo $friends ;
	}
}
				
				

?>