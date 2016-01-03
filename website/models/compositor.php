<?php
class Compositor {

	public $id;
	public $nome;
	public $bio;
	public $dataNasc;
	public $dataObito;
	public $periodo;

	public $id_periodo;


	public function __construct($id, $nome, $bio, $dataNasc, $dataObito, $periodo ,$id_periodo) {
		$this->id = $id;
		$this->nome = $nome;
		$this->bio = $bio;
		$this->dataNasc = $dataNasc;
		$this->dataObito = $dataObito;
		$this->periodo = $periodo;

		$this->id_periodo = $id_periodo;
	}


	public static function count() {
		
		$db = Db::getInstance();
		$result_count = $db->query("SELECT COUNT(*) AS number FROM Compositor");
		$result_number = $result_count->fetch();
		
		return $result_number['number'];
	}

	public static function create($id, $nome, $bio, $dataNasc, $dataObito, $id_periodo) {
	
		$db = DB::getInstance();
		$query_insert = "INSERT INTO Compositor VALUES ('$id', '$nome', '$bio', '$dataNasc', '$dataObito', '$id_periodo')";
		$result = $db->query($query_insert);
	
	}


	public static function retrieve($order,$page,$number_of_records) {

		$db = Db::getInstance();
		$startpoint=($page-1)*$number_of_records;
		$list = [];


		$query_select = "SELECT * from compositor_model ORDER BY $order LIMIT $startpoint,$number_of_records";
		$result = $db->query($query_select);


		
		foreach($result as $comp)
			$list[] = new Compositor($comp['id_compositor'],$comp['nome'],$comp['bio'],$comp['data_de_nascimento'],$comp['data_de_obito'],$comp['periodo'],$comp['id_periodo']);


		return $list;
	
	}

/*
	public static function update($id, $prof) {
	
		$db = DB::getInstance();
		$query_update = "UPDATE Professor SET nome=$prof->nome,data_de_nascimento=$prof->dataNasc,habilitacoes=$prof->habilitacoes WHERE id=$id";
		$result = $db->query($query_update);

	}

*/
	public static function delete($id) {

		$db = DB::getInstance();
		$query_delete = "DELETE FROM Compositor WHERE id_compositor=$id";
		$result = $db->query($query_delete);

	}

	public static function find($id) {

		$db = DB::getInstance();
		$query_find = "SELECT * FROM Compositor WHERE id_compositor = $id";

		$result = $db->query($query_find);
		$prof = $result->fetch();
		return new Compositor($comp['id_compositor'],$comp['nome'],$comp['bio'],$comp['data_de_nascimento'],$comp['data_de_obito'],$comp['periodo'],$comp['id_periodo']);

	}



  }
  ?>