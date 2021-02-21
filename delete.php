<?php
	session_start();
	include "./functions/globals.php";
	require constant("BASE_PATH").dirname($_SERVER['PHP_SELF'])."/functions/getbaseurl.php";
	//$fullPath = constant("BASE_PATH").dirname($_SERVER['PHP_SELF']);
	$identifier = $_POST['identity'];
	$userID = substr($identifier, 0, 38);
	$fileID = substr($identifier, 38, 76);
	$fileToRemoveFromStorage = "";
	$fileCount = 0;
	$deleted = "0";
	
	$con = mysqli_connect("localhost", "user_delete", "userPass") or die(mysqli_error());
				
	mysqli_select_db($con, "file_storage") or die(mysqli_error());
				
	$sql = mysqli_query($con, "CALL ffs_delFile('$userID', '$fileID', @filename, @filecount)") or die(mysqli_error($con)); 

	while($row = mysqli_fetch_array($sql)) {
		$fileToRemoveFromStorage = $row['FileName'];
		$fileCount = $row['FileCount'];
	}
	
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