<?php
class Audicao {

	//database Audicao Fields
	public $id;
	public $titulo;
	public $subtitulo;
	public $tema;
	public $data;
	public $local;
	public $organizador;
	public $duracao;


	public function __construct($id, $titulo, $subtitulo, $tema, $data, $local, $organizador, $duracao) {
		$this->$id = $id;
		$this->$titulo = $titulo;
		$this->$subtitulo = $subtitulo;
		$this->$tema = $tema;
		$this->$data = $data;
		$this->$local = $local;
		$this->$organizador = $organizador;
		$this->$duracao = $duracao;
	}


	public static function count() {
		
		$db = Db::getInstance();
		$result_count = $db->query("SELECT COUNT(*) AS number FROM Audicao");
		$result_number = $result_count->fetch();
		
		return $result_number['number'];
	}

	public static function create($id, $titulo, $subtitulo, $tema, $data, $local, $organizador, $duracao) {
	
		$db = DB::getInstance();
		$query_insert = "INSERT INTO Audicao VALUES ('$id', '$titulo', '$subtitulo', '$tema', '$data', '$local', '$organizador', '$duracao')";
		
		$result = $db->query($query_insert);
	
	}


	public static function retrieve($order,$page,$number_of_records) {

		$db = Db::getInstance();	
		$startpoint=($page-1)*$number_of_records;
		$list = [];

		//Query
		$query_select = "SELECT * from Audicao ORDER BY $order LIMIT $startpoint,$number_of_records";
		$result = $db->query($query_select);

		foreach($result as $aud)
			$list[] = new Audicao($aud['id_audicao'],$aud['titulo'],$aud['subtitulo'],$aud['tema'],$aud['data'],$aud['local'],$aud['organizador'],$aud['duracao']);

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

	public static function find($id) {

		$db = DB::getInstance();
		$query_find = "SELECT * FROM aluno_model WHERE id_aluno = $id";

		$result = $db->query($query_find);
		$alu = $result->fetch();
		return new Aluno($alu['id_aluno'],$alu['nome'],$alu['data_de_nascimento'],$alu['curso'],$alu['ano_curso'],$alu['instrumento'],$alu['id_curso'],$alu['id_instrumento']);
	}

*/

  }
  ?>