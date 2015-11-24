<?php
	require_once('bd.php');


	class Professor_Repository {

		public $db;

		function Professor_Repository(){
			$this->db = new myDB();
		}

		function adicionar($id,$nome,$dataNasc,$habilitacoes){

			//data base connection
			
			$query_insert = "INSERT INTO Professor 
							 VALUES ('".substr($id, 1)."','".$nome."','".$dataNasc."','".$habilitacoes."')";

			$result = $this->db->query($query_insert);
			//print_r($query_insert."</br>");
			/*
			if($result!=false)
				echo "Registo gravado com sucesso.";
			else
				echo "Erro.";
			*/
		}

		function remover($id){

		}

		function listar($order)
		{	

			$number_of_records=20;
			$query_number = "SELECT COUNT(*) AS number FROM Professor";
			$result_number = $this->db->query($query_number);
			foreach($result_number as $number){
				$result_number = $number['number'];
			}
			
			$result_number=ceil($result_number/$number_of_records);

			if(isset($_GET['page']))
				if(($_GET['page']>0) && ($_GET['page']<=$result_number))
					$page=$_GET['page'];
				else
					$page=1;
			else
				$page=1;

			
			$startpoint=($page-1)*$number_of_records;


			$query_retrieve_some = "SELECT * FROM Professor ORDER BY $order LIMIT $startpoint,$number_of_records";
			$result = $this->db->query($query_retrieve_some);

			echo "<table class='table'>
					<thead>
					<tr>
					<th width='5%'>#</th>
					<th width='40%'>Nome</th>
					<th width='20%'>Data de Nascimento</th>
					<th width='27%'>Habilitações</th>
					<th width='4%'></th>
					<th width='4%'></th>
					</tr>
					</thead>
				  <tbody>";

			foreach ($result as $professor)
			{
				echo "<tr>";
				echo "<td>P".$professor['id']."</td>";
				echo "<td>".$professor['nome']."</td>";
				echo "<td>".$professor['data_de_nascimento']."</td>";
				echo "<td>".$professor['habilitacoes']."</td>";
				echo "<td>
						<a href='#''><i class='fa fa-pencil-square-o'></i></a>
					  </td>";
				echo "<td>
						<a href='#''><i class='fa fa-times'></i></a>
					  </td>";	
				echo "</tr>";
			}

			echo "	</tbody>
					</table>";




			echo "<nav class='text-center'>
  			<ul class='pagination'>";

    		if($page-1<1)
    			echo "<li class='disabled'><a href=''";
    		else
    			echo "<li><a href='professores.php?page=".($page-1)."'";
    		echo "
     		aria-label='Previous'>
        	<span aria-hidden='true'>&laquo;</span>
      		</a>
    		</li>";

			for ($i=1; $i <=$result_number ; $i++) {

				if($page==$i)
 					echo   "<li class='active'><a href='professores.php?page=".$i."'>".$i."</a></li>";
 				else
 					echo   "<li><a href='professores.php?page=".$i."'>".$i."</a></li>";
 
			}
			if($page+1>$result_number)
    			echo "<li class='disabled'><a href=''";
    		else
    			echo "<li><a href='professores.php?page=".($page+1)."'";
			echo "aria-label='Next'>
        	<span aria-hidden='true'>&raquo;</span>
      		</a>
    		</li>
  			</ul>
			</nav>";

		}

		function importarXML($filename)
		{
			$professores = simplexml_load_file($filename);
			//echo "Cheguei!";
			//print_r($professores);
			foreach ($professores as $professor) {

				$this->adicionar((string)$professor->id,(string)$professor->nome,(string)$professor->dataNasc,(string)$professor->habilitacoes);
			}

		}

		function exportarXML()
		{

			$xmlstr = "<?xml version='1.0' encoding='UTF-8'?><professores/>";
			$professores = new SimpleXMLElement($xmlstr);

			$query_retrieve_some = "SELECT * FROM Professor ORDER BY Professor.id";
			$result = $this->db->query($query_retrieve_some);



			foreach ($result as $professor)
			{
				$prof = $professores->addChild('professor');
				$prof->addChild('id','p'.$professor['id']);
				$prof->addChild('nome',$professor['nome']);
				$prof->addChild('dataNasc',$professor['data_de_nascimento']);
				$prof->addChild('habilitacoes',$professor['habilitacoes']);

			}

			$professores->asXML('Public/XML/professores.xml');


		}


	}




?>
