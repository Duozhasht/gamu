	<div class="container-fluid">
	<div class="row">
		<div id="header" class="col-xs-12" style="padding-top:30px;padding-bottom:70px;">
			<h2 id="title" class='text-center'>Instrumentos</h2>	
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
					<a href="?controller=instrumento&action=exportxml">
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
		<div id="content" class="col-xs-12 col-md-5">
			<!-- Button trigger modal -->
			<table class='table'>
				<thead>
					<tr>
						<th width='5%'>#</th>
						<th width='87%'>Designação</th>
						<th width='4%'></th>
						<th width='4%'></th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					$c = 0;
					$total = count($instrumentos);

							foreach ($instrumentos as $instrumento)
							{
								echo "<tr>";
								echo "<td>I".$instrumento->id."</td>";
								echo "<td>".$instrumento->nome."</td>";
								echo "<td>
									  <a href='#'><i class='fa fa-pencil-square-o'></i></a>
									  </td>
									  <td>
									  <a href='?controller=instrumento&action=remove&id=".$instrumento->id."'><i class='fa fa-times'></i></a>
									  </td>";
								echo "</tr>";
								$c++;
								if($c>ceil($total/2)-1)
									break;
							}
					?>
				</tbody>
			</table>
		</div>
		<div id="content" class="col-xs-12 col-md-5">
			<!-- Button trigger modal -->
			<table class='table'>
				<thead>
					<tr>
						<th width='5%'>#</th>
						<th width='87%'>Designação</th>
						<th width='4%'></th>
						<th width='4%'></th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					$c = 0;
					$total = count($instrumentos);

							foreach ($instrumentos as $instrumento)
							{
								$c++;
								if($c<=ceil($total/2))
									continue;

								echo "<tr>";
								echo "<td>I".$instrumento->id."</td>";
								echo "<td>".$instrumento->nome."</td>";
								echo "<td>
									  <a href='#'><i class='fa fa-pencil-square-o'></i></a>
									  </td>
									  <td>
									  <a href='?controller=instrumento&action=remove&id=".$instrumento->id."'><i class='fa fa-times'></i></a>
									  </td>";
								echo "</tr>";
								

							}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Adicionar Instrumento</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form action='?controller=instrumento&action=add' method="post" accept-charset="utf-8">
				
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="designacao" name="designacao" placeholder="Nome do Instrumento">
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
	$('#insertModal').modal('show');};
function inputXML(){
	$('#fileinput').trigger('click'); 
}
</script>