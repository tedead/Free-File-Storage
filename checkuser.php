<?php

	function check_user($username) {
	
		$db = mysqli_connect("localhost", "user_check", "userPass");

		$db->select_db('file_storage');

		$query = "SELECT 1 FROM users WHERE UserName = '$username'";

		$result = $db->query($query);

		$results = $result->num_rows;
		
		$result->free();
		
		$db->close();
		
		return $results;

	}

?>