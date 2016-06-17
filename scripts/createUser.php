<?php

	require("./createConnection.php");

	require("./functions.php");

	global $conn;

	$firstName=$_POST['inputFirstName'];

	$lastName=$_POST['inputLastName'];

	$tel=$_POST['inputTel'];

	$email=$_POST['inputEmail'];

	$password=$_POST['inputPassword'];

	$passwordConfirm=$_POST['inputPasswordConfirm'];

	//Validate email
	if(existUser($email) == '1'){

		echo "EMAIL_ALREADY_REGISTERED";
		return;

	}elseif(createUser($firstName, $lastName, $email, $tel, $password) == "VALID_INSERTION"){

		echo "VALID_INSERTION";
		return;

	}else{

		echo "INVALID_INSERTION";
		return;
	}


	require("./closeConnection.php");
?>