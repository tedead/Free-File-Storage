<?php
	session_start();
	include "./functions/globals.php";
	require_once __DIR__ . "/functions/db.php";
	require constant("BASE_PATH").dirname($_SERVER['PHP_SELF'])."/functions/getbaseurl.php";
	//$fullPath = constant("BASE_PATH").dirname($_SERVER['PHP_SELF']);
	$identifier = $_POST['identity'];
	$userID = substr($identifier, 0, 38);
	$fileID = substr($identifier, 38, 76);
	$fileToRemoveFromStorage = "";
	$fileCount = 0;
	$deleted = "0";
	
	$con = open_sqlsrv_connection("user_delete", "userPass");
	$sql = sqlsrv_query($con, "EXEC ffs_delFile @UserID = ?, @FileID = ?", array($userID, $fileID));

	while($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)) {
		$fileToRemoveFromStorage = $row['FileName'];
		$fileCount = $row['FileCount'];
	}
	sqlsrv_free_stmt($sql);
	sqlsrv_close($con);
	
	if($fileToRemoveFromStorage == "")
	{	
		$_SESSION['sentFromDelete'] = "true";

		header("Location: upload.php?ddeleted=false&fdeleted=$deleted");
	}
	else
	{	
		if(file_exists($fileToRemoveFromStorage))
		{
			$deleted = unlink($fileToRemoveFromStorage);
		}

		$_SESSION['sentFromDelete'] = "true";

		header("Location: upload.php?ddeleted=true&fdeleted=$deleted");
	}
?>
