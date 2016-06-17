<?php

	require("./createConnection.php");

	require("./functions.php");

	global $conn;
	
	if(!isset($_COOKIE['user'])){
        header("Location: index.php");
    }else{

        $userEmail = $_COOKIE['user'];

    	$courseId= $_POST['courseId'];

    	enrollCourse($userEmail, $courseId);

    }

	require("./closeConnection.php");
?>