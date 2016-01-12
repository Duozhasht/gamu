<?php
  class ObraController {

    
    public function index() {
      //small script to change url
      echo "<script>window.history.pushState('string', 'Index', 'http://localhost:8888/gamu/website/?controller=obra&action=index');</script>";
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

      // Get
      $obras = Obra::retrieve('id_obra',$page,$number_of_records);
      require_once('views/obra/index.php');
    }


    public function add() {


      if(!empty($_POST['nome'])&&!empty($_POST['descricao'])&&!empty($_POST['duracao'])&&!empty($_POST['ano'])){
              $aux = Obra::create('NULL',$_POST['nome'],$_POST['descricao'],$_POST['ano'],$_POST['duracao'],$_POST['id_periodo'],$_POST['id_compositor']);
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

      $controller = new ObraController();
      $controller->index();


    }

    public function remove(){
      
      if(isset($_GET['id']))
        try{
          $aux = Obra::delete($_GET['id']);
          echo "<div class='alert alert-success text-center'>
              <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Aluno Removido Com Sucesso!
              </div>";
        }catch(PDOException $Exception){
          echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    O seguinte elemento não pode ser removido pois contem pelo menos uma dependencia;
                  </div>";
          
        }
      $controller = new ObraController();
      $controller->index();

    }

    public function exportxml(){
      
      $file = 'public/xml/obras.xml';

      $nr_obras = Obra::count();
      $obras = Obra::retrieve('id_obra',1,$nr_obras);

      $xmlstr = "<?xml version='1.0' encoding='UTF-8'?>
                 <obras/>";
      $xml_file = new SimpleXMLElement($xmlstr);

      
      foreach ($obras as $obra)
      {
        $ob = $xml_file->addChild('obra');
        $ob->addAttribute('id','O'.$obra->id);
        $ob->addChild('nome',$obra->nome);
        $ob->addChild('desc',$obra->descricao);
        $ob->addChild('anoCriacao',$obra->ano);
        $ob->addChild('periodo','PE'.$obra->id_periodo);
        $ob->addChild('compositor','C'.$obra->id_compositor);
        $ob->addChild('duracao',$obra->duracao.':00');

      }
      //DOM conversion -> formatOutput needed
      $dom = new DOMDocument();
      $dom->preserveWhiteSpace = false;
      $dom->formatOutput = true;
      $dom->loadXML($xml_file->asXML());
      $dom->save($file);

      echo "<script>
              window.open('public/download_scripts/dw_o.php', '_blank');
            </script>";
      $controller = new ObraController();
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

          if(!$xmlDoc->schemaValidate("public/schema/obras.xsd"))
          {
            echo "<div class='alert alert-danger text-center'>
               <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                O ficheiro de xml não se encontra na devida estrutura!
               </div>";

          }
          else{
            $obras = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
          $erros = [];
  
          foreach($obras as $obra) 
          {
            if(Obra::find(substr((string)$obra['id'],1))->id==null)
            {
              Obra::create(substr((string)$obra['id'],1),
                                     (string)$obra->nome,
                                     (string)$obra->desc,
                                     (string)$obra->anoCriacao,
                                     (string)$obra->duracao,
                               substr((string)$obra->periodo,2),
                               substr((string)$obra->compositor,1));            }
            else
            {
                $erros[] = (string)$obra['id'];
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
          $controller = new ObraController();
          $controller->index(); 
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