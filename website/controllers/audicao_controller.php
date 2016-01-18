<?php
  class AudicaoController {

    public function index()
    {
      //small script to change url
      echo "<script>window.history.pushState('string', 'Index', 'http://localhost:8888/gamu/website/?controller=audicao&action=index');</script>";
      //number of records per page and number of pages 
      $nr_audicoes = Audicao::count();
      $number_of_records = 50;
      $result_number=ceil($nr_audicoes/$number_of_records);

      //Check page rules (if is set, if not atributes 1 if it's higher or lower the same)
      if(isset($_GET['page']))
        if(($_GET['page']>0) && ($_GET['page']<=$result_number))
          $page=$_GET['page'];
        else
          $page=1;
      else
        $page=1;

      // Get
      $audicoes_previous = Audicao::retrieve('data',$page,$number_of_records,1);
      $audicoes_next = Audicao::retrieve('data',$page,$number_of_records,2);
      
      require_once('views/audicao/index.php');    

    }

    public function add(){
       if(!empty($_POST['titulo'])&&!empty($_POST['subtitulo'])&&!empty($_POST['tema'])&&!empty($_POST['data'])&&!empty($_POST['local'])&&!empty($_POST['organizador'])&&!empty($_POST['duracao'])){
              $aux = Audicao::create('NULL',$_POST['titulo'],$_POST['subtitulo'],$_POST['tema'],$_POST['data'],$_POST['local'],$_POST['organizador'],$_POST['duracao']);
              echo "<div class='alert alert-success text-center'>
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

      $controller = new AudicaoController();
      $controller->index();
    }

    public function add_atuacao() {

        if(isset($_GET['id_audicao'])&&!empty($_POST['designacao'])){
              Atuacao::create($_GET['id_audicao'],$_POST['designacao']);
              $id_actuacao = Atuacao::retrieve_last();


              //echo "<p>".$_POST['designacao']."</p>";
              $counter = 0;
              foreach ($_POST['id_obra'] as $id_obra) {
                Atuacao::add_obra($id_actuacao, $id_obra);
                //echo "<p>id obra: ".$id_obra."</p>";
                
                foreach ($_POST['ids_maestro'][$counter] as $id_maestro) {
                  Atuacao::add_maestro_obra($id_actuacao,$id_obra,$id_maestro);
                  //echo "<p>id maestro: ".$id_maestro."</p>";
                }
                foreach ($_POST['ids_musico'][$counter] as $id_musico) {
                  Atuacao::add_musico_obra($id_actuacao,$id_obra,$id_musico);
                  //echo "<p>id musico".$id_musico."</p>";
                }
                $counter++;


              }

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

      $controller = new AudicaoController();
      $controller->view2($_GET['id_audicao']);

    }

    public function add_musico_obra(){

      if(isset($_POST['id_actuacao'])&&isset($_POST['id_audicao'])&&isset($_POST['id_obra']))
      {
        try{
          $aux = Atuacao::add_musico_obra($_POST['id_actuacao'],$_POST['id_obra'],$_POST['id_musico']);
          echo "<div class='alert alert-success text-center'>
              <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Musico Adicionado Com Sucesso!
              </div>";
        }
        catch (Exception $e) {
          echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Não é possivel adicionar este registo.
                  </div>";
        }
      }
      $controller = new AudicaoController();
      $controller->view2($_POST['id_audicao']);

    }

        public function add_maestro_obra(){

      if(isset($_POST['id_actuacao'])&&isset($_POST['id_audicao'])&&isset($_POST['id_obra'])&&isset($_POST['id_maestro']))
      {
        try{
          $aux = Atuacao::add_maestro_obra($_POST['id_actuacao'],$_POST['id_obra'],$_POST['id_maestro']);
          echo "<div class='alert alert-success text-center'>
              <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Maestro Adicionado Com Sucesso!
              </div>";
        }
        catch (Exception $e) {
          echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Não é possivel adicionar este registo.
                  </div>";
        }
      }
      $controller = new AudicaoController();
      $controller->view2($_POST['id_audicao']);

    }

    public function add_obra(){

      if(isset($_POST['id_actuacao'])&&isset($_POST['id_audicao'])&&isset($_POST['id_obra']))
      {
        try{
          $aux = Atuacao::add_obra($_POST['id_actuacao'],$_POST['id_obra']);
          foreach ($_POST['ids_maestro'] as $id_maestro) {
                  Atuacao::add_maestro_obra($_POST['id_actuacao'],$_POST['id_obra'],$id_maestro);
                  //echo "<p>id maestro: ".$id_maestro."</p>";
                }
          foreach ($_POST['ids_musico'] as $id_musico) {
                  Atuacao::add_musico_obra($_POST['id_actuacao'],$_POST['id_obra'],$id_musico);
                  //echo "<p>id musico".$id_musico."</p>";
                }

          echo "<div class='alert alert-success text-center'>
              <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Maestro Adicionado Com Sucesso!
              </div>";
        }
        catch (Exception $e) {
          echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Não é possivel adicionar este registo.
                  </div>";
        }
      }
      else
        echo "erro";
      $controller = new AudicaoController();
      $controller->view2($_POST['id_audicao']);

    }




    public function view()
    {
      if(!empty($_GET['id']))
      {
        $audicao = Audicao::find($_GET['id']);
        $actuacoes = Atuacao::retrieve('id_actuacao',$_GET['id']);
        require_once('views/audicao/view.php');
      }
      else
        echo "Erro";
    }

    public function view2($id)
    {

        $audicao = Audicao::find($id);
        $actuacoes = Atuacao::retrieve('id_actuacao',$id);
        require_once('views/audicao/view.php');
    }

    public function test() 
    {
      $actuacoes = Atuacao::retrieve('id_actuacao',1);

      foreach($actuacoes as $actuacao)
      {
        echo "<h2>Actuação</h2>";
        echo "<p>".$actuacao->designacao." Actuacao</p>";
        

        foreach($actuacao->actos as $acto)
          {
            echo "<h3>Obra</h3>";
            echo "<p>- ".$acto['obra']->nome."</p>";

            echo "<h5>Maestros</h5>";
            foreach($acto['participantes']['maestros'] as $ma)
            {
              echo "<p>. ".$ma->nome."</p>";
            }

            echo "<h5>Musicos</h5>";
            foreach($acto['participantes']['musicos'] as $mu)
            {
              echo "<p>. ".$mu->nome."</p>";
            }
          }
          echo "<p>---------------------------------</p>";
      }

        //print_r($actuacoes);
    }

    public function remove_obra(){
      if(isset($_GET['id_actuacao'])&&isset($_GET['id_obra']))
      {
        try{
          $aux = Atuacao::delete_obra($_GET['id_actuacao'],$_GET['id_obra']);
          echo "<div class='alert alert-success text-center'>
              <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Aluno Removido Com Sucesso!
              </div>";
        }
        catch (Exception $e) {
          echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Não é possivel remover o registo. Por favor verifique se este não possui dependecias.
                  </div>";
        }
      }
      $controller = new AudicaoController();
      $controller->view2($_GET['id_audicao']);
    }

    public function remove_maestro_obra(){

      if(isset($_GET['id_actuacao'])&&isset($_GET['id_obra'])&&isset($_GET['id_professor']))
      {
        try{
          $aux = Atuacao::delete_maestro_obra($_GET['id_actuacao'],$_GET['id_obra'],$_GET['id_professor']);
          echo "<div class='alert alert-success text-center'>
              <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Maestro Removido Com Sucesso!
              </div>";
        }
        catch (Exception $e) {
          echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Não é possivel remover o registo. Por favor verifique se este não possui dependecias.
                  </div>";
        }
      }
      $controller = new AudicaoController();
      $controller->view2($_GET['id_audicao']);
    }

    public function remove_musico_obra(){

      if(isset($_GET['id_actuacao'])&&isset($_GET['id_obra'])&&isset($_GET['id_aluno']))
      {
        try{
          $aux = Atuacao::delete_musico_obra($_GET['id_actuacao'],$_GET['id_obra'],$_GET['id_aluno']);
          echo "<div class='alert alert-success text-center'>
              <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Musico Removido Com Sucesso!
              </div>";
        }
        catch (Exception $e) {
          echo "<div class='alert alert-danger text-center'>
                    <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Não é possivel remover o registo. Por favor verifique se este não possui dependecias.
                  </div>";
        }
      }
      $controller = new AudicaoController();
      $controller->view2($_GET['id_audicao']);
    }

    public function remove_audicao(){

       if(isset($_GET['id_audicao'])) {
        //echo "aqui";
        $actuacoes = Atuacao::retrieve('id_actuacao',$_GET['id_audicao']);
        foreach ($actuacoes as $actuacao) {
          Atuacao::delete($actuacao->id_actuacao);
        }
        Audicao::delete($_GET['id_audicao']);

       }

      $controller = new AudicaoController();
      $controller->index();
    }


    public function remove_atuacao(){

       if(isset($_GET['id_audicao'])&&!empty($_GET['id_actuacao'])){

        Atuacao::delete($_GET['id_actuacao']);

       }

      $controller = new AudicaoController();
      $controller->view2($_GET['id_audicao']);
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

          if(!$xmlDoc->schemaValidate("public/schema/audicoes.xsd"))
          {
            echo "<div class='alert alert-danger text-center'>
               <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                O ficheiro de xml não se encontra na devida estrutura!
               </div>";

          }
          else{
            $audicoes = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
            $erros = [];
  
          foreach($audicoes as $audicao) 
          {
            if(Audicao::find(substr((string)$audicao->id,3))->id==null)
            {
              Audicao::create(substr((string)$audicao->id,3),
                                     (string)$audicao->metadados->titulo,
                                     (string)$audicao->metadados->subtitulo,
                                     (string)$audicao->metadados->tema,
                                     (string)$audicao->metadados->data." ".(string)$audicao->metadados->hora,
                                     (string)$audicao->metadados->local,
                                     (string)$audicao->metadados->organizador,
                                     (string)$audicao->metadados->duracao);
              //echo "ID: ".$audicao->id;
              //echo $audicao->metadados->titulo;
              //var_dump($audicao);
              foreach ($audicao->atuacoes->atuacao as $atuacao) {
                //var_dump($atuacao);
                //echo "IDAT: ".$atuacao->idAt;
                //echo "Titulo: ".$atuacao->tituloAt;
                //echo $atuacao->tituloAt;
                Atuacao::create2(substr((string)$audicao->id,3),substr((string)$atuacao->idAt,2) , (string)$atuacao->tituloAt);

                foreach ($atuacao->obras->obra as $obra) {
                  
                  Atuacao::add_obra(substr((string)$atuacao->idAt,2), substr((string)$obra->idOb,1));

                  //echo "IDOB: ".$obra->idOb;
                  foreach ($obra->maestros->maestro as $ma) {
                    Atuacao::add_maestro_obra(substr((string)$atuacao->idAt,2),substr((string)$obra->idOb,1),substr((string)$ma,1));
                    //echo "Maestro: ".$ma;
                  }
                 foreach ($obra->musicos->musico as $mu) {
                    Atuacao::add_musico_obra(substr((string)$atuacao->idAt,2),substr((string)$obra->idOb,1),substr((string)$mu,1));
                  }


                }


              }


            }
            else
            {
                $erros[] = (string)$audicao['id'];
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
          $controller = new AudicaoController();
          $controller->index();
         }

        }



    public function exportxml(){
      
      $file = 'public/xml/audicoes.xml';

      $nr_auds = Audicao::count();
      $audicoes = Audicao::retrieve('data',1,$nr_auds,3);

      $xmlstr = "<?xml version='1.0' encoding='UTF-8'?>
                 <audicoes/>";
      $xml_file = new SimpleXMLElement($xmlstr);

      
      foreach ($audicoes as $audicao)
      {
        $aud = $xml_file->addChild('audicao');
        $aud->addChild('id','AUD'.$audicao->id);
        
        $aud_meta = $aud->addChild('metadados');
        $aud_meta->addChild('titulo',$audicao->titulo);
        $aud_meta->addChild('subtitulo',$audicao->subtitulo);
        $aud_meta->addChild('tema',$audicao->tema);
        $aud_meta->addChild('data',substr((string)$audicao->data,0,10));
        $aud_meta->addChild('hora',substr((string)$audicao->data,11));
        $aud_meta->addChild('local',$audicao->local);
        $aud_meta->addChild('organizador',$audicao->organizador);
        $aud_meta->addChild('duracao',$audicao->duracao);
        
        $actuacoes = Atuacao::retrieve('id_actuacao',$audicao->id);
        $aud_acts = $aud->addChild('atuacoes');
        
        foreach ($actuacoes as $actuacao) {
          $aud_act = $aud_acts->addChild('atuacao');
          $aud_act->addChild('idAt','AT'.$actuacao->id_actuacao);  
          $aud_act->addChild('tituloAt',$actuacao->designacao);

          $obras = $aud_act->addChild('obras');

          foreach($actuacao->actos as $acto){
            $obra = $obras->addChild('obra'); 
            $obra->addChild('idOb','O'.$acto['obra']->id);
            $instrumentos = $obra->addChild('instrumentos');
            $instrumentos_aux = []; 
            $maestros = $obra->addChild('maestros');
            $musicos = $obra->addChild('musicos');

             foreach($acto['participantes']['maestros'] as $ma){
               $maestros->addChild('maestro','P'.$ma->id);
             }
             foreach($acto['participantes']['musicos'] as $mu){
              if(!in_array($mu->id_instrumento, $instrumentos_aux))
              {
                $instrumentos_aux[] = $mu->id_instrumento;
                $instrumentos->addChild('instrumento','I'.$mu->id_instrumento);
              }
                $musicos->addChild('musico','A'.$mu->id);
             }

          }
  
        }
      }

      //DOM conversion -> formatOutput needed
      $dom = new DOMDocument();
      $dom->preserveWhiteSpace = false;
      $dom->formatOutput = true;
      $dom->loadXML($xml_file->asXML());
      $dom->save($file);

      echo "<script>
              window.open('public/download_scripts/dw_aud.php', '_blank');
            </script>";
      $controller = new AudicaoController();
      $controller->index();      

    }


  }
  
?>