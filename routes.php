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
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('index' => ['home', 'error'],
                       'professor' => ['index','add','remove','exportxml']);

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