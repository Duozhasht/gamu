<?php
class Periodo {

	public $id;
	public $nome;

	public function __construct($id, $nome) {
		$this->id = $id;
		$this->nome = $nome;
	}


	public static function count() {
		
		$db = Db::getInstance();
		$result_count = $db->query("SELECT COUNT(*) AS number FROM Periodo");
		$result_number = $result_count->fetch();
		
		return $result_number['number'];
	}

	public static function create($id, $nome) {
	
		$db = DB::getInstance();
		$query_insert = "INSERT INTO Periodo VALUES ('$id', '$nome')";
		$result = $db->query($query_insert);
	
	}


	public static function retrieve($order,$page,$number_of_records) {

		$db = Db::getInstance();
		$startpoint=($page-1)*$number_of_records;
		$list = [];

		//Query
		$query_select = "SELECT * FROM Periodo ORDER BY $order LIMIT $startpoint,$number_of_records";
		$result = $db->query($query_select);


		// we create a list of Instruments objects from the database results
		foreach($result as $inst)
			$list[] = new Periodo($inst['id_periodo'],$inst['nome']);

		return $list;
	
	}
/*

	public static function update($id, $inst) {
	
		$db = DB::getInstance();
		$query_update = "UPDATE Instrumento SET nome=$inst->nome WHERE id_instrumento=$id";
		$result = $db->query($query_update);

	}


	public static function delete($id) {

		$db = DB::getInstance();
		$query_delete = "DELETE FROM Instrumento WHERE id_instrumento=$id";
		$result = $db->query($query_delete);

	}

	public static function find($id) {

		$db = DB::getInstance();
		$query_find = "SELECT * FROM Instrumento WHERE id = $id";

		$result = $db->query($query_find);
		$inst = $result->fetch();
		return new Instrumento($inst['id'],$inst['nome']);

	}
*/
  }
  ?>