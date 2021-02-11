<?php
	function create_user($firstname, $lastname, $email, $displayname, $username, $password) {	
		$db = mysqli_connect("localhost", "user_insert", "userPass");

		$db->select_db('file_storage');
		
		$query = "INSERT INTO login(FirstName, LastName, Email, DisplayName, UserName, Password, Created) VALUES ('$firstname','$lastname','$email', '$displayname','$username','$password', CURDATE())";

		$result = $db->query($query);
		
		$db->close();
		
		return $result;
	}
?>
