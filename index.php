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
    <link href="css/login.css" rel="stylesheet">
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
    <img style="position: fixed; z-index: -999; min-height:100%;" class="img-responsive center-block" src="img/classroomBlured.jpg">
    <div class="container verticalAlignFlexBox" >

        <form class="form-signin" method="post">
            <img class="img-responsive center-block" id="navbar-icon" src="img/logo-128-square.png" alt="OLE">
            <label for="inputEmail" class="sr-only">Endereço de correio eletrónico</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Endereço de correio eletrónico" required autofocus>
            <label for="inputPassword" class="sr-only">Palavra-passe</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Palavra-passe" required>
            <h6 id="loginFormError" class="text-right text-danger">Dados Inválidos. Tente Novamente!</h6>
            <button id="loginFormButton" class="btn btn-lg btn-primary btn-block" type="submit" >Iniciar Sessão</button>

            <hr class="lineStyle">
            <button class="btn btn-lg btn-primary btn-block" type="button" onclick="location.href='register.php';">Registe-se já!</button>
            
            <hr class="lineStyle">
            <button id="guestModeButton" class="btn btn-lg btn-default btn-block" type="button">Entrar como utilizador convidado</button>
        </form>

    </div>
    <!-- /container -->

</body>

</html>