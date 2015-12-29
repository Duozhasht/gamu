<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GAM&mu;</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Custom CSS  -->
    <link rel="stylesheet" type="text/css" href="public/gamu.css?reload">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="padding-top: 70px;">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?controller=index&action=home">GAM&mu;</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown 
                  <?php
                    if($controller=='compositor' | $controller=='obra' | $controller=='periodo')
                      echo "active";
                  ?>

            ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestão de Audições <span class="caret"></span></a>
              <ul id ="ga" class="dropdown-menu">
                <li
                <?php
                  if($controller=='audicao')
                    echo "class='active'"
                ?>
                >
                  <a href="?controller=audicao&action=index">Audições</a></li>
                <li role="separator" class="divider"></li>
                <li
                  <?php
                    if($controller=='obra')
                      echo "class='active'"
                  ?>

                >
                  <a href="?controller=obra&action=index">Obras</a>
                </li>
                <li
                  <?php
                    if($controller=='compositor')
                      echo "class='active'"
                  ?>
                >
                  <a href="?controller=compositor&action=index">Compositores</a></li>

              </ul>
            </li>
            <li
            <?php
                    if($controller=='aluno')
                      echo "class='active'"
            ?>
            >
              <a href="?controller=aluno&action=index">Gestão de Alunos</a></li>
            <li class="dropdown 
                  <?php
                    if($controller=='instrumento' | $controller=='curso' | $controller=='professor')
                      echo "active";
                  ?>

            ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestão da Escola <span class="caret"></span></a>
              <ul id ="ge" class="dropdown-menu">
                <li
                  <?php
                    if($controller=='professor')
                      echo "class='active'"
                  ?>
                >
                  <a href="?controller=professor&action=index">Professores</a></li>
                <li
                <?php
                  if($controller=='curso')
                    echo "class='active'"
                ?>
                >
                  <a href="?controller=curso&action=index">Cursos</a></li>
                <li role="separator" class="divider"></li>
                <li
                  <?php
                    if($controller=='instrumento')
                      echo "class='active'"
                  ?>

                >
                  <a href="?controller=instrumento&action=index">Instrumentos</a>
                </li>
              </ul>
            </li>
            <li><a href="#"></a></li>
            <li><a href="#">Preferencias</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <?php require_once('routes.php'); ?>
  </body>
</html>