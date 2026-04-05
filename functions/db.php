<?php
	function open_sqlsrv_connection($username, $password) {
		$connectionInfo = array(
			"Database" => "file_storage",
			"UID" => $username,
			"PWD" => $password,
			"CharacterSet" => "UTF-8"
		);

		$conn = sqlsrv_connect("localhost", $connectionInfo);

		if ($conn === false) {
			return false;
		}

		return $conn;
	}
?>
