<?php
  class InstrumentoController {

    
    public function index() {
      //small script to change url
      echo "<script>window.history.pushState('string', 'Index', 'http://localhost:8888/gamu/?controller=instrumento&action=index');</script>";
      //number of records per page and number of pages 
      $nr_instrumentos = Instrumento::count();
      $number_of_records = 40;
      $result_number=ceil($nr_instrumentos/$number_of_records);

      //Check page rules (if is set, if not atributes 1 if it's higher or lower the same)
      if(isset($_GET['page']))
        if(($_GET['page']>0) && ($_GET['page']<=$result_number))
          $page=$_GET['page'];
        else
          $page=1;
      else
        $page=1;

      // Get profs
      $instrumentos = Instrumento::retrieve('Instrumento.id_instrumento',$page,$number_of_records);
      require_once('views/instrumento/index.php');

    }


    public function add() {

        if(isset($_POST['nome'])) {
              $aux = Instrumento::create('NULL',$_POST['nome']);
              echo "Inserção Concluída com Sucesso";
            }
        else
            echo "Problemas!";

      $controller = new InstrumentoController();
      $controller->index();

    }

    public function remove(){
      
      if(isset($_GET['id']))
      {
        $aux = Instrumento::delete($_GET['id']);
      }
      $controller = new InstrumentoController();
      $controller->index();

    }

    public function exportxml(){
      
      $file = 'public/xml/instrumentos.xml';

      $nr_instrumentos = Instrumento::count();
      $instrumentos = Instrumento::retrieve('id_instrumento',1,$nr_instrumentos);

      $xmlstr = "<?xml version='1.0' encoding='UTF-8'?>
                 <instrumentos/>";
      $xml_file = new SimpleXMLElement($xmlstr);

      
      foreach ($instrumentos as $instrumento)
      {
        $inst = $xml_file->addChild('instrumento');
        $inst->addChild('id','p'.$instrumento->id);
        $inst->addChild('nome',$instrumento->nome);
      }
      //DOM conversion -> formatOutput needed
      $dom = new DOMDocument('1.0');
      $dom->preserveWhiteSpace = false;
      $dom->formatOutput = true;
      $dom->loadXML($xml_file->asXML());
      $dom->save($file);

      echo "<script>
              window.open('public/download_scripts/dw_i.php', '_blank');
            </script>";
      $controller = new InstrumentoController();
      $controller->index();      

    }

    public function importxml() {
        $instrumentos = simplexml_load_file("dataset/Finais/instrumentos.xml");

        foreach($instrumentos as $instrumento) {
          Instrumento::create(substr((string)$instrumento['id'],1),
                                     (string)$instrumento);
        }
        echo getcwd();
        echo "tudo okay!";
    }
  /*
  //CRUDE
  */
  }
  
?>