	<div class="container-fluid">
		<div class="row">
			<div id="header" class="col-xs-12" style="padding-top:30px;padding-bottom:70px;">
				<h2 id="title" class='text-center'>Obras</h2>	
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
					<a href="?controller=obra&action=exportxml">
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
			<table class='table' width="100%">
				<thead>
					<tr>
						<th width='5%'>#</th>
						<th width='37%'>Nome</th>
						<th width='10%'>Ano</th>
						<th width='15%'>Período</th>
						<th width='25%'>Compositor</th>
						<th width='4%'></th>
						<th width='4%'></th>
					</tr>
				</thead>
				<tbody>
					
					<?php
							foreach ($obras as $obra)
							{
								echo "<div id='o".$obra->id."' class='hiddenfile' style='width: 0px; height: 0px; overflow: hidden;'>$obra->descricao</div>";
								echo "<tr>";
								echo "<td>C".$obra->id."</td>";
								echo "<td>".$obra->nome."</td>";
								echo "<td>".$obra->ano."</td>";
								echo "<td>".$obra->periodo."</td>";
								echo "<td>".$obra->compositor."</td>";
								echo "<td>
									  <a href='#' onclick='showModal2(\"".$obra->id."\",\"".$obra->nome."\",\"".$obra->duracao."\",\"".$obra->ano."\",\"".$obra->id_periodo."\",\"".$obra->id_compositor."\")'><i class='fa fa-pencil-square-o'></i></a>
									  </td>
									  <td>
									  <a href='?controller=obra&action=remove&id=".$obra->id."'><i class='fa fa-times'></i></a>
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
					echo "<li><a href='?controller=obra&action=index&page=".($page-1)."'";
					echo "aria-label='Previous'>
						   <span aria-hidden='true'>&laquo;</span>
						   </a>
						  </li>";
				for ($i=1; $i <=$result_number ; $i++) {
					if($page==$i)
						echo   "<li class='active'><a href='?controller=obra&action=index&page=".$i."'>".$i."</a></li>";
					else
						echo   "<li><a href='?controller=obra&action=index&page=".$i."'>".$i."</a></li>";
				}
				if($page+1>$result_number)
					echo "<li class='disabled'><a href=''";
				else
					echo "<li><a href='?controller=obra&action=index&page=".($page+1)."'";
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
				<h4 class="modal-title" id="myModalLabel">Adicionar Obra</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form action='?controller=obra&action=add' method="post" accept-charset="utf-8">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Obra">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição da Obra">
							</div>
							<div class="form-group">
								<input type="time" class="form-control" id="duracao" name="duracao" placeholder="Data de Nascimento">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="number" class="form-control" id="ano" name="ano" placeholder="Ano da Obra">
								</div>
						</div>					
						<div class="col-md-8">
							
							<select id="periodo" class="form-control" name="id_periodo">
								<?php
										
									$nr_periodos = Periodo::count();
									$periodos = Periodo::retrieve('nome',1,$nr_periodos);
									
									foreach ($periodos as $periodo) {
										echo "<option value='".$periodo->id."'>".$periodo->nome."</option>";
									}
								?>	


							</select>
						</div>
						<div class="col-md-12">					
							<select id="compositor" class="form-control" name="id_compositor">
									<?php
										
										$nr_comps = Compositor::count();
										$comps = Compositor::retrieve('nome',1,$nr_comps);
										
										foreach ($comps as $comp) {
											echo "<option value='".$comp->id."'>".$comp->nome."</option>";
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

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar Obra</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form action='?controller=obra&action=update' method="post" accept-charset="utf-8">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="nomeu" name="nome" placeholder="Nome da Obra">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="descricaou" name="descricao" placeholder="Descrição da Obra">
							</div>
							<div class="form-group">
								<input type="time" class="form-control" id="duracaou" name="duracao" placeholder="Data de Nascimento">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="number" class="form-control" id="anou" name="ano" placeholder="Ano da Obra">
								</div>
						</div>					
						<div class="col-md-8">
							
							<select id="periodou" class="form-control" name="id_periodo">
								<?php
										
									$nr_periodos = Periodo::count();
									$periodos = Periodo::retrieve('nome',1,$nr_periodos);
									
									foreach ($periodos as $periodo) {
										echo "<option value='".$periodo->id."'>".$periodo->nome."</option>";
									}
								?>	


							</select>
						</div>
						<div class="col-md-12">					
							<select id="compositoru" class="form-control" name="id_compositor">
									<?php
										
										$nr_comps = Compositor::count();
										$comps = Compositor::retrieve('nome',1,$nr_comps);
										
										foreach ($comps as $comp) {
											echo "<option value='".$comp->id."'>".$comp->nome."</option>";
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
<form id="upload" action='?controller=obra&action=importxml' method="post" accept-charset="utf-8" enctype="multipart/form-data">
  <input type="file" name="ficheiro" id="file" />
  <input type="submit" name="Enviar"/>
</form>
</div>
<script type="text/javascript">
function showModal(){
	$('#insertModal').modal('show');};
function showModal2(id,nome,duracao,ano,periodo,compositor){
	$('#idu').val(id);
	$('#nomeu').val(nome);
	$('#anou').val(ano);
	$('#periodou').val(periodo);
	$('#compositoru').val(compositor);
	$('#duracaou').val(duracao);
	$('#descricaou').val($('#o'+id).text());


	$('#updateModal').modal('show');
};
function inputXML(){
	$('#file').trigger('click');
}
$('#file').change(function() {
  $('#upload').submit();
});
</script>