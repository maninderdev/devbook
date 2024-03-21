<?php

session_start();
include "../db.php";

class getmessage{

	private function get_user_profile_data($get_user_id){
		global $dbObject;

		$get_user_id = "SELECT * FROM lgndetail WHERE id = '$get_user_id'";

		$get_user_id_rslt = $dbObject->query($get_user_id);

		return $get_user_id_rslt->fetch_assoc();
	}

	public function update(){
		global $dbObject;

		$update_message_from = $_SESSION['lgid'];
		$update_message_to = $_POST['message_to'];
		$last_fetch_id = $_POST['last_id_fetch'];

		$queryupdate = "SELECT chat_msg_id, chat_user_from_id, chat_message, file, reg_date FROM chat WHERE chat_msg_id > '".$last_fetch_id."' AND  (chat_user_from_id = '$update_message_to' AND chat_user_to_id = '$update_message_from')";

		$queryupdatecheck = $dbObject->query($queryupdate);

		if ($queryupdatecheck->num_rows > 0) {
			$updateresult = array();
			foreach ($queryupdatecheck as $updaterow) {
				if ($updaterow['chat_user_from_id'] == $update_message_from) {
					$updaterow['type'] = "self";
					$updateresult[] = $updaterow;
				}elseif($updaterow['chat_user_from_id'] == $update_message_to){
					$updaterow['type'] = "from";
					$userdata = $this->get_user_profile_data($update_message_to);
					$updaterow['img'] = $userdata['img'];
					$updaterow['fname'] = $userdata['fname'];
					$updateresult[] = $updaterow;
				}
				echo json_encode($updateresult);
			}
		}
	}
}

if (isset($_POST['update'])) {

	$getmessage = new getmessage();
	$getmessage->update();
}

?>