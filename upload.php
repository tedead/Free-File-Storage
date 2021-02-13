<?php

	session_start();
	
	$notlogged_location = "index.php";

	if(!isset($_SESSION['user'])){

		header("Location: index.php?fail=nousers");

	}
	
	$user = $_SESSION['user'];

	@ $upload_status = $_GET['succeed'];
	
	@ $reason = $_GET['reason'];
	
	$downloadReady = isset($_GET['download']) ? $_GET['download'] : "0";
	
	$wasSentFromFetch = isset($_SESSION['sentFromFetch']) ? $_SESSION['sentFromFetch'] : "false";
	
	$downloadLink = isset($_SESSION['downloadLink']) ? $_SESSION['downloadLink'] : "";
	
	if($wasSentFromFetch == "true" && $downloadReady = "1")
	{
		echo "<h3><center><a style='text-decoration: none; font-size: 1.5em;' href='$downloadLink'>Download</a></center></h3>";
	}
	else if($wasSentFromFetch && $downloadReady = "0")
	{
		echo "<h3><center>Download could not be fetched from server. Try again.</center></h3>";
	}

	if ($upload_status == "1")
	{
		echo "<h3><center>File was successfully uploaded.</center></h3>";
	}
	else if ($upload_status == "0")
	{
		echo "<h3><center>Upload could not be completed.</center></h3>";
		
		if ($reason == "ex") {
		
			echo "<h3><center>The file already exists.</center></h3>";
		
		} else if ($reason == "er") {
		
			echo "<h3><center>An unknown error occurred.</center></h3>";
		
		} else if ($reason == "ni") {
			
			echo "<h3><center>File record not inserted into the database. Upload rejected.</center></h3>";	
			
		}	
	}
?>

<html>

	<link href="site.css" rel="stylesheet" type="text/css">
	
	<body id="upload_body">

		<form id="upload_form" action="submit.php" method="post" enctype="multipart/form-data">
		
		<label for="file">Filename:</label>
		
		<input type="hidden" name="MAX_FILE_SIZE" value="90000000000" />
		
		<input type="file" size="40000000000" name="file" id="file" />
		
		<br />
		
		<br />
		
		<label for="category">Choose File Category:</label>
		
		<select id="category" name="category" size="1">
		
		  <option value="Application">Application</option>
		  
		  <option value="Utility">Utility</option>
		  
		  <option value="Compressed">Compressed</option>
		  
		  <option value="Misc">Misc</option>
		  
		</select> 
		
		<br /><br />
		
		<input type="submit" name="submit" value="Submit" />
		
		<a href="logout.php">Logout!</a>
		
		</form>
		
		<div id="file_list">
		
			<?php

				$con = mysqli_connect("localhost", "user_select", "userPass") or die(mysqli_error());
				
				mysqli_select_db($con, "file_storage") or die(mysqli_error());
				
				$result = mysqli_query($con, "SELECT CONCAT(user_files.UserID, user_files.FileID) AS Identifier, uploads.Name, uploads.Size, uploads.Type, uploads.Location, uploads.Date FROM users, uploads, user_files WHERE users.ID = user_files.userID AND user_files.fileID = uploads.ID AND users.UserName = '$user'") or die(mysqli_error($con));  

				echo "<table id='display_table' border='1'>";
				echo "<form name='fetchForm' method='post' action='fetch.php'>";
				echo "<tr> <th>Name</th> <th>Size</th> <th>Type</th> <th>Location</th>  <th>Date Uploaded</th> <th>Download</th> </tr>";
				
				while($row = mysqli_fetch_array($result)) {
				
					echo "<tr><td>"; 
					
					echo $row['Name'];
					
					echo "</td><td>"; 
					
					echo $row['Size'];
					
					echo "</td><td>"; 
					
					echo $row['Type'];
					
					echo "</td><td>";
					
					$link = $row['Location'];
					
					echo "<a href='$link'>$link</a>";
					
					echo "</td><td>";
					
					echo $row['Date'];
					
					echo "</td><td>";
					
					$ident = $row['Identifier'];
					
					echo "<button type='submit' name='identity' value='$ident'>Fetch</button>";

					echo "</td></tr>";
					
				} 

				echo "</form></table>";
				
			?>
		
		
		</div>

	</body>
	
</html> 
