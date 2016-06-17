<?php

	require("./createConnection.php");

	require("./functions.php");

	global $conn;

	$questionId=$_POST['questionId'];

	$answer=$_POST['answer'];

	$userEmail = $_POST['userEmail'];

	$lessonId = $_POST['lessonId'];

	//Test Answer
	$isCorrect = isQuestionAnswerCorrect($questionId, $answer);

	if($isCorrect==1){
		echo "CORRECT_ANSWER";

		//set lesson as done
		completeLessonbyUser($userEmail, $lessonId);

	}else{
		echo "WRONG_ANSWER";
	}

	require("./closeConnection.php");
?>