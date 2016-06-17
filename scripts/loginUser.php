<?php

	require("./createConnection.php");

	require("./functions.php");

	global $conn;

	$email=$_POST['email'];

	$password=$_POST['password'];

	if( validateUserCredential($email, $password) == 1){

		echo "VALID_USER";

	}else{

		echo "INVALID_USER";

	}

	require("./closeConnection.php");
?>