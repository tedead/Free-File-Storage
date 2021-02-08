<?php

	@ $failure = $_GET['fail'];
	
	if ($failure == "nouser") {
	
		echo "<h3><center>User not found. Please try again.</center></h3>";
	
	} else if ($failure == "noid") {
	
		echo "<h3><center>Please login to upload files.</center></h3>";
	
	} else if ($failure == "nologin") {
	
		echo "<h3><center>You are not logged in.</center></h3>";
	
	}

?>


<html>

	<head>

	<link href="site.css" rel="stylesheet" type="text/css">
	
	</head>

	<body id="index_body">
	
		<table id="index_form" width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
		
		<tr>
		
			<form name="loginForm" method="post" action="login.php">
			
				<td>
				
				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				
				<tr>
				
				<td colspan="3"><strong>Member Login </strong></td>
				
				</tr>
				
				<tr>
				
				<td width="89">Username</td>
				
				<td width="2">:</td>
				
				<td width="250"><input size="25" name="myusername" type="text" id="myusername"></td>
				
				</tr>
				
				<tr>
				
				<td>Password</td>
				
				<td>:</td>
				
				<td><input size="25" name="mypassword" type="password" id="mypassword"></td>
				
				</tr>
				
				<tr>
			
				<td>&nbsp;</td>
				
				<td>&nbsp;</td>
				
				<td><input type="submit" name="Submit" value="Login">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="register.php">Not registered?</a></td>
				
				</tr>
				
				</table>
				
				</td>
				
			</form>
		
		</tr>
		
		</table>
	
	</body>
	
</html>