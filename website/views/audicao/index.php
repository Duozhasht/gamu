	<div class="container-fluid">
		<div class="row">
			<div id="header" class="col-xs-12" style="padding-top:30px;padding-bottom:70px;">
				<h2 id="title" class='text-center'>Audições</h2>	
			</div>
		</div> 
	</div>

	<div class="container">
		<div class="col-xs-3"></div>
		<div id="sidebar" class="col-xs-12 col-lg-7" style="padding-top:10px;">
			<ul class="sidebar nav nav-pills" style="padding-bottom: 10px;">
				<li role="presentation" class="normal">
					
					<a href="#" onclick="showModal()">
					<i class="fa fa-plus" style="padding-right: 20px"></i>
						Adicionar
					</a>
				</li>
				<li id="download" role="presentation" class="safe">
					<a href="?controller=audicao&action=exportxml">
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
				</li>
				<li role="presentation" class="warn">
					<a href="#" onclick="inputXML()">
						<i class="fa fa-file-text-o" style="padding-right: 20px"></i>
						Importar XML
					</a>
				</li>
			</ul>
		</div>
		<div class="col-xs-2"></div>
		<div id="content" class="col-xs-12 col-md-12" style="padding-bottom: 50px;">
			<h3 id=title class="text-center">Próximas Audições</h3>
			<table class='table'>
				<thead>
					<tr>
						<th width='5%'>#</th>
						<th width='15%'>Titulo</th>
						<th width='12%'>Sub-Titulo</th>
						<th width='12%'>Tema</th>
						<th width='15%'>Data</th>
						<th width='11%'>Local</th>
						<th width='11%'>Organizador</th>
						<th width='11%'>duracao</th>
						<th width='4%'></th>
						<th width='4%'></th>
					</tr>
				</thead>
				<tbody>
					
					<?php
							foreach ($audicoes_next as $aud)
							{
								echo "<tr class='linkeable' onclick='redirect(".$aud->id.")'>";
								echo "<td>A".$aud->id."</td>";
								echo "<td>".$aud->titulo."</td>";
								echo "<td>".$aud->subtitulo."</td>";
								echo "<td>".$aud->tema."</td>";
								echo "<td>".$aud->data."</td>";
								echo "<td>".$aud->local."</td>";
								echo "<td>".$aud->organizador."</td>";
								echo "<td>".$aud->duracao."</td>";
								echo "<td>
									  <a href='#'><i class='fa fa-pencil-square-o'></i></a>
									  </td>
									  <td>
									  <a href='?controller=audicao&action=remove&id=".$aud->id."'><i class='fa fa-times'></i></a>
									  </td>";
								echo "</tr>";
							}
					?>
				</tbody>
			</table>
		</div>
		<div id="content" class="col-xs-12 col-md-12">
			<h3 id=title class="text-center">Audições Anteriores</h3>
			<table class='table'>
				<thead>
					<tr>
						<th width='5%'>#</th>
						<th width='15%'>Titulo</th>
						<th width='12%'>Sub-Titulo</th>
						<th width='12%'>Tema</th>
						<th width='15%'>Data</th>
						<th width='11%'>Local</th>
						<th width='11%'>Organizador</th>
						<th width='11%'>duracao</th>
						<th width='4%'></th>
						<th width='4%'></th>
					</tr>
				</thead>
				<tbody>
					
					<?php
							foreach ($audicoes_previous as $aud)
							{
								echo "<tr class='linkeable' onclick='redirect(".$aud->id.")'>";
								echo "<td>A".$aud->id."</td>";
								echo "<td>".$aud->titulo."</td>";
								echo "<td>".$aud->subtitulo."</td>";
								echo "<td>".$aud->tema."</td>";
								echo "<td>".$aud->data."</td>";
								echo "<td>".$aud->local."</td>";
								echo "<td>".$aud->organizador."</td>";
								echo "<td>".$aud->duracao."</td>";
								echo "<td>
									  <a href='#'><i class='fa fa-pencil-square-o'></i></a>
									  </td>
									  <td>
									  <a href='?controller=audicao&action=remove&id=".$aud->id."'><i class='fa fa-times'></i></a>
									  </td>";
								echo "</tr>";
							}
					?>
				</tbody>
			</table>
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Adicionar Audição</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form action='?controller=audicao&action=add' method="post" accept-charset="utf-8">
						<div class="col-md-12">
						<h5 style="padding-bottom: 10px;">Meta Dados</h5>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo da Audição">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="subtitulo" name="subtitulo" placeholder="Sub-Titulo da Audição">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="tema" name="tema" placeholder="Tema da Audição">
							</div>
							<div class="form-group">
								<input type="date" class="form-control" id="data" name="data" placeholder="Data da Audição">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="local" name="local" placeholder="Local da Audição">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="organizador" name="organizador" placeholder="Organizador">
							</div>
							<div class="form-group">
								<input type="time" class="form-control" id="duracao" name="duracao" placeholder="Duração">
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
<form action='?controller=audicao&action=importxml' method="post" accept-charset="utf-8">
  <input name="upload" type="file" id="fileinput"/>
</form>
</div>


<script type="text/javascript">
function showModal(){
	$('#insertModal').modal('show');};
function inputXML(){
	$('#fileinput').trigger('click'); 
}
function redirect(id){
	document.location = '?controller=audicao&action=view&id='+id;
}
</script>