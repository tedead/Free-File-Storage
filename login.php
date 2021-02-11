<?php
	require ('auth.php');
	
	require ('increment_user.php');
	
	$user = $_POST['myusername'];
	
	$pwd = $_POST['mypassword'];
	
	$username = htmlspecialchars($user);
	
	$password = htmlspecialchars($pwd);
	
	$results = authenticate_user($username, $password);
	
	if ($results == 1) {
	
		session_start();
		
		$_SESSION['login'] = "1";
		
		$_SESSION['user'] = $username;
		
		header('Location: upload.php');
	
	} else {
	
		session_start();
		
		$_SESSION['login'] = '';

		header('Location: index.php?fail=nouser');
	
	}
?>