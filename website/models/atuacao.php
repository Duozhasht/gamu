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
/*
	public static function create($id_actuacao,$id_audicao, $designacao, $actos) {
	
		$db = DB::getInstance();
		$query_insert = "INSERT INTO Actuacao VALUES ('$id_actuacao', '$id_audicao', '$designacao')";
		
		$result = $db->query($query_insert);

		foreach ($actos as $acto) {
			
		}
	
	}
*/

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
/*

	public static function update($id, $alu) {
	
		$db = DB::getInstance();
		$query_update = "UPDATE Aluno SET nome=$alu->nome,data_de_nascimento=$alu->dataNasc,id_curso=$alu->id_curso,ano_curso=$alu->anocurso WHERE id=$id";
		$result = $db->query($query_update);

	}


	public static function delete($id) {

		$db = DB::getInstance();
		$query_delete = "DELETE FROM Aluno WHERE id_aluno=$id";
		$result = $db->query($query_delete);

	}
*/
  }
  ?>