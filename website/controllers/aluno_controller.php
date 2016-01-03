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
        $aux = Aluno::delete($_GET['id']);
      }
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
        $alu->addChild('curso',$aluno->id_curso);
        $alu->addChild('anoCurso',$aluno->anocurso);

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
        $alunos = simplexml_load_file("dataset/Finais/alunos.xml");

        foreach($alunos as $aluno) {
          Aluno::create(  substr((string)$aluno['id'],1),
                                     (string)$aluno->nome,
                                     (string)$aluno->dataNasc,
                              substr((string)$aluno->curso,2),
                                     (string)$aluno->anoCurso);
        }
        //  $id, $nome, $dataNasc, $id_curso,$anocurso
    }

  }
  
?>