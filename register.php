<?php
	
	@ $code = $_GET['code'];
	
	if ($code == "empty") {
	
		echo "<h3><center>You have left a required field blank. Please try again.</center></h3>";
	
	} else if ($code == "einvalid") {
	
		echo "<h3><center>The email address you entered is invalid. Please try again.</center></h3>";
	
	} else if ($code == "pwdshort") {
	
		echo "<h3><center>The password you entered is too short. Please try again.</center></h3>";
	
	} else if ($code == "conerr") {
	
		echo "<h3><center>Could not connect to the database.</center></h3>";
	
	} else if ($code == "usrexists") {
	
		echo "<h3><center>That username already exists.</center></h3>";
	
	} else if ($code == "pwd_mismatch") {
	
		echo "<h3><center>The password fields do not match.</center></h3>";
	
	}

?>



<html>

	<link href="site.css" rel="stylesheet" type="text/css">
	
	<body id="register_body">

		<form id="register_form" action="check.php" method="post" enctype="multipart/form-data">
		
		<label for="firstname">First Name:</label>
		
		<input type="text" size="30" name="reg_firstname" id="reg_firstname" />
		
		<br />
		
		<br />
		
		<label for="lastname">Last Name:</label>
		
		<input type="text" size="30" name="reg_lastname" id="reg_lastname" />
		
		<br />
		
		<br />
		
		<label for="email">Email:*</label>
		
		<input type="text" size="30" name="reg_email" id="reg_email" />
		
		<br />
		
		<br />
		
		<label for="usn">User Name:*</label>
		
		<input type="text" size="30" name="reg_usn" id="reg_usn" />
		
		<br />
		
		<br />
		
		<label for="pwd">Password:*</label>
		
		<input type="password" size="30" name="reg_pwd" id="reg_pwd" />
		
		<br />
		
		<br />
		
		<label for="pwd_confirm">Confirm Password:*</label>
		
		<input type="password" size="30" name="reg_pwd_confirm" id="reg_pwd_confirm" />
		
		<br />
		
		<br />
		
		<input type="submit" name="submit" value="Submit" />
		
		<input type="reset" name="reset" value="Reset" />
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php'>Cancel Registration</a>
		
		</form>

	</body>
	
</html> 