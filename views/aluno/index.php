<div class="container">
	<div class="row">
		<div id="sidebar" class="col-xs-12 col-md-2" style="padding-top:100px;">
			<ul class="nav nav-pills nav-stacked">
				<li role="presentation" class="active"><a href="#" onclick="showModal()">Adicionar</a></li>
				<li></li>
				<li id="download" role="presentation"><a href="?controller=aluno&action=exportxml">Exportar Alunos</a></li>
				<li role="presentation"><a href="?controller=aluno&action=importxml">Importar Alunos</a></li>
			</ul>
		</div>
		<div id="content" class="col-xs-12 col-md-10">
			<h2 id="title" class='text-center'>Alunos</h2>
			<!-- Button trigger modal -->
			<table class='table'>
				<thead>
					<tr>
						<th width='5%'>#</th>
						<th width='40%'>Nome</th>
						<th width='15%'>Data de Nascimento</th>
						<th width='7%'>Ano</th>
						<th width='25%'>Curso</th>
						<th width='4%'></th>
						<th width='4%'></th>
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
								echo "<td>
									  <a href='#'><i class='fa fa-pencil-square-o'></i></a>
									  </td>
									  <td>
									  <a href='?controller=aluno&action=remove&id=".$aluno->id."'><i class='fa fa-times'></i></a>
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
					echo "<li><a href='?controller=aluno&action=index&page=".($page-1)."'";
					echo "aria-label='Previous'>
						   <span aria-hidden='true'>&laquo;</span>
						   </a>
						  </li>";
				for ($i=1; $i <=$result_number ; $i++) {
					if($i<$page-2){
						if($i==1)
							echo   "<li><a href='?controller=aluno&action=index&page=".$i."'>...</a></li>";
						continue;
					}


					if($page==$i)
						echo   "<li class='active'><a href='?controller=aluno&action=index&page=".$i."'>".$i."</a></li>";
					else
						echo   "<li><a href='?controller=aluno&action=index&page=".$i."'>".$i."</a></li>";
					if($i>$page+2){
						echo   "<li><a href='?controller=aluno&action=index&page=".$result_number."'>...</a></li>";
						break;	
					}

				}
				if($page+1>$result_number)
					echo "<li class='disabled'><a href=''";
				else
					echo "<li><a href='?controller=aluno&action=index&page=".($page+1)."'";
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
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Adicionar Aluno</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form action='?controller=aluno&action=add' method="post" accept-charset="utf-8">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Aluno">
							</div>
							<div class="form-group">
								<input type="date" class="form-control" id="dataNasc" name="dataNasc" placeholder="Data de Nascimento">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="number" class="form-control" id="anoCurso" name="anoCurso" placeholder="Ano a Frequentar">
								</div>
						</div>					
						<div class="col-md-8">
							
							<select class="form-control" name="id_curso">
									
									<?php
										//echo "<option value='' disabled selected>Escolha um Curso</option>";
										$nr_cursos = Curso::count();
										$cursos = Curso::retrieve('id_curso',1,100);
										
										foreach ($cursos as $curso) {
											echo "<option value='".$curso->id."'>".$curso->designacao."</option>";
										}
									?>	
							</select>
						</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Adicionar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</form>
			</div>
		</div>
	</div>
</div>



<div class="hiddenfile" style="width: 0px; height: 0px; overflow: hidden;">
<form action='?controller=aluno&action=importxml' method="post" accept-charset="utf-8">
  <input name="upload" type="file" id="fileinput"/>
</form>
</div>


<script type="text/javascript">
function showModal(){
	$('#insertModal').modal('show');};
function inputXML(){
	$('#fileinput').trigger('click'); 
}
</script>