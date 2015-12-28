<?php
  class CursoController {

    
    public function index() {
      //small script to change url
      echo "<script>window.history.pushState(null, null, 'http://localhost:8888/gamu/?controller=curso&action=index');</script>";
      //number of records per page and number of pages 
      $nr_cursos = Curso::count();
      $number_of_records = 22;
      $result_number=ceil($nr_cursos/$number_of_records);

      //Check page rules (if is set, if not atributes 1 if it's higher or lower the same)
      if(isset($_GET['page']))
        if(($_GET['page']>0) && ($_GET['page']<=$result_number))
          $page=$_GET['page'];
        else
          $page=1;
      else
        $page=1;

      // Get profs
      $cursos = Curso::retrieve('id_curso',$page,$number_of_records);
      require_once('views/curso/index.php');

    }

    
    public function add() {

        if(isset($_POST['curso'])&&isset($_POST['id_instrumento'])){
              $instrumento = Instrumento::find($_POST['id_instrumento']);
              $duracao = 0;

              if(strpos($_POST['curso'], 'Supletivo') != FALSE)
                $duracao = 3;
              else
                $duracao = 5;
              $aux = Curso::create('NULL',$_POST['curso'].$instrumento->nome,$duracao,$_POST['id_instrumento']);
              echo "Inserção Concluída com Sucesso";
            }
        else
            echo "Problemas!";

      $controller = new CursoController();
      $controller->index();

    }

    public function remove(){
      
      if(isset($_GET['id']))
      {
        $aux = Curso::delete($_GET['id']);
      }
      $controller = new CursoController();
      $controller->index();

    }

    public function exportxml(){
      
      $file = 'public/xml/cursos.xml';

      $nr_cursos = Curso::count();
      $cursos = Curso::retrieve('id_curso',1,$nr_cursos);

      $xmlstr = "<?xml version='1.0' encoding='UTF-8'?>
                 <cursos/>";
      $xml_file = new SimpleXMLElement($xmlstr);

      
      foreach ($cursos as $curso)
      {
        $cu = $xml_file->addChild('curso');
        $cu->addAttribute('id','p'.$curso->id);
        $cu->addChild('designacao',$curso->designacao);
        $cu->addChild('dataNasc',$curso->duracao);
        if(strpos($curso->designacao,'Supletivo') != FALSE)
          $cu->addChild('instrumento','CS'.$curso->id_instrumento);
        else
          $cu->addChild('instrumento','CB'.$curso->id_instrumento);

      }
      //DOM conversion -> formatOutput needed
      $dom = new DOMDocument('1.0');
      $dom->preserveWhiteSpace = false;
      $dom->formatOutput = true;
      $dom->loadXML($xml_file->asXML());
      $dom->save($file);

      echo "<script>
              window.open('public/download_scripts/dw_c.php', '_blank');
            </script>";
      $controller = new CursoController();
      $controller->index();      

    }


    public function importxml() {
        $filename = 'dataset/Finais/cursos.xml';

        $cursos = simplexml_load_file($filename);
        foreach($cursos as $curso) {
          Curso::create(substr((string)$curso['id'],2),
                               (string)$curso->designacao,
                               (string)$curso->duracao,
                        substr((string)$curso->instrumento['id_instrumento'],1));
        }

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