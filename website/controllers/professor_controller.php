<?php
  class ProfessorController {

    
    public function index() {
      //small script to change url
      echo "<script>window.history.pushState('string', 'Index', 'http://localhost:8888/gamu/website/?controller=professor&action=index');</script>";
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
      $professores = Professor::retrieve('id_professor',$page,$number_of_records);
      require_once('views/professor/index.php');

    }


    public function add() {

        if(!empty($_POST['nome'])&&!empty($_POST['dataNasc'])&&!empty($_POST['habilitacoes'])){
              $aux = Professor::create('NULL',$_POST['nome'],$_POST['dataNasc'],$_POST['habilitacoes'],$_POST['id_curso']);
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

      $controller = new ProfessorController();
      $controller->index();

    }

    public function remove(){
      
      if(isset($_GET['id']))
      {        
        try{
          $aux = Professor::delete($_GET['id']);
          echo "<div class='alert alert-success text-center'>
              <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Professor Removido Com Sucesso!
              </div>";
        }catch(PDOException $Exception){
          echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    O seguinte elemento não pode ser removido pois contem pelo menos uma dependencia;
                  </div>";
          
        }
        
      }
      $controller = new ProfessorController();
      $controller->index();

    }

    public function update() {

        if(!empty($_POST['nome'])&&!empty($_POST['dataNasc'])&&!empty($_POST['habilitacoes'])){
              $aux = Professor::update($_POST['id'],$_POST['nome'],$_POST['dataNasc'],$_POST['habilitacoes'],$_POST['id_curso']);
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

      $controller = new ProfessorController();
      $controller->index();

    }

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
        $prof->addAttribute('id','P'.$professor->id);
        $prof->addChild('nome',$professor->nome);
        $prof->addChild('dataNasc',$professor->dataNasc);
        $prof->addChild('habilitacoes',$professor->habilitacoes);
        if(strpos($prof->curso,'Supletivo') != FALSE)
          $prof->addChild('curso','CS'.$professor->id_curso);
        else
          $prof->addChild('curso','CB'.$professor->id_curso);

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


    public function importxml() {
        
        if($_FILES['ficheiro']['error'] > 0)
        {
          echo "Erro no ficheiro!";
        }
        else
        {

            $xmlDoc = new DOMDocument();
            $xmlDoc->load($_FILES['ficheiro']['tmp_name']);          

          if(!$xmlDoc->schemaValidate("public/schema/professores.xsd"))
          {
            echo "<div class='alert alert-danger text-center'>
               <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                O ficheiro de xml não se encontra na devida estrutura!
               </div>";

          }
          else{
            $professores = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
          $erros = [];
  
          foreach($professores as $professor) 
          {
            if(Professor::find(substr((string)$professor['id'],1))->id==null)
            {
              Professor::create(substr((string)$professor['id'],1),
                                     (string)$professor->nome,
                                     (string)$professor->dataNasc,
                                     (string)$professor->habilitacoes,
                               substr((string)$professor->curso,2));
            }
            else
            {
                $erros[] = (string)$professor['id'];
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
          $controller = new ProfessorController();
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