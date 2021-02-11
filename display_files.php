<?php
	mysql_connect("localhost", "user_select", "userPass") or die(mysql_error());
	
	mysql_select_db("file_storage") or die(mysql_error());
	
	$result = mysql_query("SELECT * FROM 'uploads' WHERE 1 LIMIT 0, 30 ") or die(mysql_error());  

	echo "<table border='1'>";
	
	echo "<tr> <th>Name</th> <th>Size</th> <th>Type</th> <th>Location</th>  <th>Date</th> </tr>";
	
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

		echo "</td></tr>";
		
	} 

	echo "</table>";
?>