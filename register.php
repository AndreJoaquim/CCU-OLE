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
    <link href="css/register.css" rel="stylesheet">
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

    <div class="container verticalAlignFlexBox">
        <form class="form form-register" onsubmit="return false;">
            <h2>Registo <small> Totalmente gratuito!</small></h2>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <input type="text" id="inputFirstName" class="form-control input-lg" placeholder="Nome" required autofocus>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="text" id="inputLastName" class="form-control input-lg" placeholder="Apelido" required autofocus>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="tel" id="inputTel" class="form-control input-lg" placeholder="Número de telemóvel (opcional)" autofocus>
            </div>

            <div class="form-group">
                <input type="email" id="inputEmail" class="form-control input-lg" placeholder="Endereço de correio eletrónico" required autofocus>
                <h6 id="registerFormError" class="text-right text-danger">Email já registado!</h6>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="password" id="inputPassword" class="form-control input-lg" placeholder="Palavra-passe" required autofocus>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="password" id="inputPasswordConfirm" class="form-control input-lg" placeholder="Confirme a palavra-passe" required autofocus>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <input type="button" value="Cancelar" class="btn btn-danger btn-block btn-lg" onclick="location.href='index.php';">
                </div>
                <div class="col-xs-12 col-md-6">
                    <input id="registerFormSubmitButton" type="submit" value="Registar" class="btn btn-success btn-block btn-lg">
                </div>

            </div>
        </form>
    </div>
    <!-- /container -->

</body>

</html>