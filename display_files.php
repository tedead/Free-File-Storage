<?php
	require_once __DIR__ . "/functions/db.php";
	$con = open_sqlsrv_connection("user_select", "userPass");
	$result = sqlsrv_query($con, "SELECT TOP 30 * FROM files");  

	echo "<table border='1'>";
	
	echo "<tr> <th>Name</th> <th>Size</th> <th>Type</th> <th>Location</th>  <th>Date</th> </tr>";
	
	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		
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
		
		echo $row['DateCreated'];
		
		echo "</td><td>"; 

		echo "</td></tr>";
		
	} 
	sqlsrv_free_stmt($result);
	sqlsrv_close($con);

	echo "</table>";
?>
