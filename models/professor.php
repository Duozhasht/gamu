<?php
class Professor {

	public $id;
	public $nome;
	public $dataNasc;
	public $habilitacoes;
	public $curso;
	public $instrumento;

	public $id_curso;


	public function __construct($id, $nome, $dataNasc, $habilitacoes, $curso, $instrumento, $id_curso) {
		$this->id = $id;
		$this->nome = $nome;
		$this->dataNasc = $dataNasc;
		$this->habilitacoes = $habilitacoes;
		$this->curso = $curso;
		$this->instrumento = $instrumento;

		$this->id_curso = $id_curso;
	}


	public static function count() {
		
		$db = Db::getInstance();
		$result_count = $db->query("SELECT COUNT(*) AS number FROM Professor");
		$result_number = $result_count->fetch();
		
		return $result_number['number'];
	}

	public static function create($id, $nome, $dataNasc, $habilitacoes, $id_curso) {
	
		$db = DB::getInstance();
		$query_insert = "INSERT INTO Professor VALUES ('$id', '$nome', '$dataNasc', '$habilitacoes', '$id_curso')";
		$result = $db->query($query_insert);
	
	}


	public static function retrieve($order,$page,$number_of_records) {

		$db = Db::getInstance();
		$startpoint=($page-1)*$number_of_records;
		$list = [];

		//Query
		$query_select = "SELECT * from professormodel ORDER BY $order LIMIT $startpoint,$number_of_records";
		$result = $db->query($query_select);


		// we create a list of Professor objects from the database results
		foreach($result as $prof)
			$list[] = new Professor($prof['id_professor'],$prof['nome'],$prof['data_de_nascimento'],$prof['habilitacoes'],$prof['curso'],$prof['instrumento'],$prof['id_curso']);

		return $list;
	
	}


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

  }
  ?>