<?php

	require("./createConnection.php");

	//Drop All Tables
	if($conn->query("Drop Table UserLesson;") === TRUE){
		echo "UserLesson dropped successfully <br/>";
	} else {
		echo "Error dropping UserLesson: " . $conn->error . "<br/>";
	}

	if($conn->query("Drop Table LessonQuestion;") === TRUE){
		echo "LessonQuestion dropped successfully <br/>";
	} else {
		echo "Error dropping LessonQuestion: " . $conn->error . "<br/>";
	}

	if($conn->query("Drop Table CourseLesson;") === TRUE){
		echo "CourseLesson dropped successfully <br/>";
	} else {
		echo "Error dropping CourseLesson: " . $conn->error . "<br/>";
	}

	if($conn->query("Drop Table User;") === TRUE){
		echo "User dropped successfully <br/>";
	} else {
		echo "Error dropping User: " . $conn->error . "<br/>";
	}

	if($conn->query("Drop Table Lesson;") === TRUE){
		echo "Lesson dropped successfully <br/>";
	} else {
		echo "Error dropping Lesson: " . $conn->error . "<br/>";
	}

	if($conn->query("Drop Table Question;") === TRUE){
		echo "Question dropped successfully <br/>";
	} else {
		echo "Error dropping Question: " . $conn->error . "<br/>";
	}

	if($conn->query("Drop Table Course;") === TRUE){
		echo "Course dropped successfully <br/>";
	} else {
		echo "Error dropping Course: " . $conn->error . "<br/>";
	}

	if($conn->query("Drop Table Category;") === TRUE){
		echo "Category dropped successfully <br/>";
	} else {
		echo "Error dropping Category: " . $conn->error . "<br/>";
	}

	//Create Category Table
	$createCategoryTableQuery = "CREATE TABLE IF NOT EXISTS Category (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL)";


	if( $conn->query($createCategoryTableQuery) === TRUE){
		echo "Table Category created successfully<br/>";
	} else {
		echo "Error creating table Category: " . $conn->error . "<br/>";
	}

	//Create Course Table
	$createCourseTableQuery = "CREATE TABLE IF NOT EXISTS Course (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	description TEXT NOT NULL,
	difficulty VARCHAR(30) NOT NULL,
	popularity INT(3) NOT NULL,
	author VARCHAR(255) NOT NULL,
	creationDate DATETIME NOT NULL,
	CategoryId INT(6) NOT NULL REFERENCES Category(id),
	image TINYTEXT NOT NULL)";


	if( $conn->query($createCourseTableQuery) === TRUE){
		echo "Table Course created successfully<br/>";
	} else {
		echo "Error creating table Course: " . $conn->error . "<br/>";
	}

	//Create User Table
	$createUserTableQuery = "CREATE TABLE IF NOT EXISTS User (
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL PRIMARY KEY,
	phone INT(9),
	password CHAR(32) NOT NULL)";

	if( $conn->query($createUserTableQuery) === TRUE){
		echo "Table User created successfully<br/>";
	} else {
		echo "Error creating table User: " . $conn->error. "<br/>";
	}

	//Create Question Table
	$createQuestionTableQuery = "CREATE TABLE IF NOT EXISTS Question (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	question VARCHAR(60) NOT NULL,
	correctAnswer VARCHAR(60) NOT NULL,
	wrongAnswer1 VARCHAR(60) NOT NULL,
	wrongAnswer2 VARCHAR(60) NOT NULL,
	wrongAnswer3 VARCHAR(60) NOT NULL)";

	if( $conn->query($createQuestionTableQuery) === TRUE){
		echo "Table Question created successfully<br/>";
	} else {
		echo "Error creating table Question: " . $conn->error. "<br/>";
	}

	//Create Lesson Table
	$createLessonTableQuery = "CREATE TABLE IF NOT EXISTS Lesson (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(200) NOT NULL,
	guide TEXT NOT NULL,
	video TINYTEXT NOT NULL)";

	if( $conn->query($createLessonTableQuery) === TRUE){
		echo "Table Lesson created successfully<br/>";
	} else {
		echo "Error creating table Lesson: " . $conn->error . "<br/>";
	}

	//Create Relation Lesson with Multiple Question
	$createLessonQuestionTableQuery = "CREATE TABLE IF NOT EXISTS LessonQuestion (
	idLesson INT(6) UNSIGNED,
	idQuestion INT(6) UNSIGNED,
	PRIMARY KEY (idLesson,idQuestion),
	FOREIGN KEY (idLesson) REFERENCES Lesson(id),
	FOREIGN KEY (idQuestion) REFERENCES Question(id))";

	if( $conn->query($createLessonQuestionTableQuery) === TRUE){
		echo "Table LessonQuestion created successfully<br/>";
	} else {
		echo "Error creating table LessonQuestion: " . $conn->error . "<br/>";
	}

	//Create Relation Course with Multiple Lesson
	$createCourseLessonTableQuery = "CREATE TABLE IF NOT EXISTS CourseLesson (
	idCourse INT(6) UNSIGNED,
	idLesson INT(6) UNSIGNED,
	PRIMARY KEY (idCourse,idLesson),
	FOREIGN KEY (idCourse) REFERENCES Course(id),
	FOREIGN KEY (idLesson) REFERENCES Lesson(id))";

	if( $conn->query($createCourseLessonTableQuery) === TRUE){
		echo "Table CourseLesson created successfully<br/>";
	} else {
		echo "Error creating table CourseLesson: " . $conn->error . "<br/>";
	}	

	//Create Relation User with Multiple Lesson
	$createUserLessonTableQuery = "CREATE TABLE IF NOT EXISTS UserLesson (
	emailUser VARCHAR(50),
	idLesson INT(6) UNSIGNED,
	lessonCompleted BOOLEAN NOT NULL Default 0,
	PRIMARY KEY (emailUser,idLesson),
	FOREIGN KEY (emailUser) REFERENCES User(email),
	FOREIGN KEY (idLesson) REFERENCES Lesson(id))";

	if( $conn->query($createUserLessonTableQuery) === TRUE){
		echo "Table UserLesson created successfully<br/>";
	} else {
		echo "Error creating table UserLesson: " . $conn->error . "<br/>";
	}

	require("./closeConnection.php");

?>