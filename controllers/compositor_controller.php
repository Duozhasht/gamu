<?php
  class CompositorController {

    
    public function index() {
      //small script to change url
      echo "<script>window.history.pushState('string', 'Index', 'http://localhost:8888/gamu/?controller=compositor&action=index');</script>";
      //number of records per page and number of pages 
      $nr_compositores = Compositor::count();
      $number_of_records = 20;
      $result_number=ceil($nr_compositores/$number_of_records);

      //Check page rules (if is set, if not atributes 1 if it's higher or lower the same)
      if(isset($_GET['page']))
        if(($_GET['page']>0) && ($_GET['page']<=$result_number))
          $page=$_GET['page'];
        else
          $page=1;
      else
        $page=1;

      // Get profs
      $compositores = Compositor::retrieve('id_compositor',$page,$number_of_records);
      require_once('views/compositor/index.php');

    }
/*

    public function add() {

        if(isset($_POST['nome'])&&isset($_POST['dataNasc'])&&isset($_POST['habilitacoes'])){
              $aux = Professor::create('NULL',$_POST['nome'],$_POST['dataNasc'],$_POST['habilitacoes']);
              echo "Inserção Concluída com Sucesso";
            }
        else
            echo "Problemas!";

      $controller = new ProfessorController();
      $controller->index();

    }

*/
    public function remove(){
      
      if(isset($_GET['id']))
      {
        $aux = Compositor::delete($_GET['id']);
      }
      $controller = new CompositorController();
      $controller->index();

    }

    public function exportxml(){
      
      $file = 'public/xml/compositores.xml';

      $nr_compositores = Compositor::count();
      $compositores = Compositor::retrieve('id_compositor',1,$nr_compositores);

      $xmlstr = "<?xml version='1.0' encoding='UTF-8'?>
                 <compositores/>";
      $xml_file = new SimpleXMLElement($xmlstr);

      
      foreach ($compositores as $compositor)
      {
        $comp = $xml_file->addChild('compositor');
        $comp->addAttribute('id','C'.$compositor->id);
        $comp->addChild('nome',$compositor->nome);
        $comp->addChild('bio',$compositor->bio);
        $comp->addChild('dataNasc',$compositor->dataNasc);
        $comp->addChild('dataObito',$compositor->dataObito);
        $comp->addChild('curso','PE'.$compositor->id_periodo);

      }
      //DOM conversion -> formatOutput needed
      $dom = new DOMDocument();
      $dom->preserveWhiteSpace = false;
      $dom->formatOutput = true;
      $dom->loadXML($xml_file->asXML());
      $dom->save($file);

      echo "<script>
              window.open('public/download_scripts/dw_cp.php', '_blank');
            </script>";
      $controller = new CompositorController();
      $controller->index();      

    }

    public function importxml() {
        $compositores = simplexml_load_file("dataset/Finais/compositores.xml");

        foreach($compositores as $compositor) {
          Compositor::create(substr((string)$compositor['id'],1),
                                     (string)$compositor->nome,
                                     'text',
                                     (string)$compositor->dataNasc,
                                     (string)$compositor->dataObito,
                               substr((string)$compositor->periodo,2));
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