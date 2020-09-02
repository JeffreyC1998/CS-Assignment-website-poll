<?php
	session_start();
	// delete all of the session variables
	$_SESSION = array();
	session_destroy();
	
	// redirect the user back to the login page
	header("Location: MainPage.php");
	exit();
?>