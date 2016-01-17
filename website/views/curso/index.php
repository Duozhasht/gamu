	<div class="container-fluid">
	<div class="row">
		<div id="header" class="col-xs-12" style="padding-top:30px;padding-bottom:70px;">
			<h2 id="title" class='text-center'>Cursos</h2>	
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
					<a href="?controller=curso&action=exportxml">
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
								if(strpos($curso->designacao,'Supletivo') != FALSE)
									echo "<td>CS".$curso->id."</td>";
								else
									echo "<td>CB".$curso->id."</td>";
								echo "<td><a href='?controller=curso&action=view&id=".$curso->id."'>".$curso->designacao."</a></td>";
								echo "<td class='text-center'>".$curso->duracao." anos</td>";
								if(isset($curso->professor))
									echo "<td>".$curso->professor."</td>";
								else
									echo "<td style='color: #d9534f;'>Sem Professor</td>";
								echo "<td>
									  <a href='#' onclick='showModal2(\"".$curso->id."\",\"".$curso->designacao."\",\"".$curso->id_instrumento."\")'><i class='fa fa-pencil-square-o'></i></a>
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
<div  class="hiddenfile" style="width: 0px; height: 0px; overflow: hidden;">
<form id="upload" action='?controller=curso&action=importxml' method="post" accept-charset="utf-8" enctype="multipart/form-data">
  <input type="file" name="ficheiro" id="file" />
  <input type="submit" name="Enviar"/>
</form>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar Curso</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form action='?controller=curso&action=update' method="post" accept-charset="utf-8">
						<div class="hiddenfile" style="width: 0px; height: 0px; overflow: hidden;">
							<div class="form-group">
								<input type="text" class="form-control" id="idu" name="id">
							</div>
						</div>
						<div class="col-md-6">

								<label class="radio-inline">
								<input type="radio" id="cursou1" name="curso" value="Curso Básico de ">
								Curso Básico
								</label>
						</div>
						<div class="col-md-6">

								<label class="radio-inline">
								<input type="radio" id="cursou2" name="curso" value="Curso Supletivo de ">
								Curso Supletivo
								</label>

						</div>
						<br><br>
				
						<div class="col-md-12">
							
							<select id="instrumentou" class="form-control" name="id_instrumento">
									
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
				<button type="submit" class="btn btn-primary">Actualizar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</form>
			</div>
		</div>
	</div>
</div>
<div  class="hiddenfile" style="width: 0px; height: 0px; overflow: hidden;">
<form id="upload" action='?controller=curso&action=importxml' method="post" accept-charset="utf-8" enctype="multipart/form-data">
  <input type="file" name="ficheiro" id="file" />
  <input type="submit" name="Enviar"/>
</form>
</div>


<script type="text/javascript">
function showModal(){
	$('#insertModal').modal('show');};
function showModal2(id,designacao,instrumento){
	$('#idu').val(id);
	if(designacao.search("Supletivo") >= 0){
		$('#cursou2').prop('checked', true);
	}
	else{
		$('#cursou1').prop('checked', true);
	}
	$('#instrumentou').val(instrumento);
	$('#updateModal').modal('show');
};
function inputXML(){
	$('#file').trigger('click');
}
$('#file').change(function() {
  $('#upload').submit();
});
</script>