<?php
  class ProfessorController {

    
    public function index() {
      //number of records per page and number of pages 
      $nr_professores = Professor::count();
      $number_of_records = 20;
      $result_number=ceil($nr_professores/$number_of_records);

      //Check page rules (if is set, if not atributes 1 if it's higher or lower the same)
      if(isset($_GET['page']))
        if(($_GET['page']>0) && ($_GET['page']<=$result_number))
          $page=$_GET['page'];
        else
          $page=1;
      else
        $page=1;

      // Get profs
      $professores = Professor::retrieve('Professor.id',$page,$number_of_records);
      require_once('views/professor/index.php');

    }


    public function add() {

      require_once('views/index/error.php');


    }





  //CRUDE


/*
    public function show() {
      // we expect a url of form ?controller=posts&action=show&id=x
      // without an id we just redirect to the error page as we need the post id to find it in the database
      if (!isset($_GET['id']))
        return call('pages', 'error');

      // we use the given id to get the right post
      $post = Post::find($_GET['id']);
      require_once('views/posts/show.php');
    }
  */
  }
  
?>