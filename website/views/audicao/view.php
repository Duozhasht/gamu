	<div class="container-fluid">
		<div class="row">
			<div id="header" class="col-xs-12" style="padding-top:30px;padding-bottom:70px;">
				<h2 id="title" class='text-center'>Audição <?php echo $audicao->id; ?></h2>
			</div>
		</div> 
	</div>

	<div class="container">
		<div id="content" class="col-xs-12 col-md-12">
			<!-- Button trigger modal -->
					<?php
						$counter=1;
      					foreach($actuacoes as $actuacao)
      					{
        					
        					echo "<h3 class='text-center' style='padding-bottom:50px;'>".$counter."º - ".$actuacao->designacao."</h3>";
        					
 					       foreach($actuacao->actos as $acto)
 					       {
 					       		echo "<div class='row' style='padding-bottom:50px;'>";
 					       		echo "<div class='col-md-4'>";
 					       		echo "<h4 id='title'>Obra</h5>";
 					        	echo "<p>".$acto['obra']->nome."</p>";
								echo "</div>";
								echo "<div class='col-md-4'>";
 					            echo "<h4 id='title'>Maestros</h5>";
 					            foreach($acto['participantes']['maestros'] as $ma)
 					            {
 					              echo "<p>".$ma->nome."</p>";
 					              echo "<p style='font-size:12px;'><strong>".$ma->instrumento."</strong></p>";
 					            }
 					            echo "</div>";
					 			echo "<div class='col-md-4'>";
 					            echo "<h4 id='title'>Musicos</h5>";
 					            foreach($acto['participantes']['musicos'] as $mu)
 					            {
 					              echo "<p>".$mu->nome."</p>";
 					              echo "<p style='font-size:10px;'><strong>".$mu->instrumento."</strong></p>";
 					            }
 					            echo "</div>";
 					            echo "</div>";
 					      	}
 					         
 					         $counter++;
 					     }
							
					?>
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
function redirect(id){
	document.location = '?controller=audicao&action=view&id='+id;
}
</script>