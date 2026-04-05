<?php
	require_once __DIR__ . "/functions/db.php";

	function create_user($firstname, $lastname, $email, $displayname, $username, $password) {	
		$conn = open_sqlsrv_connection("user_insert", "userPass");
		if ($conn === false) {
			return false;
		}
		
		$guid = com_create_guid();
		
		$query = "INSERT INTO users(UserID, FirstName, LastName, Email, DisplayName, UserName, Password, DateCreated) VALUES (?, ?, ?, ?, ?, ?, ?, GETDATE())";

		$params = array($guid, $firstname, $lastname, $email, $displayname, $username, $password);
		$result = sqlsrv_query($conn, $query, $params);
		
		sqlsrv_close($conn);
		
		return $result !== false;
	}
?>
