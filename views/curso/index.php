<div class="container">
	<div class="row">
		<div id="sidebar" class="col-xs-12 col-md-2" style="padding-top:100px;">
			<ul class="nav nav-pills nav-stacked">
				<li role="presentation" class="active"><a href="#" onclick="showModal()">Adicionar</a></li>
				<li></li>
				<li id="download" role="presentation"><a href="?controller=curso&action=exportxml">Exportar Cursos</a></li>
				<li role="presentation"><a href="#" onclick="inputXML()">Importar Cursos</a></li>
			</ul>
		</div>
		<div id="content" class="col-xs-12 col-md-10">
			<h2 id="title" class='text-center'>Cursos</h2>
			<!-- Button trigger modal -->
			<table width="100%" class='table'>
				<thead>
					<tr>
						<th width='5%'>#</th>
						<th width='20%'>Designação</th>
						<th class='text-center' width='10%'>Duração</th>
						<th width='35%'>Professor</th>
						<th width='4%'></th>
						<th width='4%'></th>
					</tr>
				</thead>
				<tbody>
					
					<?php
							foreach ($cursos as $curso)
							{
								echo "<tr>";
								echo "<td>C".$curso->id."</td>";
								echo "<td>".$curso->designacao."</td>";
								echo "<td class='text-center'>".$curso->duracao." anos</td>";
								if(isset($curso->professor))
									echo "<td>".$curso->professor."</td>";
								else
									echo "<td>n/a</td>";
								echo "<td>
									  <a href='#'><i class='fa fa-pencil-square-o'></i></a>
									  </td>
									  <td>
									  <a href='?controller=curso&action=remove&id=".$curso->id."'><i class='fa fa-times'></i></a>
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
					echo "<li><a href='?controller=curso&action=index&page=".($page-1)."'";
					echo "aria-label='Previous'>
						   <span aria-hidden='true'>&laquo;</span>
						   </a>
						  </li>";
				for ($i=1; $i <=$result_number ; $i++) {
					if($page==$i)
						echo   "<li class='active'><a href='?controller=curso&action=index&page=".$i."'>".$i."</a></li>";
					else
						echo   "<li><a href='?controller=curso&action=index&page=".$i."'>".$i."</a></li>";
				}
				if($page+1>$result_number)
					echo "<li class='disabled'><a href=''";
				else
					echo "<li><a href='?controller=curso&action=index&page=".($page+1)."'";
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
				<h4 class="modal-title" id="myModalLabel">Adicionar Curso</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form action='?controller=curso&action=add' method="post" accept-charset="utf-8">
						<div class="col-md-6">

								<label class="radio-inline">
								<input type="radio" name="curso" value="Curso Básico de " checked="checked">
								Curso Básico
								</label>
						</div>
						<div class="col-md-6">

								<label class="radio-inline">
								<input type="radio" name="curso" value="Curso Supletivo de ">
								Curso Supletivo
								</label>

						</div>
						<br><br>
				
						<div class="col-md-12">
							
							<select class="form-control" name="id_instrumento">
									
									<?php
										//echo "<option value='' disabled selected>Escolha um Curso</option>";
										$nr_instrumentos = Instrumento::count();
										$instrumentos = Instrumento::retrieve('id_instrumento',1,$nr_instrumentos);
										
										foreach ($instrumentos as $instrumento) {
											echo "<option value='".$instrumento->id."'>".$instrumento->nome."</option>";
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
<form action='?controller=professor&action=importxml' method="post" accept-charset="utf-8">
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