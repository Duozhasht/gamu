	<div class="container-fluid">
		<div class="row">
			<div id="header" class="col-xs-12" style="padding-top:30px;padding-bottom:70px;">
				<h2 id="title" class='text-center'><?php echo $audicao->titulo; ?></h2>
				<h4 id="title" class='text-center'><?php echo $audicao->subtitulo; ?></h4>
			</div>
		</div> 
	</div>

	<div class="container" >
	<div class="col-xs-12" style="font-size: 16px; padding-top:20px;">	
		<div class="col-xs-12 text-center" style="padding-bottom: 50px;">
			<div class="col-xs-3">
				<p id='title'><strong>Data:</strong></p>
			</div>
			<div class="col-xs-3" style="color: black;">
				<p><strong><?php echo $audicao->data; ?></strong></p>
			</div>
			<div class="col-xs-3">
				<p id='title'><strong>Local:</strong></p>
			</div>
			<div class="col-xs-3" style="color: black;">
				<p><strong><?php echo $audicao->local; ?></strong></p>
			</div>
			<div class="col-xs-3">
				<p id='title'><strong>Organizador:</strong></p>
			</div>
			<div class="col-xs-3" style="color: black;">
				<p><strong><?php echo $audicao->organizador; ?></strong></p>
			</div>
			<div class="col-xs-3">
				<p id='title'><strong>Duração:</strong></p>
			</div>
			<div class="col-xs-3" style="color: black;">
				<p><strong><?php echo $audicao->duracao; ?></strong></p>
			</div>
		</div>
	</div>
	<div class="col-xs-5"></div>

		<div class="col-xs-4"></div>
		<div id="content" class="col-xs-12 col-md-12">
			<!-- Button trigger modal -->
					<?php
						$counter=1;
      					foreach($actuacoes as $actuacao)
      					{
        					
        					echo "<h3 class='text-center' style='padding-bottom:30px;'>".$counter."º Actuação: ".$actuacao->designacao."</h3>";

        					
 					       foreach($actuacao->actos as $acto)
 					       {
 					       		echo "<div class='row' style='padding-top: 30px; padding-bottom:30px;'>";
 					       		echo "<div class='col-md-4'>";
								echo "<h4 id='title'>Obra</h5>";
								echo "<div class='row'>";
 					            echo "<div class='col-xs-10'>";
 					        	echo "<p style='font-size:16px;''>".$acto['obra']->nome."</p>";
								echo "</div>
 					              	    <div class='col-xs-2'>
 					              	    </div>
 					              	    </div>";
 					            echo "</div>";
								echo "<div class='col-md-4'>";
 					            echo "<h4 id='title'>Maestros</h5>";
 					            foreach($acto['participantes']['maestros'] as $ma)
 					            {
 					              echo "<div class='row'>";
 					              echo "<div class='col-xs-10'>";
								  echo "<p style='margin: 0px;'>".$ma->nome."</p>";
 					              echo "<p style='font-size:11px;'><strong>".$ma->instrumento."</strong></p>";
 					              echo "</div>
 					              	    <div class='col-xs-2'>

 					              	    </div>
 					              	    </div>";


 					            }
 					            echo "</div>";
					 			echo "<div class='col-md-4'>";
 					            echo "<h4 id='title'>Musicos</h5>";
 					            foreach($acto['participantes']['musicos'] as $mu)
 					            {
 					              echo "<div class='row'>";
 					              echo "<div class='col-xs-10'>";
								  echo "<p style='margin: 0px;'>".$mu->nome."</p>";
 					              echo "<p style='font-size:11px;'><strong>".$mu->instrumento."</strong></p>";
 					              echo "</div>
 					              	    <div class='col-xs-2'>

 					              	    </div>
 					              	    </div>";


 					            }
 					            echo "</div>";
 					            echo "</div>";
 					             					         
 					      	}

 					         

 					         echo "<hr>";

 					         $counter++;
 					     }
							
					?>
		</div>
	</div>


<script type="text/javascript">
var nr_maestros = 1;
var nr_musicos = 1;
var nr_obras = 1;

function showModal(){
	$('#insertModal').modal('show');
};

function showupdateMaestro(id_actuacao,id_audicao,id_obra){
	$('#id_actuacaoM').val(id_actuacao);
	$('#id_audicaoM').val(id_audicao);
	$('#id_obraM').val(id_obra);
	$('#updateMaestro').modal('show');
	
}


function showupdateMusico(id_actuacao,id_audicao,id_obra){
	$('#id_actuacaoMu').val(id_actuacao);
	$('#id_audicaoMu').val(id_audicao);
	$('#id_obraMu').val(id_obra);
	$('#updateMusico').modal('show');
	
}

