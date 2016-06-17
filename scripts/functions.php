<?php

	//Utility Functions
	function transalateDifficulty($difficultyNum){

		switch ($difficultyNum) {
			case 1:
				return "Fácil";
				break;

			case 2:
				return "Intermédia";
				break;

			case 3:
				return "Difícil";
				break;
			
			default:
				return "Error";
				break;
		}
	}

	function fetch_all($mysqli_result){

		$results_array = array();

		while ($row = $mysqli_result->fetch_assoc()) {
			$results_array[] = $row;
		}

		return $results_array;
	}

	//===============================
	//USER FUNCTIONS
	//===============================

	//Get User Details
	//Parameters: user email
	//Return: associative array (firstname, lastname, email, phone)
	//		  NO_USER_BY_EMAIL when no user with taht email
	function getUserByEmail($userEmail){

		global $conn;

		$query = "SELECT firstname, lastname, email, phone FROM User WHERE email='" . $userEmail . "'";

		$result = $conn->query($query);

		if($result->num_rows != 1){
			return "NO_USER_BY_EMAIL";
		}else{
			return $result->fetch_assoc();
		}
	}

	//Change User Details
	//Parameters: userEmail, firstname, lastname, phone
	function changeUserDetail($userEmail, $firstname, $lastname, $phone){

		global $conn;

		$query = "UPDATE User 
		SET firstname='$firstname', lastname='$lastname', phone='$phone' 
		WHERE email='" . $userEmail . "'";

		$result = $conn->query($query);

		if($result != TRUE){
			echo "Error updating " . $userEmail . " details";
		}

	}

	//Get User Enrolled Courses
	//Parameters: user email
	//Return: Array of associative array( courseId, courseName, courseCategory)
	function getUserEnrolledCourses($userEmail){

		global $conn;

		$query = "SELECT Course.id AS courseId, Course.name AS courseName, Category.name AS courseCategory 
				FROM Course INNER JOIN Category ON Course.CategoryId=Category.id
				WHERE Course.id IN (SELECT CourseLesson.idCourse 
									FROM CourseLesson INNER JOIN UserLesson ON CourseLesson.idLesson=UserLesson.idLesson
									WHERE UserLesson.emailUser='" . $userEmail . "' AND UserLesson.lessonCompleted='0')";

		$result = $conn->query($query);

		return fetch_all($result);

	}
	
	//Get User Completed Courses
	//Parameters: user email
	//Return: Array of associative array( courseId, courseName, courseCategory)
	function getUserCompletedCourses($userEmail){

		global $conn;
		$query = "SELECT Course.id AS courseId, Course.name AS courseName, Category.name AS courseCategory 
				FROM Course INNER JOIN Category ON Course.CategoryId=Category.id
				WHERE Course.id IN (SELECT CourseLesson.idCourse 
									FROM CourseLesson INNER JOIN UserLesson ON CourseLesson.idLesson=UserLesson.idLesson
									WHERE UserLesson.emailUser='" . $userEmail . "' GROUP BY CourseLesson.idCourse HAVING MIN(UserLesson.lessonCompleted) = 1)";

		$result = $conn->query($query);

		return fetch_all($result);

	}

	//Validate User Credential
	//Parameters: userEmail, password(not encrypted)
	//Return: boolean
	function validateUserCredential($userEmail, $password){

		global $conn;

		$md5Password = md5($password);

		$query = "SELECT COUNT(*) AS Valid FROM User WHERE email='" . $userEmail . "' AND password='" . $md5Password . "'";

		$result = $conn->query($query);

		if($result->num_rows != 1){
			echo "Error selecting " . $userEmail . " details";
		}else{
			$assocResult = $result->fetch_assoc();
			return $assocResult['Valid'];
		}

	}

	//Create User
	//Parameters: firstname, lastname, email, phone(not mandatory), password
	function createUser($firstname, $lastname, $email, $phone, $password){

		global $conn;

		$md5Password = md5($password);

		$query = "INSERT INTO User (firstname, lastname, email, phone, password)
		VALUES('" . $firstname . "', '" . $lastname . "', '" . $email . "', '" . $phone . "', '" . $md5Password . "')";

		if($conn->query($query) === TRUE){
			return "VALID_INSERTION";
		} else {
			return "Error inserting User: " . $conn->error . "<br/>";
		}

	}

	//User Already Exist
	//Parameters: email
	function existUser($email){

		global $conn;

		$query = "SELECT COUNT(*) AS Registered FROM User WHERE email='" . $email . "'";

		$result = $conn->query($query);

		if($result->num_rows != 1){
			echo "Error selecting " . $email . " user";
		}else{
			$assocResult = $result->fetch_assoc();
			return $assocResult['Registered'];
		}
	}

	//Get User Lesson
	//Parameters: user email
	//Return: Array of associative array( lesson, courseName, courseCategory)
	function getUserLessonByCourse($userEmail, $courseId){

		global $conn;

		$query = "SELECT Lesson.id AS lessonId, Lesson.name AS lessonName, UserLesson.lessonCompleted AS lessonCompleted
					FROM UserLesson INNER JOIN Lesson ON UserLesson.idLesson=Lesson.id
					WHERE emailUser='" . $userEmail . "' AND idLesson IN (SELECT idLesson FROM CourseLesson WHERE idCourse ='" . $courseId . "')";

		$result = $conn->query($query);

		return fetch_all($result);

	}
	//===============================
	//COURSE FUNCTIONS
	//===============================

	//Get Course Details
	//Parameters: courseId
	//Return: associative array (name, description, difficulty, popularity, author, creationDate, image, category)
	//        NO_COURSE_BY_ID in case no course wiht courseID
	function getCourseById($courseId){

		global $conn;

		$query = "SELECT Course.name, Course.description, Course.difficulty, Course.popularity, Course.author, Course.creationDate, Course.image, Category.name AS category 
		FROM Course INNER JOIN Category ON Course.CategoryId=Category.id
		WHERE Course.id='". $courseId . "'";

		$result = $conn->query($query);

		if($result->num_rows != 1){
			return "NO_COURSE_BY_ID";
		}else{
			return $result->fetch_assoc();
		}

	}

	//Get Course Lessons
	//Parameters: courseId
	//Return: associative array (name, guide, video)
	function getCourseLessonsById($courseId){

		global $conn;

		$query = "SELECT Lesson.name, Lesson.guide, Lesson.video
		FROM CourseLesson INNER JOIN Lesson ON CourseLesson.idLesson=Lesson.id
		WHERE CourseLesson.idCourse='". $courseId . "'";

		$result = $conn->query($query);

		if($result->num_rows != 1){
			echo "Error selecting " . $courseId . " details";
		}else{
			return $result->fetch_assoc();
		}

	}

	//Enroll Course
	//Parameters: userEmail, courseId
	function enrollCourse($userEmail, $courseId){

		global $conn;

		$query = "SELECT idLesson FROM CourseLesson WHERE idCourse='" . $courseId . "'";

		$result = $conn->query($query);

		echo "1";

		if($result->num_rows > 0){

			echo "2";

			while( $row = $result->fetch_assoc()) {
			
				print_r($row);
					
				$insertQuery = "INSERT INTO UserLesson (emailUser, idLesson, lessonCompleted) 
				VALUES ('" . $userEmail . "', '" . $row['idLesson'] . "', '0')";

				$conn->query($insertQuery);
			}
		}
	}

	//Get Most Recent Courses (3 courses at max)
	//Return: array of associative array (id, name, author, image)
	function getMostRecentCourses(){

		global $conn;

		$query = "SELECT id, name, author, image FROM Course ORDER BY creationDate LIMIT 3";

		$result = $conn->query($query);

		return fetch_all($result);
	}

	//Get Featured Courses (3 courses at max)
	//Return: array of associative array (id, name, author, image)
	function getFeaturedCourses(){

		global $conn;

		$query = "SELECT id, name, author, image FROM Course ORDER BY popularity LIMIT 3";

		$result = $conn->query($query);

		return fetch_all($result);
	}

	//Search Coures by Query and Category
	//Parameters: searchQuery, categoryId
	//Return: array of associative array (id, name, author, image)
	function searchCoursesByQueryAndCategory($searchQuery, $categoryId){

		global $conn;

		$query = "SELECT id, name, author, image FROM Course WHERE CategoryId='" . $categoryId . "' AND (name LIKE '%" . $searchQuery . "%' OR description LIKE '%" . $searchQuery . "%' OR author LIKE '%" . $searchQuery . "%') ORDER BY creationDate";

		$result = $conn->query($query);

		return fetch_all($result);
	}

	//Search Coures by Query
	//Parameters: searchQuery
	//Return: array of associative array (id, name, author, image)
	function searchCoursesByQuery($searchQuery){

		global $conn;

		$query = "SELECT id, name, author, image FROM Course WHERE name LIKE '%" . $searchQuery . "%' OR description LIKE '%" . $searchQuery . "%' OR author LIKE '%" . $searchQuery . "%' ORDER BY creationDate";

		$result = $conn->query($query);

		return fetch_all($result);
	}

	//Search Coures by Category
	//Parameters: categoryId
	//Return: array of associative array (id, name, author, image)
	function searchCoursesByCategory($categoryId){

		global $conn;

		$query = "SELECT id, name, author, image FROM Course WHERE CategoryId='" . $categoryId . "' ORDER BY popularity";

		$result = $conn->query($query);

		return fetch_all($result);
	}

	//Is User Enrolled in Course
	//Parameters: $userEmail, $courseId
	//Return: boolean
	function isUserEnrolledInCourse($userEmail, $courseId){

		global $conn;

		$query = "SELECT COUNT(*) AS countEnrolled 
		FROM UserLesson INNER JOIN CourseLesson ON UserLesson.idLesson=CourseLesson.idLesson
		WHERE UserLesson.emailUser='" . $userEmail . "' AND CourseLesson.idCourse='" . $courseId . "'";

		$result = $conn->query($query);

		$resultFetched = fetch_all($result);

		if($resultFetched[0]['countEnrolled'] != 0){
			return true;
		}else{
			return false;
		}
	}

	function isCourseCompletedByUser($userEmail, $courseId, $lessonId){

		global $conn;

		$query = "SELECT MIN(UserLesson.lessonCompleted) AS courseCompleted 
		FROM UserLesson INNER JOIN CourseLesson ON UserLesson.idLesson=CourseLesson.idLesson
		WHERE UserLesson.emailUser='" . $userEmail . "' AND CourseLesson.idCourse='" . $courseId . "' AND UserLesson.idLesson != '" . $lessonId . "'";

		$result = $conn->query($query);

		$resultFetched = fetch_all($result);

		if($resultFetched[0]['courseCompleted'] != 0){
			return true;
		}else{
			return false;
		}
	}

	//===============================
	//LESSON FUNCTIONS
	//===============================

	//Get Lesson Details
	//Parameters: lessonId
	//Return: associative array (name, guide, video)
	function getLessonById($lessonId){

		global $conn;

		$query = "SELECT name, guide, video FROM Lesson WHERE id='". $lessonId . "'";

		$result = $conn->query($query);

		if($result->num_rows != 1){
			return "NO_LESSON_BY_ID";
		}else{
			return $result->fetch_assoc();
		}

	}

	

	//Get Lesson's Question
	//Parameters: lessonId
	//Return: array of associative array (questionId, question, correctAnswer, wrongAnswer1, wrongAnswer2, wrongAnswer3)
	function getLessonQuestionById($lessonId){

		global $conn;

		$query = "SELECT Question.id AS questionId, Question.question, Question.correctAnswer, Question.wrongAnswer1, Question.wrongAnswer2, Question.wrongAnswer3
		FROM LessonQuestion INNER JOIN Question ON LessonQuestion.idLesson=Question.id
		WHERE LessonQuestion.idLesson='". $lessonId . "'";

		$result = $conn->query($query);

		return fetch_all($result);

	}
	
	//Submit Evaluation
	//Parameters: associative array (questionId, answer)
	//Return: correct answer percentage
	function submitEvaluation($arrayQuestion){

		global $conn;

		$numberRightAnswer = 0;

		for($i = 0; $i < count($arrayQuestion); $i++){

			$questionId = $arrayQuestion[$i]['questionId'];
			$answer = $arrayQuestion[$i]['answer'];	
			
			if(isQuestionAnswerCorrect($questionId, $answer) == 1){

				$numberRightAnswer++;

			}

		}

		return $numberRightAnswer/(count($arrayQuestion));

	}
	
	//getLessonCourseById
	//Parameters: lessonId
	//Return: associative array (courseName, courseId)
	function getLessonCourseById($lessonId){

		global $conn;

		$query = "SELECT Course.name AS courseName, Course.id AS courseId
		FROM Course INNER JOIN CourseLesson ON CourseLesson.idCourse=Course.id 
		WHERE CourseLesson.idLesson='". $lessonId . "'";

		$result = $conn->query($query);

		if($result->num_rows != 1){
			return "NO_LESSON_BY_ID";
		}else{
			$courseName = $result->fetch_assoc(); 
			return $courseName;
		}

	}

	//Has Next Lesson
	//Parameters: courseId, lessonId
	//Return: array lessonId
	function hasNextLesson($courseId, $lessonId){

		global $conn;

		//Get Lessons

		$query = "SELECT idLesson FROM CourseLesson WHERE idCourse='" . $courseId . "' ORDER BY idLesson";

		$result = $conn->query($query);

		//Check if there is a lessonId higher than current lesson
		$currentLesson = $lessonId;

		foreach ($result as $row) {
			
			if($row['idLesson'] > $currentLesson){
				$currentLesson = $row['idLesson'];
				break;
			}

		}

		if($currentLesson == $lessonId){
			return "NO_NEXT_LESSON";
		}else{
			return $currentLesson;
		}

	}

	//Has Previous Lesson
	//Parameters: courseId, lessonId
	//Return: array lessonId
	function hasPreviousLesson($courseId, $lessonId){

		global $conn;

		//Get Lessons

		$query = "SELECT idLesson FROM CourseLesson WHERE idCourse='" . $courseId . "' ORDER BY idLesson";

		$result = $conn->query($query);

		//Check if there is a lessonId higher than current lesson
		$currentLesson = $lessonId;

		foreach ($result as $row) {
			
			if($row['idLesson'] < $lessonId){
				$currentLesson = $row['idLesson'];
			}elseif($row['idLesson']==$lessonId){
				break;
			}

		}

		if($currentLesson == $lessonId){
			return "NO_PREVIOUS_LESSON";
		}else{
			return $currentLesson;
		}

	}

	//===============================
	//QUESTION FUNCTIONS
	//===============================

	//Get Question Details
	//Parameters: questionId
	//Return: associative array (question, correctAnswer, wrongAnswer1, wrongAnswer2, wrongAnswer3)
	function getQuestionById($questionId){

		global $conn;

		$query = "SELECT question, correctAnswer, wrongAnswer1, wrongAnswer2, wrongAnswer3 FROM Question WHERE id='". $questionId . "'";

		$result = $conn->query($query);

		if($result->num_rows != 1){
			echo "Error selecting " . $questionId . " details";
		}else{
			return $result->fetch_assoc();
		}

	}

	//Question Answer is Right
	//Parameters: questionId, answer
	//Return: boolean
	function isQuestionAnswerCorrect($questionId, $answer){

		global $conn;

		$query = "SELECT COUNT(*) AS Correct FROM Question WHERE id='". $questionId . "' AND correctAnswer='" . $answer . "'";

		$result = $conn->query($query);

		if($result->num_rows != 1){
			echo "Error selecting " . $questionId . " details";
		}else{
			$assocResult = $result->fetch_assoc();
			return $assocResult['Correct'];
		}

	}

	//Complete a lesson 
	//Parameters: userEmail, lessonId
	function completeLessonbyUser($userEmail, $lessonId){

		global $conn;

		$query = "UPDATE UserLesson SET lessonCompleted='1' WHERE emailUser='" . $userEmail . "' AND idLesson='" . $lessonId . "' ";

		$result = $conn->query($query);

	}

	//===============================
	//CATEGORY FUNCTIONS
	//===============================

	//Get Category Details
	//Parameters: categoryId
	//Return: string (name)
	function getCategoryById($categoryId){

		global $conn;

		$query = "SELECT name FROM Category WHERE id='". $categoryId . "'";

		$result = $conn->query($query);

		if($result->num_rows != 1){
			echo "Error selecting " . $categoryId . " details";
		}else{
			return $result->fetch_assoc()['name'];
		}

	}

	//List Categories
	//Return: associative array (id, name)
	function listCategories(){

		global $conn;

		$query = "SELECT id, name FROM Category";

		$result = $conn->query($query);

		return fetch_all($result);

	}

?>