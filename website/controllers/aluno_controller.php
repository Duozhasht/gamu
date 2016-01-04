<?php
  class AlunoController {

    
    public function index() {
      //small script to change url
      echo "<script>window.history.pushState('string', 'Index', 'http://localhost:8888/gamu/website/?controller=aluno&action=index');</script>";
      //number of records per page and number of pages 
      $nr_alunos = Aluno::count();
      $number_of_records = 20;
      $result_number=ceil($nr_alunos/$number_of_records);

      //Check page rules (if is set, if not atributes 1 if it's higher or lower the same)
      if(isset($_GET['page']))
        if(($_GET['page']>0) && ($_GET['page']<=$result_number))
          $page=$_GET['page'];
        else
          $page=1;
      else
        $page=1;

      // Get Students
      $alunos = Aluno::retrieve('id_aluno',$page,$number_of_records);
      require_once('views/aluno/index.php');

    }

    public function add() {

        if(!empty($_POST['nome'])&&!empty($_POST['dataNasc'])&&!empty($_POST['anoCurso'])&&!empty($_POST['id_curso'])){
              $aux = Aluno::create('NULL',$_POST['nome'],$_POST['dataNasc'],$_POST['id_curso'],$_POST['anoCurso']);
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

      $controller = new AlunoController();
      $controller->index();

    }

    public function remove(){
      
      if(isset($_GET['id']))
      {
        try{
          $aux = Aluno::delete($_GET['id']);
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
      }
      $controller = new AlunoController();
      $controller->index();

    }

    public function update() {

        if(!empty($_POST['nome'])&&!empty($_POST['dataNasc'])&&!empty($_POST['anoCurso'])&&!empty($_POST['id_curso'])){
              $aux = Aluno::update($_POST['id'],$_POST['nome'],$_POST['dataNasc'],$_POST['id_curso'],$_POST['anoCurso']);
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

      $controller = new AlunoController();
      $controller->index();

    }

    public function exportxml(){
      
      $file = 'public/xml/alunos.xml';

      $nr_alunos = Aluno::count();
      $alunos = Aluno::retrieve('id_aluno',1,$nr_alunos);

      $xmlstr = "<?xml version='1.0' encoding='UTF-8'?>
                 <alunos/>";
      $xml_file = new SimpleXMLElement($xmlstr);

      
      foreach ($alunos as $aluno)
      {
        $alu = $xml_file->addChild('aluno');
        $alu->addAttribute('id','a'.$aluno->id);
        $alu->addChild('nome',$aluno->nome);
        $alu->addChild('dataNasc',$aluno->dataNasc);
        if(strpos($aluno->curso,'Supletivo') != FALSE){
          $alu->addChild('curso','CS'.$aluno->id_curso);
        }
        else{
          $alu->addChild('curso','CB'.$aluno->id_curso);
        }
        $alu->addChild('anoCurso',$aluno->anocurso);
        $alu->addChild('instrumento',$aluno->instrumento);

      }
      
      //DOM conversion -> formatOutput needed
      $dom = new DOMDocument();
      $dom->preserveWhiteSpace = false;
      $dom->formatOutput = true;
      $dom->loadXML($xml_file->asXML());
      $dom->save($file);

      echo "<script>
              window.open('public/download_scripts/dw_a.php', '_blank');
            </script>";
      $controller = new AlunoController();
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

          if(!$xmlDoc->schemaValidate("public/schema/alunos.xsd"))
          {
            echo "<div class='alert alert-danger text-center'>
               <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                O ficheiro de xml não se encontra na devida estrutura!
               </div>";

          }
          else{
            $alunos = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
          $erros = [];
  
          foreach($alunos as $aluno) 
          {
            if(Aluno::find(substr((string)$aluno['id'],1))->id==null)
            {
              Aluno::create(  substr((string)$aluno['id'],1),
                                     (string)$aluno->nome,
                                     (string)$aluno->dataNasc,
                              substr((string)$aluno->curso,2),
                                     (string)$aluno->anoCurso);
            }
            else
            {
                $erros[] = (string)$aluno['id'];
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
          $controller = new AlunoController();
          $controller->index(); 
         }

        }

  }
  
?>