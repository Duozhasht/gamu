<?php
  class CompositorController {

    
    public function index() {
      //small script to change url
      echo "<script>window.history.pushState('string', 'Index', 'http://localhost:8888/gamu/website/?controller=compositor&action=index');</script>";
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

      // Get
      $compositores = Compositor::retrieve('id_compositor',$page,$number_of_records);
      require_once('views/compositor/index.php');

    }


    public function add() {

        if(!empty($_POST['nome'])&&!empty($_POST['dataNasc'])&&!empty($_POST['dataObito'])&&!empty($_POST['bio'])&&!empty($_POST['id_periodo'])){
              $aux = Compositor::create('NULL',$_POST['nome'],$_POST['bio'],$_POST['dataNasc'],$_POST['dataObito'],$_POST['id_periodo']);
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

      $controller = new CompositorController();
      $controller->index();

    }

    public function remove(){
      
      if(isset($_GET['id']))
      {
        try {
          $aux = Compositor::delete($_GET['id']);
        }
        catch (Exception $e) {
          echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Não é possivel remover o registo. Por favor verifique se este não possui dependecias.
                  </div>";
        }
      }
      $controller = new CompositorController();
      $controller->index();

    }

    public function update() {

        if(!empty($_POST['nome'])&&!empty($_POST['dataNasc'])&&!empty($_POST['dataObito'])&&!empty($_POST['bio'])&&!empty($_POST['id_periodo'])){
              $aux = Compositor::update($_POST['id'],$_POST['nome'],$_POST['bio'],$_POST['dataNasc'],$_POST['dataObito'],$_POST['id_periodo']);
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
        $comp->addChild('periodo','PE'.$compositor->id_periodo);

      }
      //DOM conversion -> formatOutput needed
      $dom = new DOMDocument();
      $dom->preserveWhiteSpace = false;
      $dom->formatOutput = true;
      $dom->loadXML($xml_file->asXML());
      $dom->save($file);

      echo "<script> window.open('public/download_scripts/dw_cp.php', '_blank'); </script>";
      $controller = new CompositorController();
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

          if(!$xmlDoc->schemaValidate("public/schema/compositores.xsd"))
          {
            echo "<div class='alert alert-danger text-center'>
               <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                O ficheiro de xml não se encontra na devida estrutura!
               </div>";

          }
          else{
            $compositores = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
            $erros = [];
  
          foreach($compositores as $compositor) 
          {
            if(Compositor::find(substr((string)$compositor['id'],1))->id==null)
            {
              Compositor::create(substr((string)$compositor['id'],1),
                                     (string)$compositor->nome,
                                     (string)$compositor->bio,
                                     (string)$compositor->dataNasc,
                                     (string)$compositor->dataObito,
                               substr((string)$compositor->periodo,2));
            }
            else
            {
                $erros[] = (string)$compositor['id'];
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
          $controller = new CompositorController();
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