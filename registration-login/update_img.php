<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if(isset($_FILES['uploadimage'])){
		echo "isset";
	}else{
		echo "no";
	}
}
		/*$extensions = array('jpg', 'jpeg', 'png', 'gif');
		$ext_error = false;
		$file_name_array = explode('.', $_FILES['uploadimage']['name']);
		$upload_file_extension = end($file_name_array);
		if(!in_array($upload_file_extension , $extensions)){
			$ext_error = true;
			echo "<h4 class='error'> Sorry, only JPG, JPEG, PNG & GIF files are allowed. </h4>";
		};
		if ($_FILES["uploadimage"]["size"] > 5000000) {
		  echo "<h4 class='error'> Sorry, your file is too large. Maximum Size allowed 5MB </h4>";
		  $ext_error = true;
		}

		if($ext_error == true){
			echo "<h4 class='error'> Sorry, your file was not uploaded. </h4>";
		}else{
			move_uploaded_file($_FILES['uploadimage']['tmp_name'], '../images/' . $_FILES['uploadimage']['name']);
			echo "<h4 class='done'> The file ". htmlspecialchars( basename( $_FILES["uploadimage"]["name"])). " has been uploaded. </h4>";
		};*/
	/*function file_info($fg){
		echo "<script>console.log(".$fg.");</script>" ;
	};

	file_info($upload_file_extension);*/
?>