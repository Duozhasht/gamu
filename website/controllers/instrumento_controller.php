<?php
  class InstrumentoController {

    
    public function index() {
      //small script to change url
      echo "<script>window.history.pushState('string', 'Index', 'http://localhost:8888/gamu/website/?controller=instrumento&action=index');</script>";
      //number of records per page and number of pages 
      $nr_instrumentos = Instrumento::count();
      $number_of_records = 100;
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

        if(!empty($_POST['designacao'])) {
              $aux = Instrumento::create('NULL',$_POST['designacao']);
              echo "
                    <div class='alert alert-success text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Inserção Concluída com Sucesso
                    </div>
                  ";
            }
        else
              echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Problemas no preenchimento de pelo menos um dos campos!
                  </div>";

      $controller = new InstrumentoController();
      $controller->index();

    }

    public function remove(){
      
      if(isset($_GET['id']))
      {
        try{
          $aux = Instrumento::delete($_GET['id']);
          echo "<div class='alert alert-success text-center'>
              <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Instrumento Removido Com Sucesso!
              </div>";
        }catch(PDOException $Exception){
          echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    O seguinte elemento não pode ser removido pois contem pelo menos uma dependencia;
                  </div>";
          
        }

      }

      $controller = new InstrumentoController();
      $controller->index();

    }

    public function update() {

        if(!empty($_POST['id'])&& !empty($_POST['designacao'])) {
              $aux = Instrumento::update($_POST['id'],$_POST['designacao']);
              echo "
                    <div class='alert alert-success text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Actualização Concluída com Sucesso
                    </div>
                  ";
            }
        else
              echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Problemas no preenchimento de pelo menos um dos campos!
                  </div>";

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
        $inst = $xml_file->addChild('instrumento',$instrumento->nome);
        $inst->addAttribute('id','I'.$instrumento->id);
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
        
        if($_FILES['ficheiro']['error'] > 0)
        {
          echo "Erro no ficheiro!";
        }
        else
        {

            $xmlDoc = new DOMDocument();
            $xmlDoc->load($_FILES['ficheiro']['tmp_name']);          

          if(!$xmlDoc->schemaValidate("public/schema/instrumentos.xsd"))
          {
            echo "<div class='alert alert-danger text-center'>
               <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                O ficheiro de xml não se encontra na devida estrutura!
               </div>";

          }
          else{
            $instrumentos = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
          $erros = [];
  
          foreach($instrumentos as $instrumento) 
          {
            if(Instrumento::find(substr((string)$instrumento['id'],1))->id==null)
            {
              Instrumento::create(substr((string)$instrumento['id'],1),
                                       (string)$instrumento);
            }
            else
            {
                $erros[] = (string)$instrumento['id'];
            }

          }

          if(!empty($erros))
          {
              echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Erro! Os seguintes ID's já se encontram atribuidos:
                    <p>".implode(" - ",$erros)."</p>
                  </div>";
          }
          else{
            echo "<div class='alert alert-success text-center'>   
                  <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  Os dados foram importados com sucesso!
                </div>
                  ";
          }


          }
          $controller = new InstrumentoController();
          $controller->index(); 
         }

        }  


  }
  
?>