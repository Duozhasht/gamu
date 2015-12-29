<?php
class Obra {

	public $id;
	public $nome;
	public $descricao;
	public $ano;
	public $duracao;
	public $periodo;
	public $compositor;
	

	public $id_compositor;
	public $id_periodo;


	public function __construct($id, $nome, $descricao, $ano, $duracao, $periodo, $compositor, $id_periodo, $id_compositor) {
		$this->id = $id;
		$this->nome = $nome;
		$this->descricao = $descricao;
		$this->ano = $ano;
		$this->duracao = $duracao;
		$this->periodo = $periodo;
		$this->compositor = $compositor;

		$this->id_periodo = $id_periodo;
		$this->id_compositor = $id_compositor;

	}


	public static function count() {
		
		$db = Db::getInstance();
		$result_count = $db->query("SELECT COUNT(*) AS number FROM Obra");
		$result_number = $result_count->fetch();
		
		return $result_number['number'];
	}

	public static function create($id, $nome, $descricao, $ano, $duracao, $id_periodo, $id_compositor) {
	
		$db = DB::getInstance();
		$query_insert = "INSERT INTO Obra VALUES ('$id', '$nome', '$descricao', '$ano', '$duracao', '$id_periodo', '$id_compositor')";
		$result = $db->query($query_insert);
	
	}


	public static function retrieve($order,$page,$number_of_records) {

		$db = Db::getInstance();
		$startpoint=($page-1)*$number_of_records;
		$list = [];

		//Query
		$query_select = "SELECT * from obra_model ORDER BY $order LIMIT $startpoint,$number_of_records";
		$result = $db->query($query_select);


		// we create a list of Professor objects from the database results
		foreach($result as $obra)
			$list[] = new Obra($obra['id_obra'],$obra['nome'],$obra['descricao'],$obra['ano'],$obra['duracao'],$obra['periodo'],$obra['compositor'],$obra['id_periodo'],$obra['id_compositor']);

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