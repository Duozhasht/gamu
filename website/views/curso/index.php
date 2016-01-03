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
								echo "<td>C".$curso->id."</td>";
								echo "<td>".$curso->designacao."</td>";
								echo "<td class='text-center'>".$curso->duracao." anos</td>";
								if(isset($curso->professor))
									echo "<td>".$curso->professor."</td>";
								else
									echo "<td style='color: #d9534f;'>Sem Professor</td>";
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