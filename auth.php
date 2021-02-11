<?php

	function authenticate_user($username, $password) {
	
		$results = "";
		//$db = mysqli_connect("localhost", "system", "system");
		
		$mysqli = new mysqli("localhost", "user_check", "userPass", "file_storage");

		if ($mysqli -> connect_errno)
		{
			exit();
		}
		
		// Perform query
		if ($result = $mysqli -> query("SELECT 1 FROM login WHERE UserName = '$username' AND Password = '$password'")) 
		{
		  $results = $result -> num_rows;
		  // Free result set
		  $result -> free_result();
		}

		$mysqli -> close();
		//$db->select_db('file_storage');

		//$query = "SELECT * FROM login WHERE user = '$username' AND password = '$password'";

		//$result = $db->query($query);

		//$results = $result->num_rows;
		
		//$result->free();
		
		//$db->close();
		
		return $results;

	}

?>