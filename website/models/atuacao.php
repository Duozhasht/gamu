<?php
class Atuacao	 {

	//database Audicao Fields
	public $id_actuacao;
	public $id_audicao;

	public $designacao;

	public $actos = [];



	public function __construct($id_actuacao, $id_audicao, $designacao, $actos) {
		$this->id_actuacao = $id_actuacao;
		$this->id_audicao = $id_audicao;
		$this->designacao = $designacao;
		$this->actos = $actos;
	}


	public static function count() {
		
		$db = Db::getInstance();
		$result_count = $db->query("SELECT COUNT(*) AS number FROM Actuacao");
		$result_number = $result_count->fetch();
		
		return $result_number['number'];
	}

	public static function create($id_audicao, $designacao) {
	
		$db = DB::getInstance();
		$query_insert = "INSERT INTO Actuacao VALUES (NULL, $id_audicao, '$designacao')";
		
		$result = $db->query($query_insert);
	
	}


	public static function retrieve($order,$id_audicao) {

		$db = Db::getInstance();	
		$list = [];

		//Query
		$query_select = "SELECT * from Actuacao WHERE id_audicao=$id_audicao ORDER BY $order";
		$acts = $db->query($query_select);


		foreach($acts as $act){
			$acto_aux = [];

			$query_obras = "SELECT * from Actuacao_Obra WHERE id_actuacao={$act['id_actuacao']}";

			$obras = $db->query($query_obras);

			foreach($obras as $obra)
			{
				//reset arrays
				$acto_elem = [];
				$alunos_aux = [];
				$professores_aux = [];
				

				$obra_aux = Obra::Find($obra['id_obra']);

				//Alunos				
				$query_alunos = "SELECT * from Participante WHERE id_actuacao={$obra['id_actuacao']} AND id_obra={$obra['id_obra']} AND id_aluno IS NOT NULL";
				$alunos = $db->query($query_alunos);			

				foreach($alunos as $aluno)
				{
					$alunos_aux[] = Aluno::Find($aluno['id_aluno']);
				}

				//Professores
				$query_prof = "SELECT * from Participante WHERE id_actuacao={$obra['id_actuacao']} AND id_obra={$obra['id_obra']} AND id_professor IS NOT NULL";
				$profs = $db->query($query_prof);

				foreach($profs as $prof)
				{
					$professores_aux[] = Professor::Find($prof['id_professor']);
				}

				//criar array
				$participantes = array(
						"maestros" => $professores_aux, 
						"musicos" => $alunos_aux
					);

				$acto_elem['obra'] = $obra_aux;
				$acto_elem['participantes'] = $participantes;
				$acto_aux[] = $acto_elem; 
			}
			
				$list[] = new Atuacao($act['id_actuacao'],$act['id_audicao'],$act['designacao'],$acto_aux);
		}

		return $list;
	
	}

	public static function retrieve_last(){
		$db = DB::getInstance();
		$query_select = "SELECT id_actuacao from Actuacao ORDER BY id_actuacao DESC LIMIT 1";
		$result = $db->query($query_select);
		$result_number = $result->fetch();
		
		return $result_number['id_actuacao'];
	}

	public static function add_obra($id_actuacao, $id_obra){
		$db = DB::getInstance();
		$query_insert = "INSERT INTO Actuacao_Obra VALUES ($id_actuacao, $id_obra)";
		$result = $db->query($query_insert);
	}


	public static function add_musico_obra($id_actuacao,$id_obra,$id_aluno){
		$db = DB::getInstance();
		$query_insert = "INSERT INTO Participante VALUES ($id_actuacao, $id_obra, NULL, $id_aluno)";
		echo $query_insert;
		$result = $db->query($query_insert);

	}

	public static function add_maestro_obra($id_actuacao,$id_obra,$id_professor){
		$db = DB::getInstance();
		$query_insert = "INSERT INTO Participante VALUES ($id_actuacao, $id_obra, $id_professor, NULL)";
		echo $query_insert;
		$result = $db->query($query_insert);

	}


	public static function delete($id_actuacao){
		$db = DB::getInstance();
		$query_delete = "DELETE FROM Participante WHERE id_actuacao=$id_actuacao";
		$result = $db->query($query_delete);
		$query_delete = "DELETE FROM Actuacao_Obra WHERE id_actuacao=$id_actuacao";
		$result = $db->query($query_delete);
		$query_delete = "DELETE FROM Actuacao WHERE id_actuacao=$id_actuacao";
		$result = $db->query($query_delete);	
	}


	public static function delete_obra($id_actuacao,$id_obra) {

		$db = DB::getInstance();
		$query_delete = "DELETE FROM Participante WHERE id_actuacao=$id_actuacao AND id_obra=$id_obra";
		$result = $db->query($query_delete);
		$query_delete = "DELETE FROM Actuacao_Obra WHERE id_actuacao=$id_actuacao AND id_obra=$id_obra";
		$result = $db->query($query_delete);

	}


	public static function delete_musico_obra($id_actuacao,$id_obra,$id_aluno) {

		$db = DB::getInstance();
		$query_delete = "DELETE FROM Participante WHERE id_actuacao=$id_actuacao AND id_obra=$id_obra AND id_aluno=$id_aluno";
		$result = $db->query($query_delete);

	}

	public static function delete_maestro_obra($id_actuacao,$id_obra,$id_professor) {

		$db = DB::getInstance();
		$query_delete = "DELETE FROM Participante WHERE id_actuacao=$id_actuacao AND id_obra=$id_obra AND id_professor=$id_professor";
		$result = $db->query($query_delete);

	}
  }
  ?>