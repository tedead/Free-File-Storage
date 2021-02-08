<?php

	function authenticate_user($username, $password) {
	
		$db = mysqli_connect("localhost", "system", "system");

		$db->select_db('file_storage');

		$query = "SELECT * FROM login WHERE user = '$username' AND password = '$password'";

		$result = $db->query($query);

		$results = $result->num_rows;
		
		$result->free();
		
		$db->close();
		
		return $results;

	}

?>