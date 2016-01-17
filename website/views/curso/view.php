	<div class="container-fluid">
	<div class="row">
		<div id="header" class="col-xs-12" style="padding-top:30px;padding-bottom:70px;">
			<h2 id="title" class='text-center'><?php echo $curso->designacao; ?></h2>	
		</div>
	</div> 
	</div>

	<div class="container">

		<div id="content" class="col-xs-12 col-md-12">
			
			<div class="col-xs-12 text-center" style="padding-bottom: 50px; font-size: 16px;">
				<strong>Duração: </strong><?php echo $curso->duracao." anos"; ?>
			</div>
			<h3 class="text-center" id="title" style="padding-bottom: 20px;">Professores que Lecionam o Curso</h3>
			<table class='table'>
				<thead>
					<tr>
						<th width='5%'>#</th>
						<th width='48%'>Nome</th>
						<th width='15%'>Data de Nasc</th>
						<th width='12%'>Habilitações</th>
						<th width='26%'>Curso</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
							foreach ($profs as $professor)
							{
								echo "<tr>";
									echo "<td>P".$professor->id."</td>";
									echo "<td>".$professor->nome."</td>";
									echo "<td>".$professor->dataNasc."</td>";
									echo "<td>".$professor->habilitacoes."</td>";
									echo "<td>".$professor->curso."</td>";

								echo "</tr>";
							}
					?>
				</tbody>
			</table>
			<h3 class="text-center" id="title" style="padding-top: 20px; padding-bottom: 20px;">Lista de Alunos que frequentam o Curso</h3>
			<table class='table'>
				<thead>
					<tr>
						<th width='5%'>#</th>
						<th width='48%'>Nome</th>
						<th width='15%'>Data de Nasc</th>
						<th width='7%'>Ano</th>
						<th width='25%'>Curso</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
							foreach ($alunos as $aluno)
							{
								echo "<tr>";
								echo "<td>P".$aluno->id."</td>";
								echo "<td>".$aluno->nome."</td>";
								echo "<td>".$aluno->dataNasc."</td>";
								echo "<td>".$aluno->anocurso."º ano</td>";
								echo "<td>".$aluno->curso."</td>";
							}
					?>
				</tbody>
			</table>
		</div>



	</div>
<