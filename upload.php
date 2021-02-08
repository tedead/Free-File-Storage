<?php

	session_start();
	
	$notlogged_location = "index.php";

	if(!isset($_SESSION['login'])){

		header("Location: index.php?fail=nologin");

	}
	
	$user = $_SESSION['user'];

	@ $upload_status = $_GET['succeed'];
	
	@ $reason = $_GET['reason'];
	
	if ($upload_status == "1") {
	
		echo "<h3><center>File was successfully uploaded.</center></h3>";
	
	} else if ($upload_status == "0") {
	
		echo "<h3><center>Upload could not be completed.</center></h3>";
		
		if ($reason == "ex") {
		
			echo "<h4><center>The file already exists.</center></h4>";
		
		} else if ($reason == "er") {
		
			echo "<h4><center>An unknown error occurred.</center></h4>";
		
		} else if ($reason == "ni") {
		
			echo "<h4><center>File record not inserted into the database. Upload rejected.</center></h4>";
		
		}
	
	}

?>

<html>

	<link href="site.css" rel="stylesheet" type="text/css">
	
	<body id="upload_body">

		<form id="upload_form" action="submit.php" method="post" enctype="multipart/form-data">
		
		<label for="file">Filename:</label>
		
		<input type="file" size="40" name="file" id="file" />
		
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

				mysql_connect("localhost", "system", "system") or die(mysql_error());
				
				mysql_select_db("file_storage") or die(mysql_error());
				
				$result = mysql_query("SELECT uploads.Name, uploads.Size, uploads.Type, uploads.Location, uploads.Date FROM login, uploads, user_files WHERE login.ID = user_files.userID AND user_files.fileID = uploads.ID AND login.user = '$user'") or die(mysql_error());  

				echo "<table id='display_table' border='1'>";
				
				echo "<tr> <th>Name</th> <th>Size</th> <th>Type</th> <th>Location</th>  <th>Date Uploaded</th> <th>Download</th> </tr>";
				
				while($row = mysql_fetch_array( $result )) {
				
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
					
					$download_link = "http://localhost/Free%20File%20Storage/User%20Directories/joe123/Application/.classpath";
					
					echo "<button type='button' onclick='$download_link'>Download</button>";

					echo "</td></tr>";
					
				} 

				echo "</table>";
				
			?>
		
		
		</div>

	</body>
	
</html> 
