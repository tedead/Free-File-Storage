<?php

	session_start();
	
	session_regenerate_id();
	
	session_destroy();
	
	echo "<html><head><link href='site.css' rel='stylesheet' type='text/css'></head>";
	
	echo "<body id='logout'><div id='logout_div'>";
	
	echo "<p>You are now logged out</p>";
	
	echo "<p><a href='index.php'>Return to login page</a></p>";
	
	echo "</div></body></html>";

?>