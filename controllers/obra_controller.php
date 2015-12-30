<?php
  class ObraController {

    
    public function index() {
      //small script to change url
      echo "<script>window.history.pushState('string', 'Index', 'http://localhost:8888/gamu/?controller=obra&action=index');</script>";
      //number of records per page and number of pages 
      $nr_obra = Obra::count();
      $number_of_records = 20;
      $result_number=ceil($nr_obra/$number_of_records);

      //Check page rules (if is set, if not atributes 1 if it's higher or lower the same)
      if(isset($_GET['page']))
        if(($_GET['page']>0) && ($_GET['page']<=$result_number))
          $page=$_GET['page'];
        else
          $page=1;
      else
        $page=1;

      // Get profs
      $obras = Obra::retrieve('id_obra',$page,$number_of_records);
      require_once('views/obra/index.php');
    }


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

    public function remove(){
      
      if(isset($_GET['id']))
      {
        $aux = Professor::delete($_GET['id']);
      }
      $controller = new ProfessorController();
      $controller->index();

    }
/*
    public function exportxml(){
      
      $file = 'public/xml/professores.xml';

      $nr_professores = Professor::count();
      $professores = Professor::retrieve('id_professor',1,$nr_professores);

      $xmlstr = "<?xml version='1.0' encoding='UTF-8'?>
                 <professores/>";
      $xml_file = new SimpleXMLElement($xmlstr);

      
      foreach ($professores as $professor)
      {
        $prof = $xml_file->addChild('professor');
        $prof->addAttribute('id','p'.$professor->id);
        $prof->addChild('nome',$professor->nome);
        $prof->addChild('dataNasc',$professor->dataNasc);
        $prof->addChild('habilitacoes',$professor->habilitacoes);
        $prof->addChild('curso',$professor->id_curso);

      }
      //DOM conversion -> formatOutput needed
      $dom = new DOMDocument();
      $dom->preserveWhiteSpace = false;
      $dom->formatOutput = true;
      $dom->loadXML($xml_file->asXML());
      $dom->save($file);

      echo "<script>
              window.open('public/download_scripts/dw_p.php', '_blank');
            </script>";
      $controller = new ProfessorController();
      $controller->index();      

    }
*/
    public function importxml() {
        $obras = simplexml_load_file("dataset/Finais/obras.xml");

        foreach($obras as $obra) {
          Obra::create(substr((string)$obra['id'],1),
                                     (string)$obra->nome,
                                     '(string)$obra->desc',
                                     (string)$obra->anoCriacao,
                                     (string)$obra->duracao,
                               substr((string)$obra->periodo,2),
                               substr((string)$obra->compositor,1));
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