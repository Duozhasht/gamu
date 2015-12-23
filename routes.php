<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'index':
        $controller = new IndexController();
      break;
      case 'professor':
        require_once('models/professor.php');
        $controller = new ProfessorController();
      break;
      case 'curso':
        require_once('models/curso.php');
        $controller = new CursoController();
      break;
      case 'instrumento':
        require_once('models/instrumento.php');
        $controller = new InstrumentoController();
      break;
      case 'aluno':
        require_once('models/aluno.php');
        $controller = new AlunoController();
      break;
      case 'periodo':
        require_once('models/periodo.php');
        $controller = new PeriodoController();
      break;      
      case 'compositor':
        require_once('models/compositor.php');
        $controller = new CompositorController();
      break;
      case 'obra':
        require_once('models/obra.php');
        $controller = new ObraController();
      break;
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('index' => ['home', 'error'],
                       'professor' => ['index','add','remove','exportxml','importxml'],
                       'curso' =>['index','add','remove','exportxml','importxml'],
                       'instrumento' =>['index','add','remove','exportxml','importxml'],
                       'aluno' =>['index','add','remove','exportxml','importxml'],
                       'periodo' =>['index','add','remove','exportxml','importxml'],
                       'compositor' =>['index','add','remove','exportxml','importxml'],
                       'obra' =>['index','add','remove','exportxml','importxml']
                       );

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('index', 'error');
    }
  } else {
    call('index', 'error');
  }
?>