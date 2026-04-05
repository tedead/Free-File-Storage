<?php
	require_once __DIR__ . "/functions/db.php";

	function authenticate_user($username, $password) {
	
		$results = "";
		$conn = open_sqlsrv_connection("user_check", "userPass");

		if ($conn === false) {
			exit();
		}

		$query = "SELECT 1 FROM users WHERE UserName = ? AND Password = ?";
		$params = array($username, $password);
		$stmt = sqlsrv_query($conn, $query, $params);
		if ($stmt !== false) {
			$results = 0;
			while (sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) !== null) {
				$results++;
			}
			sqlsrv_free_stmt($stmt);
		}
		sqlsrv_close($conn);

		return $results;
	}

?>
