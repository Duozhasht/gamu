<?php
class Curso {

	public $id;
	public $designacao;
	public $duracao;
	public $professor;

	public $id_instrumento;


	public function __construct($id, $designacao, $duracao, $id_instrumento,$professor) {
		$this->id = $id;
		$this->designacao = $designacao;
		$this->duracao = $duracao;
		$this->professor = $professor;

		$this->id_instrumento = $id_instrumento;
	}


	public static function count() {
		
		$db = Db::getInstance();
		$result_count = $db->query("SELECT COUNT(*) AS number FROM Curso");
		$result_number = $result_count->fetch();
		
		return $result_number['number'];
	}

	public static function create($id, $designacao, $duracao, $id_instrumento) {
	
		$db = DB::getInstance();
		$query_insert = "INSERT INTO Curso VALUES ('$id', '$designacao', '$duracao', '$id_instrumento')";
		$result = $db->query($query_insert);
	
	}


	public static function retrieve($order,$page,$number_of_records) {

		$db = Db::getInstance();
		$startpoint=($page-1)*$number_of_records;
		$list = [];

		//Query
		$query_select = "SELECT * FROM curso_model ORDER BY $order LIMIT $startpoint,$number_of_records";
		$result = $db->query($query_select);


		// we create a list of Curso objects from the database results
		foreach($result as $curs)
			$list[] = new Curso($curs['id_curso'],$curs['designacao'],$curs['duracao'],$curs['id_instrumento'],$curs['professor']);

		return $list;
	
	}

	
/*
	public static function update($id, $curs) {
	
		$db = DB::getInstance();
		$query_update = "UPDATE Curso SET designacao=$curs->designacao,data_de_nascimento=$curs->dataNasc,habilitacoes=$curs->habilitacoes WHERE id=$id";
		$result = $db->query($query_update);

	}
*/

	public static function delete($id) {

		$db = DB::getInstance();
		$query_delete = "DELETE FROM Curso WHERE id_curso=$id";
		$result = $db->query($query_delete);

	}

	public static function find($id) {

		$db = DB::getInstance();
		$query_find = "SELECT * FROM Curso WHERE id_curso = $id";

		$result = $db->query($query_find);
		$curs = $result->fetch();
		return new Curso($curs['id_curso'],$curs['designacao'],$curs['data_de_nascimento'],$curs['habilitacoes']);

	}



  }
  ?>