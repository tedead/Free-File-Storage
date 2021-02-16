<?php
	function create_user($firstname, $lastname, $email, $displayname, $username, $password) {	
		$db = mysqli_connect("localhost", "user_insert", "userPass");

		$db->select_db('file_storage');
		
		$guid = com_create_guid();
		
		$query = "INSERT INTO users(UserID, FirstName, LastName, Email, DisplayName, UserName, Password, DateCreated) VALUES ('$guid', '$firstname','$lastname','$email', '$displayname','$username','$password', CURDATE())";

		$result = $db->query($query);
		
		$db->close();
		
		return $result;
	}
?>