function showupdateObra(id_actuacao,id_audicao){
	$('#id_actuacaoO').val(id_actuacao);
	$('#id_audicaoO').val(id_audicao);
	$('#updateObra').modal('show');
	
}

function addMaestro2(){
	nr_maestros=nr_maestros+1;
	var aux = $('#maestros').clone().html();
	var aux2 = "<div id='m"+(nr_maestros)+"'><div class='col-xs-11'>";
	var aux3 = "</div><div class='col-xs-1'><a href='#' onclick='closeMaestro("+(nr_maestros)+")'><i class='fa fa-times'></i></a></div></div>";
	$('#maestrosu').append(aux2+"<select id='maestros' class='form-control' name='ids_maestro[]'>"+aux+"</select>"+aux3);
}

function addMusico2(){
	nr_musicos=nr_musicos+1;
	var aux = $('#musicos').clone().html();
	var aux2 = "<div id='mu"+(nr_musicos)+"'><div class='col-xs-11'>";
	var aux3 = "</div><div class='col-xs-1'><a href='#' onclick='closeMusico("+(nr_musicos)+")'><i class='fa fa-times'></i></a></div></div>";
	$('#musicosu').append(aux2+"<select id='musicos' class='form-control' name='ids_musico[]'>"+aux+"</select>"+aux3);
}



function inputXML(){
	$('#fileinput').trigger('click'); 
}
function redirect(id){
	document.location = '?controller=audicao&action=view&id='+id;
}

function addObra(){
	nr_obras = nr_obras+1;
	nr_musicos = nr_musicos+1;
	nr_maestros = nr_maestros+1;

	var obras = $('#obras').clone().html();
	var maestros = $('#maestros').clone().html();
	var musicos = $('#musicos').clone().html();

	var first = "<div class='col-md-12'><hr><h5 class='text-center'>Obra "+nr_obras+"</h5><div class='row'><div id='addMaestro' class='col-xs-4 col-xs-offset-2' style='padding-top: 10px;padding-bottom: 10px;'><button onclick='addMaestro("+nr_obras+")' type='button' class='btn btn-default'>Adicionar Maestro</button></div><div id='addMusico' class='col-xs-6' style='padding-top: 10px;padding-bottom: 20px;'><button onclick='addMusico("+nr_obras+")' type='button' class='btn btn-default'>Adicionar Músico</button></div></div><h5>Titulo da Obra</h5><select id='obras' class='form-control' name='id_obra[]'>";

	var second = "</select><h5>Maestros</h5><div id='maestros"+nr_obras+"'><div id='m"+nr_maestros+"' style='padding-top: 10px;padding-bottom: 10px;'><div class='col-xs-11'><select id='maestros' class='form-control' name='ids_maestro["+(nr_obras-1)+"][]'>";

	var third = "</select></div><div class='col-xs-1'><a href='#' ><i class='fa fa-times'></i></a></div></div></div><h5>Músicos</h5><div id='musicos"+nr_obras+"'><div id='mu"+nr_musicos+"'><div class='col-xs-11'><select id='musicos' class='form-control' name='ids_musico["+(nr_obras-1)+"][]'>";

	var fourth = "</select></div><div class='col-xs-1'><a href='#'><i class='fa fa-times'></i></a></div></div></div></div>";

	$('#obrass').append(first+obras+second+maestros+third+musicos+fourth);


}

function addMaestro(id){
	nr_maestros=nr_maestros+1;
	var aux = $('#maestros').clone().html();
	var aux2 = "<div id='m"+(nr_maestros)+"'><div class='col-xs-11'>";
	var aux3 = "</div><div class='col-xs-1'><a href='#' onclick='closeMaestro("+(nr_maestros)+")'><i class='fa fa-times'></i></a></div></div>";
	$('#maestros'+id).append(aux2+"<select id='maestros' class='form-control' name='ids_maestro["+(nr_obras-1)+"][]'>"+aux+"</select>"+aux3);
}

function addMusico(id){
	nr_musicos=nr_musicos+1;
	var aux = $('#musicos').clone().html();
	var aux2 = "<div id='mu"+(nr_musicos)+"'><div class='col-xs-11'>";
	var aux3 = "</div><div class='col-xs-1'><a href='#' onclick='closeMusico("+(nr_musicos)+")'><i class='fa fa-times'></i></a></div></div>";
	$('#musicos'+id).append(aux2+"<select id='musicos' class='form-control' name='ids_musico["+(nr_obras-1)+"][]'>"+aux+"</select>"+aux3);
}

function closeMaestro(id){
	$('#m'+id).remove();
}

function closeMusico(id){
	$('#mu'+id).remove();
}

$('#nvbar').remove();

</script>
						