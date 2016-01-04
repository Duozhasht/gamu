	<div class="container-fluid">
		<div class="row">
			<div id="header" class="col-xs-12" style="padding-top:30px;padding-bottom:70px;">
				<h2 id="title" class='text-center'>Compositores</h2>	
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
					<a href="?controller=compositor&action=exportxml">
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
						<th width='40%'>Nome</th>
						<th width='20%'>Data de Nascimento</th>
						<th width='27%'>Período</th>
						<th width='4%'></th>
						<th width='4%'></th>
					</tr>
				</thead>
				<tbody>
					
					<?php
							foreach ($compositores as $compositor)
							{
							echo "<div id='c".$compositor->id."' class='hiddenfile' style='width: 0px; height: 0px; overflow: hidden;'>
									$compositor->bio;
								 </div>";
	
								echo "<tr>";
								echo "<td>C".$compositor->id."</td>";
								echo "<td>".$compositor->nome."</td>";
								echo "<td>".$compositor->dataNasc."</td>";
								echo "<td>".$compositor->periodo."</td>";
								echo "<td>
									  <a href='#' onclick='showModal2(\"".$compositor->id."\",\"".$compositor->nome."\",\"".$compositor->dataNasc."\",\"".$compositor->dataObito."\",\"".$compositor->id_periodo."\")'><i class='fa fa-pencil-square-o'></i></a>
									  </td>
									  <td>
									  <a href='?controller=compositor&action=remove&id=".$compositor->id."'><i class='fa fa-times'></i></a>
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
					echo "<li><a href='?controller=compositor&action=index&page=".($page-1)."'";
					echo "aria-label='Previous'>
						   <span aria-hidden='true'>&laquo;</span>
						   </a>
						  </li>";
					for ($i=1; $i <=$result_number ; $i++) {
					if($i<$page-2){
						if($i==1)
							echo   "<li><a href='?controller=compositor&action=index&page=".$i."'>...</a></li>";
						continue;
					}


					if($page==$i)
						echo   "<li class='active'><a href='?controller=compositor&action=index&page=".$i."'>".$i."</a></li>";
					else
						echo   "<li><a href='?controller=compositor&action=index&page=".$i."'>".$i."</a></li>";
					if($i>$page+1){
						echo   "<li><a href='?controller=compositor&action=index&page=".$result_number."'>...</a></li>";
						break;	
					}

				}
				if($page+1>$result_number)
					echo "<li class='disabled'><a href=''";
				else
					echo "<li><a href='?controller=compositor&action=index&page=".($page+1)."'";
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
				<h4 class="modal-title text-center" id="myModalLabel">Adicionar Compositor</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form action='?controller=compositor&action=add' method="post" accept-charset="utf-8">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Compositor">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="dataNasc" name="dataNasc" placeholder="Data de Nascimento" onfocus="(this.type='date')">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="dataObito" name="dataObito" placeholder="Data de Obito" onfocus="(this.type='date')">
							</div>
							<div class="form-group">
  								<textarea class="form-control" rows="5" id="bio" name="bio" placeholder="Biografia (breve descrição do compositor)"></textarea>
							</div>
						</div>				
						<div class="col-md-12">			
							<select class="form-control" name="id_periodo">
										
									<?php
										
										$nr_periodos = Periodo::count();
										$periodos = Periodo::retrieve('nome',1,$nr_periodos);
										
										foreach ($periodos as $periodo) {
											echo "<option value='".$periodo->id."'>".$periodo->nome."</option>";
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
				<h4 class="modal-title text-center" id="myModalLabel">Editar Compositor</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form action='?controller=compositor&action=update' method="post" accept-charset="utf-8">
						<div class="hiddenfile" style="width: 0px; height: 0px; overflow: hidden;">
							<div class="form-group">
								<input type="text" class="form-control" id="idu" name="id">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="nomeu" name="nome" placeholder="Nome do Compositor">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="dataNascu" name="dataNasc" placeholder="Data de Nascimento" onfocus="(this.type='date')">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="dataObitou" name="dataObito" placeholder="Data de Obito" onfocus="(this.type='date')">
							</div>
							<div class="form-group">
  								<textarea class="form-control" rows="5" id="biou" name="bio" placeholder="Biografia (breve descrição do compositor)"></textarea>
							</div>
						</div>				
						<div class="col-md-12">			
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



<div class="hiddenfile" style="width: 0px; height: 0px; overflow: hidden;">
<form action='?controller=aluno&action=importxml' method="post" accept-charset="utf-8">
  <input name="upload" type="file" id="fileinput"/>
</form>
</div>


<div  class="hiddenfile" style="width: 0px; height: 0px; overflow: hidden;">
<form id="upload" action='?controller=compositor&action=importxml' method="post" accept-charset="utf-8" enctype="multipart/form-data">
  <input type="file" name="ficheiro" id="file" />
  <input type="submit" name="Enviar"/>
</form>
</div>
<script type="text/javascript">
function showModal(){
	$('#insertModal').modal('show');};
function showModal2(id,nome,dataNasc,dataObito,periodo){
	$('#idu').val(id);
	$('#nomeu').val(nome);
	$('#dataNascu').val(dataNasc);
	$('#dataObitou').val(dataObito);
	$('#periodou').val(periodo);
	$('#biou').val($('#c'+id).text());
	$('#updateModal').modal('show');
};
function inputXML(){
	$('#file').trigger('click');
}
$('#file').change(function() {
  $('#upload').submit();
});
</script>