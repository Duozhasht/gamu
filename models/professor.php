<?php
class Professor {

	public $id;
	public $nome;
	public $dataNasc;
	public $habilitacoes;

	public function __construct($id, $nome, $dataNasc, $habilitacoes) {
		$this->id = $id;
		$this->nome = $nome;
		$this->dataNasc = $dataNasc;
		$this->habilitacoes = $habilitacoes;
	}


	public static function count(){
		$db = Db::getInstance();
		$result_count = $db->query("SELECT COUNT(*) AS number FROM Professor");
		foreach($result_count as $count)
			$result_number = $count['number'];
		return $result_number;
	}


	public static function all($order) {

		$list = [];
		$db = Db::getInstance();


      //Check if we got page number, if not the user it's redirected to page 1
		if(isset($_GET['page']))
			if(($_GET['page']>0) && ($_GET['page']<=$result_number))
				$page=$_GET['page'];
			else
				$page=1;
			else
				$page=1;
      //number of records per page | number of pages always rounded up | actual page
			$result_number = Professor::count();
			$number_of_records=20;
			$result_number=ceil($result_number/$number_of_records);
			$startpoint=($page-1)*$number_of_records;


      //Query
			$query_select = "SELECT * FROM Professor ORDER BY $order LIMIT $startpoint,$number_of_records";
			$result = $db->query($query_select);


      // we create a list of Post objects from the database results
			foreach($result as $prof)
				$list[] = new Professor($prof['id'],$prof['nome'],$prof['data_de_nascimento'],$prof['habilitacoes']);

			return $list;
		}







		
/*
    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM Professor WHERE id = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $post = $req->fetch();

      return new Post($post['id'], $post['author'], $post['content']);
    }
  */
  }
  ?>