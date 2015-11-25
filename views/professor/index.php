<div class="container">
			<div class="row">
				<div id="sidebar" class="col-xs-12 col-md-2" style="padding-top:100px;">
					<ul class="nav nav-pills nav-stacked">
						<li role="presentation" class="active"><a href="#">Exportar XML</a></li>
						<li role="presentation"><a href="#">Exportar CSV</a></li>
						<li role="presentation"><a href="#">Mais um </a></li>
					</ul>
				</div>
				<div id="content" class="col-xs-12 col-md-10">
					<h2 id="title" class='text-center'>Professores</h2>
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
				</div>
			</div>
		</div>