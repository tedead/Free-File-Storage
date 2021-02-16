<?php
	session_start();
	include "./functions/globals.php";
	require constant("BASE_PATH").dirname($_SERVER['PHP_SELF'])."/functions/getbaseurl.php";
	//$fullPath = constant("BASE_PATH").dirname($_SERVER['PHP_SELF']);
	$identifier = $_POST['identity'];
	$userID = substr($identifier, 0, 38);
	$fileID = substr($identifier, 38, 76);
	
	$con = mysqli_connect("localhost", "user_delete", "userPass") or die(mysqli_error());
				
	mysqli_select_db($con, "file_storage") or die(mysqli_error());
				
	$sql = mysqli_query($con, "") or die(mysqli_error($con));  

	$row = mysqli_fetch_array($sql);
	
	if(count($row) > 0)
	{	
		$_SESSION['sentFromDelete'] = "true";

		header('Location: upload.php?deleted=true');
	}
	else
	{		
		$_SESSION['sentFromDelete'] = "true";

		header('Location: upload.php?deleted=false');
	}
?>