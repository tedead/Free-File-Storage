<?php

	require ('checkuser.php');
	
	require ('createuser.php');
	
	$firstname = htmlspecialchars(strip_tags($_POST['reg_firstname']));
	
	$lastname = htmlspecialchars(strip_tags($_POST['reg_lastname']));
	
	$email = htmlspecialchars(strip_tags($_POST['reg_email']));
	
	$username = htmlspecialchars(strip_tags($_POST['reg_usn']));
	
	$password = htmlspecialchars(strip_tags($_POST['reg_pwd']));
	
	$password_confirm = htmlspecialchars(strip_tags($_POST['reg_pwd_confirm']));
	
	//Check for blank values
	
	if (!$email || !$username || !$password || !$password_confirm) {
	
		header('Location: register.php?code=empty');
		
		exit;
	
	}
	
	//Check for matching password fields
	
	if ($password != $password_confirm) {
	
		header('Location: register.php?code=pwd_mismatch');
		
		exit;
	
	}
	
	//Check for valid email

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	
		header('Location: register.php?code=einvalid');
		
		exit;
		
	}
	
	//Check for valid length of password
	
	if (strlen($password) < 9) {
	
		header('Location: register.php?code=pwdshort');
		
		exit;
	
	}
	
	//Check for existing username
	
	$results = check_user($username);
	
	if ($results == "1") {
	
		header('Location: register.php?code=usrexists');
		
		exit;
	
	}
	
	$success = create_user($firstname, $lastname, $email, $username, $username, $password);
	
	if ($success) {
	
		if (!file_exists("./User Directories/$username")) {
		
			mkdir("./User Directories/$username");
			
			mkdir("./User Directories/$username/Application");
		
			mkdir("./User Directories/$username/Compressed");
			
			mkdir("./User Directories/$username/Misc");
			
			mkdir("./User Directories/$username/Utility");
		
		}
		
		echo "<html><head><link href='site.css' rel='stylesheet' type='text/css'></head><body id='create_body'><div id='create_div'>";
		
		echo "User successfully created!<br />";
		
		echo "<br />";
		
		echo "Please click here to login: <a href='index.php'><ul>Login here</ul></a>";
		
		echo "</body></div></html>";
	
	}


?>