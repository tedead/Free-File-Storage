<?php
	require_once __DIR__ . "/functions/db.php";

	function check_user($username) {
	
		$conn = open_sqlsrv_connection("user_check", "userPass");
		if ($conn === false) {
			return 0;
		}

		$query = "SELECT 1 FROM users WHERE UserName = ?";
		$stmt = sqlsrv_query($conn, $query, array($username));
		$results = 0;
		if ($stmt !== false) {
			while (sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) !== null) {
				$results++;
			}
			sqlsrv_free_stmt($stmt);
		}
		sqlsrv_close($conn);
		
		return $results;

	}

?>
