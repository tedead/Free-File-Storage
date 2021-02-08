<?php

	function create_user($firstname, $lastname, $email, $displayName, $userName, $password) {
	
		$db = mysqli_connect("localhost", "create", "create");

		$db->select_db('blog');
		
		$query = "INSERT INTO login(firstName, lastName, email, displayName, userName, password, created) VALUES ('$firstname','$lastname','$email', '$displayName','$username','$password', getdate())";

		$result = $db->query($query);
		
		$db->close();
		
		return $result;

	}

?>
