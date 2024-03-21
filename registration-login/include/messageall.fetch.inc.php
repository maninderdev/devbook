<?php
	session_start();
include "../db.php";

class fetchall{

	private function get_user_profile_data($get_user_id){
		global $dbObject;

		$get_user_id = "SELECT * FROM lgndetail WHERE id = '$get_user_id'";

		$get_user_id_rslt = $dbObject->query($get_user_id);

		return $get_user_id_rslt->fetch_assoc();
	}

	public function fetch(){
		global $dbObject;

		$fetch_message_from = $_SESSION['lgid'];
		$fetch_message_to = $_POST['message_to'];

		$queryfetch = "SELECT chat_user_from_id, chat_message, file, reg_date FROM chat WHERE (chat_user_from_id = '$fetch_message_from' AND chat_user_to_id = '$fetch_message_to') OR (chat_user_from_id = '$fetch_message_to' AND chat_user_to_id = '$fetch_message_from') ORDER BY reg_date ASC ";

		$queryfetchcheck = $dbObject->query($queryfetch);

		$querylastid = "SELECT MAX( chat_msg_id ) From chat WHERE (chat_user_from_id = '$fetch_message_from' AND chat_user_to_id = '$fetch_message_to') OR (chat_user_from_id = '$fetch_message_to' AND chat_user_to_id = '$fetch_message_from')";

		$querylastidcheck = $dbObject->query($querylastid);
		$idrow = $querylastidcheck->fetch_assoc(); 
			//echo $idrow['MAX( chat_msg_id )'];

		if ($queryfetchcheck->num_rows > 0) {
			$results=array();
			foreach ($queryfetchcheck as $fetchrow) {
				if ($fetchrow['chat_user_from_id'] == $fetch_message_from) {
					$fetchrow['type'] = 'self';
					$results[] = $fetchrow;

				}elseif($fetchrow['chat_user_from_id'] == $fetch_message_to){
					$fetchrow['type'] = "from";
					$userdata = $this->get_user_profile_data($fetch_message_to);
					$fetchrow['img'] = $userdata['img'];
					$fetchrow['fname'] = $userdata['fname'];
					$results[] = $fetchrow;

				}
			}

				$last_id = array();
				$last_id['last_id'] = $idrow['MAX( chat_msg_id )'];
					$last_id['type'] = 'none';
					$results[] = $last_id;
				echo json_encode($results);
		}else{
			echo "No Message";
		}
	}
}


if (isset($_POST['fetch'])) {

	$fetch = new fetchall();
	$fetch->fetch();

}

?>