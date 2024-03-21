<?php

session_start();
include "../db.php";

class messagesubmit{

	private function get_user_profile_data($get_user_id){
		global $dbObject;

		$get_user_id = "SELECT * FROM lgndetail WHERE id = '$get_user_id'";

		$get_user_id_rslt = $dbObject->query($get_user_id);

		return $get_user_id_rslt->fetch_assoc();
	}

	public function submit(){
		global $dbObject;

		$message_from = $_SESSION['lgid'];
		$message_to = $_POST['message_to_user'];
		$msg = $_POST['message'];
		$file = $_POST['filename'];

		$query = "INSERT INTO chat (chat_user_from_id, chat_user_to_id, chat_message, file)
				VALUES ('$message_from', '$message_to', '$msg', '$file')";

		$querycheck = $dbObject->query($query);


		$submitquerylastid = "SELECT MAX( chat_msg_id ) FROM chat WHERE (chat_user_from_id = '$message_from' AND chat_user_to_id = '$message_to') OR (chat_user_from_id = '$message_to' AND chat_user_to_id = '$message_from')";

		$submitquerylastidcheck = $dbObject->query($submitquerylastid);
		$submitidrow = $submitquerylastidcheck->fetch_assoc();

		$queryget = "SELECT chat_user_from_id, chat_message, file, reg_date FROM chat WHERE chat_msg_id = '".$submitidrow['MAX( chat_msg_id )']."' ";

		$querygetcheck = $dbObject->query($queryget);


		if ($querygetcheck->num_rows > 0) {
			$submitresult = array();
			foreach ($querygetcheck as $row) {
				if ($row['chat_user_from_id'] == $message_from) {
					$row['type'] = "self";
					$submitresult[] = $row;
				}elseif($row['chat_user_from_id'] == $message_to){
					$row['type'] = "from";
					$userdata = $this->get_user_profile_data($message_to);
					$row['fname'] = $userdata['fname'];
					$row['img'] = $userdata['img'];
					$submitresult[] = $row;
				}
				echo json_encode($submitresult);
			}
		}
	}
}


if (isset($_POST['message'])) {

	$submit = new messagesubmit();
	$submit->submit();
}

?>