<?php
	
	session_start();
	
	$user = $_SESSION['user'];
	
	$category = $_POST['category'];
	
	if ($_FILES["file"]["error"] > 0) {
	
	  header('Location: upload.php?succeed=0&reason=er');
	  
	} else {
	  
		if (file_exists("./User Directories/$user/$category/". $_FILES["file"]["name"])) {
		
		  header('Location: upload.php?succeed=0&reason=ex');
		  
		} else {
		
			@ $db = new mysqli('localhost','system','system','file_storage');
		  
			if (mysqli_connect_errno()) {
		  
				echo 'Error: Could not connect to the database.';
				
				exit;
		  
			}
		
		  move_uploaded_file($_FILES["file"]["tmp_name"], "./User Directories/$user/$category/". $_FILES["file"]["name"]);
		  
		$guid = com_create_guid();
	
		$fileName = addslashes($_FILES["file"]["name"]);

		$fileSize = addslashes($_FILES["file"]["size"]);
		
		$fileType = addslashes($_FILES["file"]["type"]);
		
		$location = addslashes("./User Directories/$user/$category/". $_FILES["file"]["name"]);
		
		$today = date("F j, Y, g:i a");

		$sql = "INSERT INTO uploads (ID, Name, Size, Type, Location, Date) VALUES('$guid','$fileName','$fileSize','$fileType', '$location', '$today')";
		  
		$result = $db->query($sql);
		
		$db->close();
		
		//Get userid from login
		
		mysql_connect("localhost", "system", "system") or die(mysql_error());
		
		mysql_select_db("file_storage") or die(mysql_error()); 
		
		$data = mysql_query("SELECT ID FROM login WHERE user = '$user'") or die(mysql_error()); 

		$row = mysql_fetch_row($data);

		$userID = $row[0];

		@ $db = new mysqli('localhost','system','system','file_storage');
		
		$sql = "INSERT INTO user_files (userID, fileID) VALUES('$userID','$guid')";
		  
		$results = $db->query($sql);
		
		$db->close();
		
			if ($result) {
		
				header('Location: upload.php?succeed=1');
			
			} else {
			
				header('Location: upload.php?succeed=0&reason=ni');
			
			}
		  
		}
	  
	}

?> 