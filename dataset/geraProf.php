<?php

$base = simplexml_load_file("alunos-old.xml");
$cursos = simplexml_load_file("cursos.xml");
$instrumentos = simplexml_load_file("instrumentos.xml");

$xmlstr = "<?xml version='1.0' encoding='UTF-8'?><professores/>";
$professores = new SimpleXMLElement($xmlstr);

$pcont = 1;

foreach ($base->aluno as $a) {
	$prof = $professores->addChild('professor');
	$prof->addChild('id','p'.$pcont);
	$prof->addChild('nome',$a->nome);
	

	$ano = rand(1945,1992);
	$mes = rand(1,12);
	$dia = rand(1,28);

	$prof->addChild('dataNasc',$ano.'-'.$mes.'-'.$dia);


	$grau = rand(1,2);
	$inst = rand(1,22);
	$ninst = $instrumentos->xpath("/instrumentos/instrumento[".$inst."]")[0];

	if($grau==1)
		$prof->addChild('habilitacoes','Licenciado em '.$ninst);
	else
		$prof->addChild('habilitacoes','Mestre em '.$ninst);


	$pcont++;




}
	$professores->asXML('professores.xml');




?>