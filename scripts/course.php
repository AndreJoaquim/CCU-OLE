<?php

    require("scripts/createConnection.php");

    require("scripts/functions.php");

    //Test if any user is connected
    if(!isset($_COOKIE['user'])){
        header("Location: index.php");
    }else{

        $userEmail = $_COOKIE['user'];

        $isGuest = false;
        if($userEmail == "@convidado@"){//Se for convidado

            $isGuest = true;
            $userFirstName = "Convidado";
            
        }else{

            $userInfo = getUserByEmail($userEmail);
            $userFirstName = $userInfo['firstname'];

        }

    }

?>
<!DOCTYPE html>
<html class="full" lang="en">

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
    <link href="css/course.css" rel="stylesheet">

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
                <a class="navbar-brand" href=""><img id="navbar-icon" src="img/logo-128-square.png" alt="OLE"></a>
                <h5>Aprendizagem Online para Idosos</h5>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav"></ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?php 
                            if($isGuest){
                                echo "<a href=\"#\">";
                            }else{
                                echo "<a href=\"profile.php?userEmail=" . urlencode($userEmail) . "\">";
                            }
                        ?>

                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Olá <?php echo $userFirstName; ?>!
                        </a>
                    </li>
                    <li>
                        <form class="navbar-form navbar-right" role="logout">
                            <div class="btn-group">
                                <?php 
                                    if($isGuest){
                                        echo "<a class=\"btn btn-primary\" href=\"index.php\">Iniciar Sessão!</a>";
                                        echo "<a class=\"btn btn-primary\" href=\"register.php\">Quero Registar-me!</a>";
                                    }else{
                                        echo "<a class=\"btn btn-primary\" href=\"profile.php?userEmail=" . urlencode($userEmail) . "\">Ver Perfil!</a>";
                                        echo "<button id=\"logoutButton\" type=\"submit\" class=\"btn btn-primary\">Terminar sessão</button>";
                                    }
                                ?>                          
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <!-- Static navbar -->
    <nav id="second-navbar" class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="home.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
                        <?php 

                            $getCategories = listCategories();

                            foreach ($getCategories as $category) {

                                echo "<li><a href=\"home.php?category=" . $category['id'] . "\">" . $category['name'] . "</a></li>";

                            }

                        ?>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group">
                                <input id="searchInput" type="text" class="form-control" placeholder="Procure por tema ou título">
                            </div>
                            <button id="searchButton" type="submit" class="btn btn-primary">
                                <span  class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">

        <?php

            $hasCourseId = isset($_GET['id']);

            if($hasCourseId){
                $resultCourse = getCourseById($_GET['id']);
            }

            if(!$hasCourseId || $resultCourse=="NO_COURSE_BY_ID"){//Without or Invalid ID
                echo "<div class=\"page-header\"><h1>Está perdido? Volte à página inicial!</h1></div>";
                echo "<a class=\"btn btn-primary\" href=\"home.php\">Página Inicial</a>";
                
            }else{//With Valid ID

                echo "<div class=\"page-header\">";
                echo "    <h1>" . $resultCourse['name'] . " <small>" . $resultCourse['category'] . "</small></h1>";
                echo "</div>";

                echo "<div id=\"course-content\" class=\"row\">";
                echo "    <div id=\"course-image\" class=\"col-md-4\">";
                echo "        <img src=\"" . $resultCourse['image'] ."\" alt=\"\">";
                echo "    </div>";
                echo "    <div id=\"course-description\" class=\"col-md-8\">";
                echo "        <div id=\"course-description\">";
                echo "            <h2>Descrição</h2>";
                echo "            <p>" . $resultCourse['description'] . "</p>";
                echo "        </div>";
                echo "        <div id=\"course-information\">";
                echo "            <h3>Autor: <small>" . $resultCourse['author'] . "</small></h3>";
                echo "            <h3>Dificuldade: <small>" . $resultCourse['difficulty']. "</small></h3>";
                echo "        </div>";
                echo "        <div id=\"sign-in-course\">";
                echo "            <input id=\"enrollCourseButton\" type=\"submit\" value=\"Frequentar curso\" class=\"btn btn-success btn-block btn-lg\">";
                echo "        </div>";
                echo "    </div>";
                echo "</div>";

            }

        ?>

    </div>

</body>

<?php
    require("scripts/closeConnection.php");
?>
</html>