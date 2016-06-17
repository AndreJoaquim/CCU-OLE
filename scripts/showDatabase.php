<form action="configureDatabase.php">
	<input type="submit" value="Configurar Base de Dados">
</form>

<form action="populateDatabase.php">
	<input type="submit" value="Popular Base de Dados">
</form>

<?php

	require("./createConnection.php");

	//Show User Table
	echo "<h1> User Table <h1/>";
	
	$query = "SELECT email, firstname, lastname, password, phone FROM User ";

	$result = $conn->query($query);

	if ($result->num_rows > 0) {

		echo "<table border=\"1\" style=\"width:100%\">";
		echo "  <tr>";
		echo "    <th>email</th>";
		echo "    <th>firstname</th>"; 
		echo "    <th>lastname</th>";
		echo "    <th>phone</th>";
		echo "    <th>password</th>";
		echo "  </tr>";

	    while($row = $result->fetch_assoc()) {

	    	echo "  <tr>";
			echo "    <th>" . $row["email"] . "</th>";
			echo "    <th>" . $row["firstname"] . "</th>"; 
			echo "    <th>" . $row["lastname"] . "</th>";
			echo "    <th>" . $row["phone"] . "</th>";
			echo "    <th>" . $row["password"] . "</th>";
			echo "  </tr>";

	    }

		echo "</table>";

	} else {

	    echo "0 results";

	}

	echo "<br/>";

	//Show Course Table
	echo "<h1> Course Table <h1/>";
	
	$query = "SELECT name, description, author, difficulty, popularity, creationDate, CategoryId, image FROM Course ";

	$result = $conn->query($query);

	if ($result->num_rows > 0) {

		echo "<table border=\"1\" style=\"width:100%\">";
		echo "  <tr>";
		echo "    <th>name</th>";
		echo "    <th>description</th>"; 
		echo "    <th>difficulty</th>";
		echo "    <th>popularity</th>";
		echo "    <th>author</th>";
		echo "    <th>creationDate</th>";
		echo "    <th>CategoryId</th>";
		echo "    <th>image</th>";
		echo "  </tr>";

	    while($row = $result->fetch_assoc()) {

	    	echo "  <tr>";
			echo "    <th>" . $row["name"] . "</th>";
			echo "    <th>" . $row["description"] . "</th>"; 
			echo "    <th>" . $row["difficulty"] . "</th>";
			echo "    <th>" . $row["popularity"] . "</th>";
			echo "    <th>" . $row["author"] . "</th>";
			echo "    <th>" . $row["creationDate"] . "</th>";
			echo "    <th>" . $row["CategoryId"] . "</th>";
			echo "    <th>" . $row["image"] . "</th>";
			echo "  </tr>";

	    }

		echo "</table>";

	} else {

	    echo "0 results";

	}

	echo "<br/>";

	//Show Lesson Table
	echo "<h1> Lesson Table <h1/>";
	
	$query = "SELECT name, guide, video FROM Lesson ";

	$result = $conn->query($query);

	if ($result->num_rows > 0) {

		echo "<table border=\"1\" style=\"width:100%\">";
		echo "  <tr>";
		echo "    <th>name</th>";
		echo "    <th>guide</th>"; 
		echo "    <th>video</th>";
		echo "  </tr>";

	    while($row = $result->fetch_assoc()) {

	    	echo "  <tr>";
			echo "    <th>" . $row["name"] . "</th>";
			echo "    <th>" . $row["guide"] . "</th>"; 
			echo "    <th>" . $row["video"] . "</th>";
			echo "  </tr>";

	    }

		echo "</table>";

	} else {

	    echo "0 results";

	}

	echo "<br/>";

	//Show Categories Table
	echo "<h1> Categories Table <h1/>";
	
	$query = "SELECT name FROM Category ";

	$result = $conn->query($query);

	if ($result->num_rows > 0) {

		echo "<table border=\"1\" style=\"width:100%\">";
		echo "  <tr>";
		echo "    <th>name</th>";
		echo "  </tr>";

	    while($row = $result->fetch_assoc()) {

	    	echo "  <tr>";
			echo "    <th>" . $row["name"] . "</th>";
			echo "  </tr>";

	    }

		echo "</table>";

	} else {

	    echo "0 results";

	}

	echo "<br/>";
	
	//Show Question Table
	echo "<h1> Question Table <h1/>";
	
	$query = "SELECT question, correctAnswer, wrongAnswer1, wrongAnswer2, wrongAnswer3 FROM Question";

	$result = $conn->query($query);

	if ($result->num_rows > 0) {

		echo "<table border=\"1\" style=\"width:100%\">";
		echo "  <tr>";
		echo "    <th>question</th>";
		echo "    <th>correctAnswer</th>"; 
		echo "    <th>wrongAnswer1</th>";
		echo "    <th>wrongAnswer2</th>";
		echo "    <th>wrongAnswer3</th>";
		echo "  </tr>";

	    while($row = $result->fetch_assoc()) {

	    	echo "  <tr>";
			echo "    <th>" . $row["question"] . "</th>";
			echo "    <th>" . $row["correctAnswer"] . "</th>"; 
			echo "    <th>" . $row["wrongAnswer1"] . "</th>";
			echo "    <th>" . $row["wrongAnswer2"] . "</th>";
			echo "    <th>" . $row["wrongAnswer3"] . "</th>";
			echo "  </tr>";

	    }

		echo "</table>";

	} else {

	    echo "0 results";

	}

	echo "<br/>";

	//Show User <-> Lesson Table
	echo "<h1> User <-> Lesson Table <h1/>";
	
	$query = "SELECT emailUser, idLesson, lessonCompleted FROM UserLesson";

	$result = $conn->query($query);

	if ($result->num_rows > 0) {

		echo "<table border=\"1\" style=\"width:100%\">";
		echo "  <tr>";
		echo "    <th>emailUser</th>";
		echo "    <th>idLesson</th>"; 
		echo "    <th>lessonCompleted</th>";
		echo "  </tr>";

	    while($row = $result->fetch_assoc()) {

	    	echo "  <tr>";
			echo "    <th>" . $row["emailUser"] . "</th>";
			echo "    <th>" . $row["idLesson"] . "</th>"; 
			echo "    <th>" . $row["lessonCompleted"] . "</th>";
			echo "  </tr>";

	    }

		echo "</table>";

	} else {

	    echo "0 results";

	}

	echo "<br/>";

	//Show Course <-> Lesson Table
	echo "<h1> Course <-> Lesson Table <h1/>";
	
	$query = "SELECT idCourse, idLesson FROM CourseLesson";

	$result = $conn->query($query);

	if ($result->num_rows > 0) {

		echo "<table border=\"1\" style=\"width:100%\">";
		echo "  <tr>";
		echo "    <th>idCourse</th>";
		echo "    <th>idLesson</th>";
		echo "  </tr>";

	    while($row = $result->fetch_assoc()) {

	    	echo "  <tr>";
			echo "    <th>" . $row["idCourse"] . "</th>";
			echo "    <th>" . $row["idLesson"] . "</th>";
			echo "  </tr>";

	    }

		echo "</table>";

	} else {

	    echo "0 results";

	}

	echo "<br/>";
	
	//Show Lesson <-> Question Table
	echo "<h1> Lesson <-> Question Table <h1/>";
	
	$query = "SELECT idLesson, idQuestion FROM LessonQuestion";

	$result = $conn->query($query);

	if ($result->num_rows > 0) {

		echo "<table border=\"1\" style=\"width:100%\">";
		echo "  <tr>";
		echo "    <th>idLesson</th>";
		echo "    <th>idQuestion</th>";
		echo "  </tr>";

	    while($row = $result->fetch_assoc()) {

	    	echo "  <tr>";
			echo "    <th>" . $row["idLesson"] . "</th>";
			echo "    <th>" . $row["idQuestion"] . "</th>";
			echo "  </tr>";

	    }

		echo "</table>";

	} else {

	    echo "0 results";

	}

	echo "<br/>";

	require("./closeConnection.php");	
?>