<?php
class Aluno {

	//database Student fields
	public $id;
	public $nome;
	public $dataNasc;
	public $id_curso;
	public $anocurso;

	//More info about Student
	public $instrumento;
	public $id_instrumento;
	public $curso;

	public function __construct($id, $nome, $dataNasc, $curso, $anocurso, $instrumento, $id_curso,$id_instrumento) {
		$this->id = $id;
		$this->nome = $nome;
		$this->dataNasc = $dataNasc;
		$this->curso = $curso;
		$this->anocurso = $anocurso;
		$this->instrumento = $instrumento;

		$this->id_curso = $id_curso;
		$this->id_instrumento = $id_instrumento;
	}


	public static function count() {
		
		$db = Db::getInstance();
		$result_count = $db->query("SELECT COUNT(*) AS number FROM Aluno");
		$result_number = $result_count->fetch();
		
		return $result_number['number'];
	}

	public static function create($id, $nome, $dataNasc, $id_curso,$anocurso) {
	
		$db = DB::getInstance();
		$query_insert = "INSERT INTO Aluno VALUES ('$id', '$nome', '$dataNasc', '$id_curso', '$anocurso')";
		
		$result = $db->query($query_insert);
	
	}


	public static function retrieve($order,$page,$number_of_records) {

		$db = Db::getInstance();	
		$startpoint=($page-1)*$number_of_records;
		$list = [];

		//Query
		$query_select = "SELECT * from aluno_model ORDER BY $order LIMIT $startpoint,$number_of_records";
		$result = $db->query($query_select);



		foreach($result as $alu)
			$list[] = new Aluno($alu['id_aluno'],$alu['nome'],$alu['data_de_nascimento'],$alu['curso'],$alu['ano_curso'],$alu['instrumento'],$alu['id_curso'],$alu['id_instrumento']);

		return $list;
	
	}


	public static function update($id, $nome, $dataNasc, $id_curso,$anocurso) {
	
		$db = DB::getInstance();
		$query_update = "UPDATE Aluno SET nome='$nome',data_de_nascimento='$dataNasc',id_curso=$id_curso,ano_curso=$anocurso WHERE id_aluno=$id";
		$result = $db->query($query_update);

	}


	public static function delete($id) {

		$db = DB::getInstance();
		$query_delete = "DELETE FROM Aluno WHERE id_aluno=$id";
		$result = $db->query($query_delete);

	}

	public static function find($id) {

		$db = DB::getInstance();
		$query_find = "SELECT * FROM aluno_model WHERE id_aluno = $id";

		$result = $db->query($query_find);
		$alu = $result->fetch();
		return new Aluno($alu['id_aluno'],$alu['nome'],$alu['data_de_nascimento'],$alu['curso'],$alu['ano_curso'],$alu['instrumento'],$alu['id_curso'],$alu['id_instrumento']);
	}

  }
  ?>