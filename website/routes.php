<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'index':
        $controller = new IndexController();
      break;
      case 'professor':
        require_once('models/curso.php');
        require_once('models/professor.php');
        $controller = new ProfessorController();
      break;
      case 'curso':
        require_once('models/instrumento.php');
        require_once('models/curso.php');
        $controller = new CursoController();
      break;
      case 'instrumento':
        require_once('models/instrumento.php');
        $controller = new InstrumentoController();
      break;
      case 'aluno':
        require_once('models/curso.php');
        require_once('models/aluno.php');
        $controller = new AlunoController();
      break;
      case 'periodo':
        require_once('models/periodo.php');
        $controller = new PeriodoController();
      break;      
      case 'compositor':
        require_once('models/periodo.php');
        require_once('models/compositor.php');
        $controller = new CompositorController();
      break;
      case 'obra':
        require_once('models/periodo.php');
        require_once('models/obra.php');
        $controller = new ObraController();
      break;
      case 'audicao':
        require_once('models/audicao.php');
        require_once('models/atuacao.php');
        require_once('models/aluno.php');
        require_once('models/professor.php');
        require_once('models/obra.php');
        $controller = new AudicaoController();
      break;
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('index' => ['update','home', 'error'],
                       'professor' => ['update','index','add','remove','exportxml','importxml'],
                       'curso' => ['update','index','add','remove','exportxml','importxml'],
                       'instrumento' => ['update','index','add','remove','exportxml','importxml'],
                       'aluno' => ['update','index','add','remove','exportxml','importxml'],
                       'periodo' => ['update','index','add','remove','exportxml','importxml'],
                       'compositor' => ['update','index','add','remove','exportxml','importxml'],
                       'obra' => ['update','index','add','remove','exportxml','importxml'],
                       'audicao' => ['update','index','add','remove','exportxml','importxml','test','view']
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