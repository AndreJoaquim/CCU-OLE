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

            header("Location: index.php");
            
        }else{

            $userInfo = getUserByEmail($userEmail);
            $userFirstName = $userInfo['firstname'];

        }

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
    <link href="css/lesson.css" rel="stylesheet">

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

            $hasLessonId = isset($_GET['id']);

            if($hasLessonId){
                $resultLesson = getLessonById($_GET['id']);
                $resultLessonCourse = getLessonCourseById($_GET['id']);
            }

            if(!$hasLessonId || $resultLesson=="NO_LESSON_BY_ID"){//Without or Invalid ID
                echo "<div class=\"page-header\"><h1>Está perdido? Volte à página inicial!</h1></div>";
                echo "<a class=\"btn btn-primary\" href=\"home.php\">Página Inicial</a>";
                
            }else{//With Valid ID

                //Apresentar Lição
                echo "<div class=\"page-header\">";
                echo "    <h2>" . $resultLesson['name'] . " <small>" . $resultLessonCourse['courseName'] . "</small></h2>";
                echo "</div>";

                echo "<div id=\"lesson-info\" class=\"row\">";
                echo "    <div class=\"column col-lg-6 col-md-6 col-sm-6 col-xs-6\">";
                echo "       <div id=\"lesson-video\" class=\"embed-responsive embed-responsive-16by9\">";

                echo "<div class=\"embed-responsive embed-responsive-16by9\">";
                echo "    <iframe allowfullscreen class=\"embed-responsive-item\" src=\"//" . $resultLesson['video'] . "\"></iframe>";
                echo "</div>";

                echo "      </div>";
                echo "    </div>";
                echo "    <div id=\"lesson-guide\" class=\"column col-lg-6 col-md-6 col-sm-6 col-xs-6\">";

                echo "        <h2>Tarefa</h2>";
                echo "        <div id=\"lesson-guide\">";
                echo "            <p>" . $resultLesson['guide'] . "</p>";
                echo "        </div>";

                echo "    </div>";
                echo "</div>";


                //Apresentar Questão
                $resultQuestion = getLessonQuestionById($_GET['id']);

                echo "<h3 id=\"question-title\">Pergunta: " . $resultQuestion[0]['question'] . "</h3>";
                echo "<input id=\"questionId\" type=\"hidden\" name=\"questionId\" value=\"" . $resultQuestion[0]['questionId'] . "\">";
                echo "<input id=\"lessonId\" type=\"hidden\" name=\"lessonId\" value=\"" . $_GET['id'] . "\">";
                echo "<table class=\"table\">";
                echo "    <tr>";
                echo "        <td class=\"column col-lg-6 col-md-6 col-sm-6 col-xs-6\">";
                echo "            <button type=\"button\" class=\"questionAnwser btn btn-default btn-block btn-lg\">" . $resultQuestion['0']['correctAnswer'] . "</button>";
                echo "        </td>";
                echo "        <td class=\"column col-lg-6 col-md-6 col-sm-6 col-xs-6\">";
                echo "            <button type=\"button\" class=\"questionAnwser btn btn-default btn-block btn-lg\">" . $resultQuestion['0']['wrongAnswer1'] . "</button>";
                echo "        </td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "        <td class=\"column col-lg-6 col-md-6 col-sm-6 col-xs-6\">";
                echo "            <button type=\"button\" class=\"questionAnwser btn btn-default btn-block btn-lg\">" . $resultQuestion['0']['wrongAnswer2'] . "</button>";
                echo "        </td>";
                echo "        <td class=\"column col-lg-6 col-md-6 col-sm-6 col-xs-6\">";
                echo "            <button type=\"button\" class=\"questionAnwser btn btn-default btn-block btn-lg\">" . $resultQuestion['0']['wrongAnswer3'] . "</button>";
                echo "        </td>";
                echo "    </tr>";
                echo "    <tr>";
                echo "        <td colspan=\"2\" class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">";
                echo "              <button id=\"submitQuestion\" type=\"submit\" class=\"btn btn-lg btn-info btn-block\">Submeter resposta</button>";
                echo "        </td>";
                echo "    </tr>";
                echo "</table>";

                //Navigation
                echo "<div id=\"nav-buttons\" class=\"row\">";

                //Exists Previous Lesson?
                $previousLesson = hasPreviousLesson($resultLessonCourse['courseId'],$_GET['id']);
                
                if($previousLesson == "NO_PREVIOUS_LESSON"){
                    echo "    <div id=\"back\" class=\"column col-lg-3 col-md-4 col-sm-5 col-xs-4\">";
                    echo "          <a class=\"btn btn-primary btn-block btn-lg\" href=\"course.php?id=" . $resultLessonCourse['courseId'] . "\"><span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span> Voltar ao curso</a>";
                    echo "    </div>";
                } else  {
                    echo "    <div id=\"back\" class=\"column col-lg-3 col-md-4 col-sm-5 col-xs-4\">";
                    echo "          <a class=\"btn btn-primary btn-block btn-lg\" href=\"lesson.php?id=" . $previousLesson . "\"><span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span> Voltar à lição anterior</a>";
                    echo "    </div>";
                }   

                echo "    <div class=\"column col-lg-6 col-md-4 col-sm-2 col-xs-4\">";
                echo "    </div>";

                //Exists Next Lesson?
                $nextLesson = hasNextLesson($resultLessonCourse['courseId'],$_GET['id']);

                if($nextLesson == "NO_NEXT_LESSON"){

                    //Completed all lessons inside course
                   
                    if(isCourseCompletedByUser($userEmail,$resultLessonCourse['courseId'],$_GET['id'] )){
                        echo "    <div id=\"fwd\" class=\"column col-lg-3 col-md-4 col-sm-5 col-xs-4\">";
                        echo "          <a class=\"btn btn-success btn-block btn-lg\" href=\"certificate.php?id=" . $resultLessonCourse['courseId'] . "&userEmail=" . urlencode($userEmail) . "\">Ver certificado<span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span></a>";
                        echo "    </div>";
                    }else{
                        echo "    <div id=\"fwd\" class=\"column col-lg-3 col-md-4 col-sm-5 col-xs-4\">";
                        echo "          <a class=\"btn btn-primary btn-block btn-lg\" href=\"course.php?id=" . $resultLessonCourse['courseId'] . "\"><span class=\"glyphicon glyphicon-chevron-left\" aria-hidden=\"true\"></span> Voltar ao curso</a>";
                        echo "    </div>";
                    }

                } else {
                    echo "    <div id=\"fwd\" class=\"column col-lg-3 col-md-4 col-sm-5 col-xs-4\">";
                    echo "          <a class=\"btn btn-success btn-block btn-lg\" href=\"lesson.php?id=" . $nextLesson . "\">Ir para a próxima lição <span class=\"glyphicon glyphicon-chevron-right\" aria-hidden=\"true\"></span></a>";
                    echo "    </div>";
                }
                
                echo "</div>";

            }
        ?>
    
    </div>  

</body>

</html>