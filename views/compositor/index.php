<div class="container">
	<div class="row">
		<div id="sidebar" class="col-xs-12 col-md-2" style="padding-top:100px;">
			<ul class="nav nav-pills nav-stacked">
				<li role="presentation" class="active"><a href="#" onclick="showModal()">Adicionar</a></li>
				<li></li>
				<li id="download" role="presentation"><a href="?controller=professor&action=exportxml">Exportar Professores</a></li>
				<li role="presentation"><a href="#" onclick="inputXML()">Importar Professores</a></li>
			</ul>
		</div>
		<div id="content" class="col-xs-12 col-md-10">
			<h2 id="title" class='text-center'>Professores</h2>
			<!-- Button trigger modal -->
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
							<div class="form-group">
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Professor">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="dataNasc" name="dataNasc" placeholder="Data de Nascimento">
							</div>
							<select class="form-control" name="habilitacoes">
								<?php
									
								?>
								<option value="Default">Default</option>
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
<form action='?controller=compositor&action=importxml' method="post" accept-charset="utf-8">
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