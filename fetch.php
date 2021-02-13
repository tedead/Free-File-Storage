<?php
	session_start();
	include "./functions/globals.php";
	require constant("BASE_PATH").dirname($_SERVER['PHP_SELF'])."/functions/getbaseurl.php";
	//$fullPath = constant("BASE_PATH").dirname($_SERVER['PHP_SELF']);
	$identifier = $_POST['identity'];
	$userID = substr($identifier, 0, 38);
	$fileID = substr($identifier, 38, 76);
	
	$con = mysqli_connect("localhost", "user_select", "userPass") or die(mysqli_error());
				
	mysqli_select_db($con, "file_storage") or die(mysqli_error());
				
	$sql = mysqli_query($con, "SELECT SUBSTR(up.Location, 2) AS File FROM users u INNER JOIN user_files uf ON u.ID = uf.UserID INNER JOIN uploads up ON uf.FileID = up.ID WHERE u.ID = '$userID' AND uf.FileID = '$fileID'") or die(mysqli_error($con));  

	$row = mysqli_fetch_array($sql);
	
	if(count($row) > 0)
	{
		$file = $row['File'];
		
		$url = getBaseURL().dirname($_SERVER['PHP_SELF']).$file;

		$file_name = basename($file); 
		
		$_SESSION['downloadLink'] = $url;
		
		$_SESSION['sentFromFetch'] = "true";

		header('Location: upload.php?download=1');
	}
	else
	{
		$_SESSION['downloadLink'] = "";
		
		$_SESSION['sentFromFetch'] = "true";

		header('Location: upload.php?download=0');
	}
?>