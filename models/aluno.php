<?php
class Aluno {

	public $id;
	public $nome;
	public $dataNasc;
	public $curso;
	public $ano_curso;
	public $instrumento;

	public $id_curso;
	public $id_instrumento;


	public function __construct($id, $nome, $dataNasc, $curso, $anocurso, $instrumento, $id_curso,$id_instrumento) {
		$this->id = $id;
		$this->nome = $nome;
		$this->dataNasc = $dataNasc;
		$this->curso = $curso;
		$this->anocurso = $curso;
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
		echo $query_insert;
		$result = $db->query($query_insert);
	
	}


	public static function retrieve($order,$page,$number_of_records) {

		$db = Db::getInstance();	
		$startpoint=($page-1)*$number_of_records;
		$list = [];

		//Query
		$query_select = "SELECT * from aluno_model ORDER BY $order LIMIT $startpoint,$number_of_records";
		$result = $db->query($query_select);


		// we create a list of Professor objects from the database results
		foreach($result as $alu)
			$list[] = new Aluno($alu['id_aluno'],$alu['nome'],$alu['data_de_nascimento'],$alu['curso'],$alu['ano_curso'],$alu['instrumento'],$alu['id_curso'],$alu['id_instrumento']);

		return $list;
	
	}

/*
	public static function update($id, $prof) {
	
		$db = DB::getInstance();
		$query_update = "UPDATE Professor SET nome=$prof->nome,data_de_nascimento=$prof->dataNasc,habilitacoes=$prof->habilitacoes WHERE id=$id";
		$result = $db->query($query_update);

	}


	public static function delete($id) {

		$db = DB::getInstance();
		$query_delete = "DELETE FROM Professor WHERE id=$id";
		$result = $db->query($query_delete);

	}

	public static function find($id) {

		$db = DB::getInstance();
		$query_find = "SELECT * FROM Professor WHERE id = $id";

		$result = $db->query($query_find);
		$prof = $result->fetch();
		return new Professor($prof['id'],$prof['nome'],$prof['data_de_nascimento'],$prof['habilitacoes']);

	}
*/
  }
  ?>