<div id="home" class="container">
	

	<div class="row">
		<div class="col-xs-12" style="padding-bottom: 150px;">
		<h1 class="title text-center">GAMμ - Gestor de Audições Músicais</h1>
		</div>
		<div class="col-xs-12 col-md-6">
			<h3 class="text-center" style="padding-top: 20px;padding-bottom: 40px;">
				Próximas Audições
			</h3>
			<table class='table'>
				<thead>
					<tr>
						<th width='35%'>Titulo</th>
						<th width='30%'>Data</th>
						<th width='15%'>Local</th>
						<th width='15%'>Duração</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
							foreach ($audicoes_next as $aud)
							{
								echo "<tr class='linkeable' onclick='redirect(".$aud->id.")'>";
								echo "<td>".$aud->titulo."</td>";
								echo "<td>".$aud->data."</td>";
								echo "<td>".$aud->local."</td>";
								echo "<td>".$aud->duracao."</td>";
								echo "</tr>";
							}
					?>
				</tbody>
			</table>
		</div>

		<div class="col-xs-12 col-md-6 text-center"style="padding-top: 10px;">
		<div class="row">
			<div class="col-xs-6" style="padding-top: 20px;padding-bottom: 40px;">
				<h4 id="title">Total de Cursos</h4>
				<p style="font-size: 16px;">12 cursos</p>
			</div>
			<div class="col-xs-6" style="padding-top: 20px;padding-bottom: 40px;">
				<h4 id="title">Total de Alunos</h4>
				<p style="font-size: 16px;">12 alunos</p>
			</div>
			<div class="col-xs-12" style="padding-top: 20px;padding-bottom: 40px;">
			<h4 id="title">Total de Professores</h4>
			<p style="font-size: 16px;">12 professores</p>
			</div>
		</div>

		</div>

	</div>


	<div id="gestao" class="row">
		<div class="col-xs-12">
			<h3 class="text-center" style="padding-top: 20px;padding-bottom: 40px;">
				Gestão da Escola
			</h3>
			<div class="col-xs-4 col-md-2 text-center" style="padding-bottom: 20px;">
				<a href="?controller=professor&action=index">
					<i class="fa fa-users fa-3x"></i>
					<h4>Professores</h4>
				</a>
			</div>
			<div class="col-xs-4 col-md-2 text-center" style="padding-bottom: 20px;">
				<a href="?controller=curso&action=index">
					<i class="fa fa-graduation-cap fa-3x"></i>
					<h4>Cursos</h4>
				</a>
			</div>
			<div class="col-xs-4 col-md-2 text-center" style="padding-bottom: 20px;">
				<a href="?controller=instrumento&action=index">
					<i class="fa fa-music fa-3x"></i>
					<h4>Instrumentos</h4>
				</a>
			</div>
			<div class="col-xs-4 col-md-2 text-center" style="padding-bottom: 20px;">
				<a href="?controller=aluno&action=index">
					<i class="fa fa-users fa-3x"></i>
					<h4>Alunos</h4>
				</a>
			</div>
			<div class="col-xs-4 col-md-2 text-center" style="padding-bottom: 20px;">
				<a href="?controller=compositor&action=index">
					<i class="fa fa-graduation-cap fa-3x"></i>
					<h4>Compositores</h4>
				</a>
			</div>
			<div class="col-xs-4 col-md-2 text-center" style="padding-bottom: 20px;">
				<a href="?controller=obra&action=index">
					<i class="fa fa-graduation-cap fa-3x"></i>
					<h4>Obras</h4>
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function redirect(id){
	document.location = '?controller=audicao&action=view&id='+id;
}
</script>