<?php
	// load the database and verify the username/password
	$db = mysqli_connect("localhost", "username", "password", "database");
	if (!$db) {
		exit ();
	}
	
    $poll_ID = $_GET["pid"];

	$q = "SELECT * FROM Polls ORDER BY poll_lastdate DESC, poll_createdate DESC LIMIT 5";

	if ($result = mysqli_query ($db, $q)) 
	{
		
	  while ($row = mysqli_fetch_assoc($result)) 
	  {
	    $json[] = $row;
	  } 
	  print json_encode($json);
	  mysqli_free_result($result);
	} 
	mysqli_close($db);
	
?>