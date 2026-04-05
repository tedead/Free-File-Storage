<?php
	require_once __DIR__ . "/functions/db.php";
	
	session_start();
	
	$user = $_SESSION['user'];
	
	$category = $_POST['category'];
	
	if ($_FILES["file"]["error"] > 0)
	{
	  header('Location: upload.php?succeed=0&reason=er');  
	} 
	else
	{
		if (file_exists("./User Directories/$user/$category/". $_FILES["file"]["name"])) {
		
		  header('Location: upload.php?succeed=0&reason=ex');
		  
		} else {
		
			$conn = open_sqlsrv_connection("user_insert", "userPass");
			if ($conn === false) {
				echo 'Error: Could not connect to the database.';
				exit;
			}
		
			move_uploaded_file($_FILES["file"]["tmp_name"], "./User Directories/$user/$category/". $_FILES["file"]["name"]);
		  
			$guid = com_create_guid();
		
			$fileName = addslashes($_FILES["file"]["name"]);

			$fileSize = addslashes($_FILES["file"]["size"]);
			
			$fileType = addslashes($_FILES["file"]["type"]);
			
			if (!file_exists("./User Directories/$user/$category")) 
			{
				mkdir("./User Directories/$user/$category");
			}
			
			$location = addslashes("./User Directories/$user/$category/". $_FILES["file"]["name"]);
			
			$today = date("F j, Y, g:i a");

			$sql = "INSERT INTO files(FileID, Name, Size, Type, Location, DateCreated) VALUES(?, ?, ?, ?, ?, GETDATE())";
			$result = sqlsrv_query($conn, $sql, array($guid, $fileName, $fileSize, $fileType, $location));
			
			sqlsrv_close($conn);
			
			//Get userid from login
			
			$con = open_sqlsrv_connection("user_select", "userPass");
			$data = sqlsrv_query($con, "SELECT UserID FROM users WHERE UserName = ?", array($user));
			$row = sqlsrv_fetch_array($data, SQLSRV_FETCH_NUMERIC);
			$userID = $row[0];
			sqlsrv_free_stmt($data);
			sqlsrv_close($con);

			$conn = open_sqlsrv_connection("user_insert", "userPass");
			
			$sql = "INSERT INTO user_files (FileID, UserID, DateCreated) VALUES(?, ?, GETDATE())";
			$results = sqlsrv_query($conn, $sql, array($guid, $userID));
			
			sqlsrv_close($conn);
		
			if($results !== false)
			{			
				header('Location: upload.php?succeed=1');				
			} 
			else 
			{		
				header('Location: upload.php?succeed=0&reason=ni');			
			}		  
		}	  
	}
?> 
