<?php
	$con = mysqli_connect("localhost", "user_select", "userPass") or die(mysqli_error());
	
	mysqli_select_db($con, "file_storage") or die(mysqli_error($con));
	
	$result = mysqli_query($con, "SELECT * FROM 'uploads' WHERE 1 LIMIT 0, 30 ") or die(mysqli_error($con));  

	echo "<table border='1'>";
	
	echo "<tr> <th>Name</th> <th>Size</th> <th>Type</th> <th>Location</th>  <th>Date</th> </tr>";
	
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

		echo "</td></tr>";
		
	} 

	echo "</table>";
?>