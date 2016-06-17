<?php

    require("scripts/createConnection.php");

    require("scripts/functions.php");

    //Test if any user is connected
    if(!isset($_COOKIE['user'])){
        header("Location: index.php");
    }else{

        //User data
        $resultUser = getUserByEmail(urldecode($_GET['userEmail']));

        $userFullName = $resultUser['firstname'] . " " . $resultUser['lastname'];

        $course = getCourseById($_GET['id']);  
        
        $courseName = $course['name'];

    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Plataforma de aprendizagem online para idosos">
    <meta name="keywords" content="OLE, aprendizagem, online, idosos, CCU">
    <meta name="author" content="Group 15 | CCU-IST 2015">
    <link rel="icon" href="img/favicon.ico">

    <title>OLE - Aprendizagem Online para Idosos</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/template-page.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">

    <script src="./js/jquery-1.11.3.min.js"></script>
    <script src="./js/jquery.cookie.js"></script>
    <script src="./js/scripts.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"><img id="navbar-icon" src="img/logo-128-square.png" alt="OLE"></a>
                <h5>Aprendizagem Online para Idosos</h5>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
		<div id="certificate-copy" style="position: relative;" class="container-fluid">  
			<img class="thumbnail center-block" src="img/certificado.png">
            <h3 style="position: absolute; left: -2px; top: 315px; width:100%;" class="text-center raiseforprint"><?php echo $userFullName ?></h3>                
            <h3 style="position: absolute; left: -2px; top: 395px; width:100%;" class="text-center raiseforprint"><?php echo $courseName ?></h3>       
		</div>
		<div id="options-bar" class="container-fluid">
			<div class="navigation-options navbar-left">
				<button type="submit" onclick= "location.href='profile.php?userEmail=<?php echo $_GET['userEmail']; ?>';" class="btn btn-danger btn-lg">Voltar</button>
			</div>
			<div class="navigation-options navbar-right">
				<button id="printCertificate" type="submit" onclick="window.print()" class="btn btn-primary btn-lg">Imprimir</button>
			</div>
		</div>
	</div>


</body>

</html>