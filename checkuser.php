<?php

	function check_user($username) {
	
		$db = mysqli_connect("localhost", "check", "check");

		$db->select_db('blog');

		$query = "SELECT * FROM login WHERE user = '$username'";

		$result = $db->query($query);

		$results = $result->num_rows;
		
		$result->free();
		
		$db->close();
		
		return $results;

	}

?>