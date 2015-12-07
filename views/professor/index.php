<div class="container">
	<div class="row">
		<div id="sidebar" class="col-xs-12 col-md-2" style="padding-top:100px;">
			<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#professorModal">
			Adicionar
			</button>
			<ul class="nav nav-pills nav-stacked">
				<li role="presentation" class="active"><a href="#">Exportar XML</a></li>
				<li role="presentation"><a href="#">Exportar CSV</a></li>
				<li role="presentation"><a href="#">Mais um </a></li>
			</ul>
		</div>
		<div id="content" class="col-xs-12 col-md-10">
			<h2 id="title" class='text-center'>Professores</h2>
			<!-- Button trigger modal -->
			<table class='table'>
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
				<tbody>
			
				<?php
						foreach ($professores as $professor)
						{
							echo "<tr>";
							echo "<td>P".$professor->id."</td>";
							echo "<td>".$professor->nome."</td>";
							echo "<td>".$professor->dataNasc."</td>";
							echo "<td>".$professor->habilitacoes."</td>";
							echo "<td>
								  <a href='#''><i class='fa fa-pencil-square-o'></i></a>
					  			  </td>
					  			  <td>
								  <a href='#''><i class='fa fa-times'></i></a>
					  			  </td>";
							echo "</tr>";
						}

					?>

					</tbody>
					</table>

					<?php 
						echo "<nav class='text-center'>
  						<ul class='pagination'>";
			
    					if($page-1<1)
    						echo "<li class='disabled'><a href=''";
    					else
    						echo "<li><a href='?controller=professor&action=index&page=".($page-1)."'";

    					echo "
     					aria-label='Previous'>
        				<span aria-hidden='true'>&laquo;</span>
      					</a>
    					</li>";
			
						for ($i=1; $i <=$result_number ; $i++) {
			
							if($page==$i)
 								echo   "<li class='active'><a href='?controller=professor&action=index&page=".$i."'>".$i."</a></li>";
 							else
 								echo   "<li><a href='?controller=professor&action=index&page=".$i."'>".$i."</a></li>";
 			
						}
						if($page+1>$result_number)
    						echo "<li class='disabled'><a href=''";
    					else
    						echo "<li><a href='?controller=professor&action=index&page=".($page+1)."'";
						echo "aria-label='Next'>
        				<span aria-hidden='true'>&raquo;</span>
      					</a>
    					</li>
  						</ul>
						</nav>";
					?>


				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="professorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Adicionar Professor</h4>
					</div>
					<div class="modal-body">
						<div class="row">
						<form action='?controller=professor&action=add' method="post" accept-charset="utf-8">
							<button type="submit" value="submit">Adicionar</button>
						</form>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>