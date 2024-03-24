<?php
	class suggestions{
		private function user_friend_status($request_from_id, $request_to_id){
			global $dbObject;

			$btnstatus = "";
			$querybtn = "SELECT request_status FROM requests WHERE (request_from_id = ".$request_from_id." AND request_to_id = 	".$request_to_id.") OR (request_from_id = ".$request_to_id." AND request_to_id = ".$request_from_id.") limit 1"; 

			$btnqueryrslt = $dbObject->query($querybtn);
			$value = $btnqueryrslt->fetch_assoc();
			if(is_array($value)){
				return $value['request_status'];
			}else{
				return false;
			}

		}

		public function suggestions_to(){
			global $dbObject;

			$data = $databtn = "";

			$suggestionquery = "SELECT id, img, fname, lname FROM lgndetail WHERE lname like '%".$_SESSION['lglname']."%' ";

			$suggestionqueryrslt = $dbObject->query($suggestionquery);
			if ($suggestionqueryrslt->num_rows > 0) {
				foreach ($suggestionqueryrslt as $row) {
					$btntype = $this->user_friend_status($_SESSION['lgid'], $row['id']);
					$btntypelen = strlen($btntype);
						if ($btntypelen > 0) {
							$data .= "";
						}else{
							if ($row['id'] == $_SESSION['lgid']) {
								$data .= "";
							}else{
							$data .= '<div class="suggestions">
									<a href="profile_user.php?query='.urlencode($row['id']).'">
										<img src="'.$row['img'].'">
									</a>
									<div class="suggestion_user_wrapper">
										<h4 class="user-name">'.$row['fname'].' '.$row['lname'].'</h4>
										<a href="javascript:void(0)" class="friend-btn request_id_'.$row['id'].'"  data-usertoid="'.$row['id'].'" >Add Friend</a>
									</div>
								</div>';
							}
						}
				}
			}

			if ($data == "") {
				$data .= '<div class="suggestions">No Suggestions</div>';
			}
			echo $data;
		}
	}

	$suggestions = new suggestions();
	$suggestions->suggestions_to();
	

?>
