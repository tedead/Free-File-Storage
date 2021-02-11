<?php 
	function increment_user($username) {
	
		$db = mysqli_connect("localhost", "user_select", "userPass");

		$db->select_db('file_storage');

		$query = "SELECT ID FROM login WHERE user = '$username'";

		$result = $db->query($query);

		$results = $result->num_rows;
		
		$row = $result->fetch_assoc();
		
		$userID = $row['ID'];
		
		$result->free();
		
		$db->close();
		
		return $results;
	}	
?>