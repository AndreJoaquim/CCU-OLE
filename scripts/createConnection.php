<?php

	require("databaseVariables.php");

	//Create Connection
	$conn = new mysqli($servername, $username, $password);

	//Check Connection
	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	$conn->select_db($database);

?>