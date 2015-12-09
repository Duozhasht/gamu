
<?php
    
    $base = simplexml_load_file("../Originais/alunos.xml");
    $cursos = simplexml_load_file("../Finais/cursos.xml");
    $instrumentos = simplexml_load_file("../Finais/instrumentos.xml");
    
    $xmlstr = "<?xml version='1.0' encoding='UTF-8'?><professores/>";
    $professores = new SimpleXMLElement($xmlstr);

    $pcont = 1;
    foreach($base->aluno as $a)
    {
        $professor = $professores->addChild('professor');
        $professor->addAttribute('id',"P".$pcont);
        $professor->addChild('nome',$a->nome); 
        
        $ano = rand(1945,1992);
        $mes = rand(1,12);
        $dia = rand(1,28);
        $professor->addChild('dataNasc',$ano."-".$mes."-".$dia);



        if($pcont<23)
        {
            $inst = $pcont;
            $nInst = $instrumentos->xpath("//instrumento[".$inst."]")[0];
            $professor->addChild('habilitacoes',"Licenciatura");
            $professor->addChild('curso',$pcont);
        }
        else
        {
            $inst = $pcont-22;
            $nInst = $instrumentos->xpath("//instrumento[".$inst."]")[0];
            $professor->addChild('habilitacoes',"Mestrado");
            $professor->addChild('curso',$pcont);
        }

        

        $pcont++;

        if($pcont==45){
            break;
        }

    }
    
    $professores->asXML("../Finais/professores.xml");
?>