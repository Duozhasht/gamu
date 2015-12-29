	<div class="container-fluid">
		<div class="row">
			<div id="header" class="col-xs-12" style="padding-top:30px;padding-bottom:70px;">
				<h2 id="title" class='text-center'>Professores</h2>	
			</div>
		</div> 
	</div>

	<div class="container">
		<div id="sidebar" class="col-xs-12 col-md-2" style="padding-top:10px;">
			<ul class="sidebar nav nav-pills nav-stacked">
				<li role="presentation" class="normal">
					
					<a href="#" onclick="showModal()">
					<i class="fa fa-plus" style="padding-right: 20px"></i>
						Adicionar
					</a>
				</li>
				<li id="download" role="presentation" class="safe">
					<a href="?controller=professor&action=exportxml">
						<i class="fa fa-file-text-o" style="padding-right: 20px"></i>
						Exportar XML
					</a>
				</li>
				<li role="presentation" class="safe">
					<a href="#" onclick="inputXML()">
						<i class="fa fa-file-pdf-o" style="padding-right: 20px"></i>
						Exportar PDF
					</a>
				</li>
				<li class="mydivider">
				</li>
				<li role="presentation" class="warn">
					<a href="#" onclick="inputXML()">
						<i class="fa fa-file-text-o" style="padding-right: 20px"></i>
						Importar XML
					</a>
				</li>
			</ul>
		</div>
		<div id="content" class="col-xs-12 col-md-10">
			<!-- Button trigger modal -->
			<table class='table'>
				<thead>
					<tr>
						<th width='5%'>#</th>
						<th width='40%'>Nome</th>
						<th width='12%'>Data de Nasc</th>
						<th width='12%'>Habilitações</th>
						<th width='23%'>Curso</th>
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
									echo "<td>".$professor->curso."</td>";
									echo "<td>
											<a href='#'><i class='fa fa-pencil-square-o'></i></a>
										</td>
										<td>
											<a href='?controller=professor&action=remove&id=".$professor->id."'><i class='fa fa-times'></i></a>
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
									echo "aria-label='Previous'>
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
					<div class="col-md-12">
						<form action='?controller=professor&action=add' method="post" accept-charset="utf-8">
							
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Professor">
								</div>
								<div class="form-group">
									<input type="date" class="form-control" id="dataNasc" name="dataNasc" placeholder="Data de Nascimento">
								</div>
							</div>
							<div class="col-md-12">
								
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
							<div class="col-md-12">
								<br>
								<div class="radio">
									<label class="radio-inline">
										<input type="radio" name="habilitacoes" value="Licenciatura" checked="checked">
										Licenciatura
									</label>
									<label class="radio-inline">
										<input type="radio" name="habilitacoes" value="Mestrado">
										Mestrado
									</label>
									<label class="radio-inline">
									</label>
									<h6 class="radio-inline text-muted" style="cursor:default;">
										Habilitações do Professor
									</h6>
								</div>

							</div>
							
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
	<form action='?controller=professor&action=importxml' method="post" accept-charset="utf-8">
		<input name="upload" type="file" id="fileinput"/>
	</form>
</div>
<script type="text/javascript">
function showModal(){
	$('#professorModal').modal('show');};
function inputXML(){
	$('#fileinput').trigger('click');
}
</script>