<?php
	class requests{
		private function get_user_profile_data($get_user_id){
			global $dbObject;

			$get_user_id = "SELECT id, img, fname, lname FROM lgndetail WHERE id = '$get_user_id'";

			$get_user_id_rslt = $dbObject->query($get_user_id);

			return $get_user_id_rslt->fetch_assoc();
		}

		public function requests_from(){
			global $dbObject;

			$dayta = ""; 

			$requestsquery = "SELECT * FROM requests WHERE request_to_id = '".$_SESSION['lgid']."' AND request_status = 'Pending'";

			$requestsqueryrslt = $dbObject->query($requestsquery);

			if ($requestsqueryrslt->num_rows > 0) {
				foreach ($requestsqueryrslt as $requestsrow) {
					$user_row = $this->get_user_profile_data($requestsrow['request_from_id']);
					$dayta .= '<div class="requests">
								<a href="profile_user.php?query='.urlencode($user_row['id']).'">
									<img src="'.$user_row['img'].'">
								</a>
								<div class="suggestion_user_wrapper">
								<h4 class="user-name">'.$user_row['fname'].' '.$user_row['lname'].'</h4>
								<div class="action_btn_wrapper" id="action_buttons">
									<button href="javascript:void(0)" class="accept_friend_btn" data-userfromid="'.$user_row['id'].'" id="accept_id_'.$user_row['id'].'">Accept</button>
									<button href="javascript:void(0)" class="reject_request_btn" data-userfromid="'.$user_row['id'].'" id="reject_id_'.$user_row['id'].'">Reject</button>
								</div>
								</div>
							</div>';

				}
			}else{
				$dayta = '<div class="requests">No Requests</div>';	
			}

			echo $dayta ;
		}
	}
	
	$requests = new requests();
	$requests->requests_from();


?>
