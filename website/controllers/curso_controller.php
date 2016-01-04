<?php
  class CursoController {

    
    public function index() {
      //small script to change url
      echo "<script>window.history.pushState(null, null, 'http://localhost:8888/gamu/website/?controller=curso&action=index');</script>";
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

        if(!empty($_POST['curso'])&&!empty($_POST['id_instrumento'])){
              $instrumento = Instrumento::find($_POST['id_instrumento']);
              $duracao = 0;

              if(strpos($_POST['curso'], 'Supletivo') != FALSE)
                $duracao = 3;
              else
                $duracao = 5;
              $aux = Curso::create('NULL',$_POST['curso'].$instrumento->nome,$duracao,$_POST['id_instrumento']);
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

      $controller = new CursoController();
      $controller->index();

    }

    public function update() {

        if(!empty($_POST['id'])&&!empty($_POST['curso'])&&!empty($_POST['id_instrumento'])){
              $instrumento = Instrumento::find($_POST['id_instrumento']);
              $duracao = 0;

              if(strpos($_POST['curso'], 'Supletivo') != FALSE)
                $duracao = 3;
              else
                $duracao = 5;
              $aux = Curso::update($_POST['id'],$_POST['curso'].$instrumento->nome,$duracao,$_POST['id_instrumento']);
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

      $controller = new CursoController();
      $controller->index();

    }


    public function remove(){

      if(isset($_GET['id']))
      {
        try{
          $aux = Curso::delete($_GET['id']);
          echo "<div class='alert alert-success text-center'>
              <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Curso Removido Com Sucesso!
              </div>";
        }catch(PDOException $Exception){
          echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    O seguinte elemento não pode ser removido pois contem pelo menos uma dependencia;
                  </div>";
          
        }

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
        $cu->addChild('designacao',$curso->designacao);
        $cu->addChild('duracao',$curso->duracao);
        if(strpos($curso->designacao,'Supletivo') != FALSE){
          $cu->addAttribute('id','CS'.$curso->id);
          $aux = $cu->addChild('instrumento',substr($curso->designacao,20));
          $aux->addAttribute('id_instrumento','I'.$curso->id_instrumento);
        }
        else{
          $cu->addAttribute('id','CB'.$curso->id);
          $aux = $cu->addChild('instrumento',substr($curso->designacao,17));
          $aux->addAttribute('id_instrumento','I'.$curso->id_instrumento);
        }

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
        
        if($_FILES['ficheiro']['error'] > 0)
        {
          echo "Erro no ficheiro!";
        }
        else
        {

            $xmlDoc = new DOMDocument();
            $xmlDoc->load($_FILES['ficheiro']['tmp_name']);          

          if(!$xmlDoc->schemaValidate("public/schema/cursos.xsd"))
          {
            echo "<div class='alert alert-danger text-center'>
               <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                O ficheiro de xml não se encontra na devida estrutura!
               </div>";

          }
          else{
          $cursos = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
          $erros = [];
  
          foreach($cursos as $curso) 
          {
            if(Curso::find(substr((string)$curso['id'],2))->id==null)
            {
              Curso::create(substr((string)$curso['id'],2),
                               (string)$curso->designacao,
                               (string)$curso->duracao,
                        substr((string)$curso->instrumento['id_instrumento'],1));
            }
            else
            {
                $erros[] = (string)$curso['id'];
            }

          }

          if(!empty($erros))
          {
              echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Erro! Os seguintes ID's já se encontram determinados:
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
          $controller = new CursoController();
          $controller->index(); 
         }

        }


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