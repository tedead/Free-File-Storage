<?php
	
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
		
			$db = new mysqli('localhost','user_insert','userPass','file_storage');
		  
			if (mysqli_connect_errno()) {
		  
				echo 'Error: Could not connect to the database.';
				
				exit;
		  
			}
		
			move_uploaded_file($_FILES["file"]["tmp_name"], "./User Directories/$user/$category/". $_FILES["file"]["name"]);
		  
			$guid = com_create_guid();
		
			$fileName = addslashes($_FILES["file"]["name"]);

			$fileSize = addslashes($_FILES["file"]["size"]);
			
			$fileType = addslashes($_FILES["file"]["type"]);
			
			if (!file_exists("./User Directories/$username/$category")) 
			{
				mkdir("./User Directories/$username/$category");
			}
			
			$location = addslashes("./User Directories/$user/$category/". $_FILES["file"]["name"]);
			
			$today = date("F j, Y, g:i a");

			$sql = "INSERT INTO uploads (ID, Name, Size, Type, Location, Date) VALUES('$guid','$fileName','$fileSize','$fileType', '$location', NOW())";
			  
			$result = $db->query($sql);
			
			$db->close();
			
			//Get userid from login
			
			$con = mysqli_connect("localhost", "user_select", "userPass") or die(mysqli_error());
			
			mysqli_select_db($con, "file_storage") or die(mysql_error($con)); 
			
			$data = mysqli_query($con, "SELECT ID FROM users WHERE UserName = '$user'") or die(mysqli_error($con)); 

			$row = mysqli_fetch_row($data);

			$userID = $row[0];

			$db = new mysqli('localhost','user_insert','userPass','file_storage');
			
			$sql = "INSERT INTO user_files (FileID, UserID) VALUES('$guid','$userID')";
			  
			$results = $db->query($sql);
			
			$db->close();
		
			if($results) {			
				header('Location: upload.php?succeed=1');				
			} 
			else 
			{		
				header('Location: upload.php?succeed=0&reason=ni');			
			}		  
		}	  
	}
?> 