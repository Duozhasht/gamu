/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

grammar GAMu;

@header{
        import java.util.*;
        import java.lang.*;
        import java.text.*;
        import java.io.*;
}

@members{
    
}

audicoes : {
            GrammarJDBC gdb = new GrammarJDBC(); 
            gdb.carregaDataSets(); 
            int cont = 1;
            System.out.println("----------------------------------------");
            System.out.println("|           AUDIÇÕES MUSICAIS           |");
            System.out.println("----------------------------------------");
            
            PrintWriter pw = null;
            try {
                File file = new File("audicoes.xml");
                if(file.exists()) file.delete();
                FileWriter fw = new FileWriter(file, true);
                pw = new PrintWriter(fw);
                pw.println("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
                pw.println("<audicoes>");
             } catch (IOException e) {
                e.printStackTrace();
             } finally {
                if (pw != null) {
                   pw.close();
                }
             }
            }
             
             c=audicao[cont, gdb.getDs()] (audicao[$c.cont2,gdb.getDs()])*
             {
              try {
               File file = new File("audicoes.xml");
               FileWriter fw = new FileWriter(file, true);
               pw = new PrintWriter(fw);
               pw.println("</audicoes>");
            } catch (IOException e) {
               e.printStackTrace();
            } finally {
               if (pw != null) {
                  pw.close();
               }
            }
              }
         ;

audicao[int cont, Datasets d]
    returns [int cont2]
    : 'AUDICAO:'  {
                    PrintWriter pw = null;
                    System.out.println("----------------------------------------");
                    System.out.println("|           AUDIÇÃO " + $cont +"                  |");
                    System.out.println("----------------------------------------");
                    $cont2 = $cont+1;
                    try {
                       File file = new File("audicoes.xml");
                       FileWriter fw = new FileWriter(file, true);
                       pw = new PrintWriter(fw);
                       pw.println("<audicao>");
                       pw.println("<id>AUD" + $cont + "</id>");
                    } catch (IOException e) {
                       e.printStackTrace();
                    } finally {
                       if (pw != null) {
                          pw.close();
                       }
                    }
                   
                   } 
      dadosAud 
      atuacoes[$d] 
      '.' {
            try {
               File file = new File("audicoes.xml");
               FileWriter fw = new FileWriter(file, true);
               pw = new PrintWriter(fw);
               pw.println("</audicao>");
            } catch (IOException e) {
               e.printStackTrace();
            } finally {
               if (pw != null) {
                  pw.close();
               }
            }
           }
    ;

dadosAud
    : ti=titulo st=subtitulo te=tema da=dataS h=hora l=local o=organizador du=duracaoS
      {
        System.out.println("----------------------------------------");
        System.out.println("|       INFORMAÇÕES DA AUDIÇÃO         |");
        System.out.println("----------------------------------------");
        System.out.println("TITULO: " + $ti.tx);
        System.out.println("SUBTITULO: " + $st.tx);
        System.out.println("TEMA: " + $te.tx);
        System.out.println("DATA: " + $da.td);
        System.out.println("HORA: " + $h.tx);
        System.out.println("LOCAL: " + $l.tx);
        System.out.println("ORGANIZADOR: " + $o.tx);
        System.out.println("DURAÇÃO: " + $du.tx);
        
        PrintWriter pw = null;
        try {
           File file = new File("audicoes.xml");
           FileWriter fw = new FileWriter(file, true);
           pw = new PrintWriter(fw);
           pw.println("<metadados>");
           pw.println("<titulo>"+$ti.tx+"</titulo>");
           pw.println("<subtitulo>"+$st.tx+"</subtitulo>");
           pw.println("<tema>"+$te.tx+"</tema>");
           pw.println("<data>"+$da.td+"</data>");
           pw.println("<hora>"+$h.tx+"</hora>");
           pw.println("<local>"+$l.tx+"</local>");
           pw.println("<organizador>"+$o.tx+"</organizador>");
           pw.println("<duracao>"+$du.tx+"</duracao>");
           pw.println("</metadados>");
           if ($da.tx.equals("")== false)
            System.out.println($da.tx);
        } catch (IOException e) {
           e.printStackTrace();
        } finally {
           if (pw != null) {
              pw.close();
           }
        }
       }
        
    ; 

titulo
    returns [String tx]
    : 'TITULO' ':' tit=NOME {$tx = $tit.text;}
    ;

subtitulo 
    returns [String tx]
    : 'SUBTITULO' ':' subtit=NOME {$tx = $subtit.text;}
    ;

tema
    returns [String tx]
    : 'TEMA' ':' vtema=NOME {$tx = $vtema.text;}
    ;

dataS
    returns [String tx, String td]
    : 'DATA' ':' d=data 
      {
        $tx = "";
        $td = $d.dt;
        try {
                Calendar today = new GregorianCalendar();
                //System.out.println("HOJE "+today.get(Calendar.YEAR)+"|"+today.get(Calendar.MONTH)+"|"+today.get(Calendar.DAY_OF_MONTH));
		String data = $d.dt;
		SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
		Calendar cal = Calendar.getInstance();
		cal.setTime(sdf.parse(data));
                //System.out.println("DIA :"+cal.get(Calendar.YEAR)+"|"+cal.get(Calendar.MONTH)+"|"+cal.get(Calendar.DAY_OF_MONTH));
                if(cal.get(Calendar.YEAR) < today.get(Calendar.YEAR))
                {
                    $tx = "ERRO: O ano da audição já foi ultrapassado";
                } else
                {
                    if(cal.get(Calendar.MONTH)+1 < today.get(Calendar.MONTH)+1)
                    { $tx = "ERRO: O mês da atuação já foi ultrapassado" ;}
                    else
                    {
                        if(cal.get(Calendar.DAY_OF_MONTH) < today.get(Calendar.DAY_OF_MONTH))
                       {$tx = "ERRO: O dia da atuação já foi ultrapassado";}
                    }
                 
                 }
                
	} catch (ParseException e) {
		e.printStackTrace();
	}
       }
    ;

hora
    returns [String tx]
    : 'HORA' ':' vhora=HORA {$tx = $vhora.text;}
    ;

local 
    returns [String tx]
    : 'LOCAL' ':' vlocal=NOME {$tx = $vlocal.text;}
    ;

organizador
    returns [String tx]
    : 'ORGANIZADOR' ':' vorganizador=NOME {$tx = $vorganizador.text;}
    ;

duracaoS 
    returns [String tx]
    : 'DURACAO' ':' vduracao=duracao {$tx = $vduracao.text;}
    ;

atuacoes[Datasets d]
    : {
        System.out.println("----------------------------------------");
        System.out.println("|           LISTA DE ATUAÇÕES          | ");
        System.out.println("----------------------------------------");
        PrintWriter pw = null;
        try {
           File file = new File("audicoes.xml");
           FileWriter fw = new FileWriter(file, true);
           pw = new PrintWriter(fw);
           pw.println("<atuacoes>");
        } catch (IOException e) {
           e.printStackTrace();
        } finally {
           if (pw != null) {
              pw.close();
           }
        }
    }
    atuacao[$d]+
    {
        pw = null;
        try {
           File file = new File("audicoes.xml");
           FileWriter fw = new FileWriter(file, true);
           pw = new PrintWriter(fw);
           pw.println("</atuacoes>");
        } catch (IOException e) {
           e.printStackTrace();
        } finally {
           if (pw != null) {
              pw.close();
           }
        }
    }
    ;

atuacao[Datasets d] 
    : 'ATUACAO' idAt=ID ':' 
            {   System.out.println("----------------------------------------");
                System.out.println("|           ATUAÇÃO: " + $idAt.text + "               |");
                System.out.println("----------------------------------------");;
                PrintWriter pw = null;
                try {
                   File file = new File("audicoes.xml");
                   FileWriter fw = new FileWriter(file, true);
                   pw = new PrintWriter(fw);
                    pw.println("<atuacao>");
                   pw.println("<idAt>"+$idAt.text+"</idAt>");
                } catch (IOException e) {
                   e.printStackTrace();
                } finally {
                   if (pw != null) {
                      pw.close();
                   }
                }
            }
        obras[$d]
        {   pw = null;
                try {
                   File file = new File("audicoes.xml");
                   FileWriter fw = new FileWriter(file, true);
                   pw = new PrintWriter(fw);
                   pw.println("</atuacao>");
                } catch (IOException e) {
                   e.printStackTrace();
                } finally {
                   if (pw != null) {
                      pw.close();
                   }
                }
            }
    ;

obras[Datasets d]
    : { 
        System.out.println("-------------------------");
        System.out.println("|    LISTA DE OBRAS     |");
        System.out.println("-------------------------");
        PrintWriter pw = null;
        try {
           File file = new File("audicoes.xml");
           FileWriter fw = new FileWriter(file, true);
           pw = new PrintWriter(fw);
           pw.println("<obras>");
        } catch (IOException e) {
           e.printStackTrace();
        } finally {
           if (pw != null) {
              pw.close();
           }
        }
    }
    obra[$d]+
    { 
        pw = null;
        try {
           File file = new File("audicoes.xml");
           FileWriter fw = new FileWriter(file, true);
           pw = new PrintWriter(fw);
           pw.println("</obras>");
        } catch (IOException e) {
           e.printStackTrace();
        } finally {
           if (pw != null) {
              pw.close();
           }
        }
    }
    ;

obra[Datasets d]
    : 'OBRA' idObra=ID ':'
       {    PrintWriter pw = null;  
            System.out.println("---------------");
            System.out.println("|    OBRA     |");
            System.out.println("---------------");
            
            /*System.out.println("OBRA: "+ $idObra.text + " (\"" +
            $d.getOb().getObra($idObra.text).getNome() + "\"" + " - "  
            + "nome compositor" + 
            $d.getCp().getCompositor($d.getOb().getObra($idObra.text).getCompositor()).getNome() + ")");*/
            
            System.out.println("Id: "+ $idObra.text);
            System.out.println("Titulo: " + $d.getOb().getObra($idObra.text).getNome());
            System.out.println("Compositor: " + $d.getCp().getCompositor($d.getOb().getObra($idObra.text).getCompositor()).getNome());                
            
            try {
               File file = new File("audicoes.xml");
               FileWriter fw = new FileWriter(file, true);
               pw = new PrintWriter(fw);
               pw.println("<obra>");
               pw.println("<idOb>"+$idObra.text+"</idOb>");
            } catch(IOException e){
                e.printStackTrace();
            } finally {
               if (pw != null) {
                  pw.close();
               }
            }
        } 
      dadosObra[$d]  
        { 
            pw = null;
            try {
               File file = new File("audicoes.xml");
               FileWriter fw = new FileWriter(file, true);
               pw = new PrintWriter(fw);
            } catch (IOException e) {
               e.printStackTrace();
            } finally {
               if (pw != null) {
                  pw.close();
               }
            }
    }
    ;

dadosObra[Datasets d]
@init { 
        ArrayList<String> intrumentos = new ArrayList<String>(); 
        ArrayList<String> maestros = new ArrayList<String>();
        ArrayList<String> musicos = new ArrayList<String>();
}
    :  ins=instrumentos[intrumentos] 
        {   
            System.out.println("-----------------------");
            System.out.println("|LISTA DE INSTRUMENTOS|");
            System.out.println("-----------------------");
            //for(String s : $ins.listaOUT)System.out.print(s+",");
            PrintWriter pw = null;
            try {
                File file = new File("audicoes.xml");
                FileWriter fw = new FileWriter(file, true);
                pw = new PrintWriter(fw);
                pw.println("<instrumentos>");
                for (String s: $ins.listaOUT)
                {
                    if($d.getIn().getInsts().containsKey(s) == false)
                        {System.out.println("ERRO: O instrumento " + s + " não existe!");}
                    else {
                        pw.println("<instrumento>"+s+"</instrumento>");
                        System.out.println(">"+$d.getIn().getIntrumento(s)+" ("+s+")");    
                    }
                }
                pw.println("</instrumentos>");
            }catch (IOException e) {
               e.printStackTrace();
            } finally {
               if (pw != null) {
                  pw.close();
               }
            }
        }
        ms=maestros[maestros] 
        {
            System.out.println("-------------------");
            System.out.println("|LISTA DE MAESTROS|");
            System.out.println("-------------------");
            //for(String s : $ms.listaOUT)System.out.print(s+",");
            pw = null;
            try {
                File file = new File("audicoes.xml");
                FileWriter fw = new FileWriter(file, true);
                pw = new PrintWriter(fw);
                pw.println("<maestros>");
                for(String s : $ms.listaOUT)
                {
                    if(s.contains("P") == false){
                        System.out.println("ERRO: O ID = " + s + " não corresponde a um professor!");
                    }
                    else{
                        if($d.getPr().getProfs().containsKey(s) == false)
                            System.out.println("ERRO: O professor com o ID = " + s + " não existe!");
                        else {
                                pw.println("<maestro>"+s+"</maestro>");
                                System.out.println(">"+$d.getPr().getProfessor(s).getNome()+" ("+s+")");
                            }
                    }
                }
                pw.println("</maestros>");
            }catch (IOException e) {
               e.printStackTrace();
            } finally {
               if (pw != null) {
                  pw.close();
               }
            }
        }    

        mu=musicos[musicos]
        {   
            ArrayList<String> instMusicos = new ArrayList<String>();
            ArrayList<String> erros = new ArrayList<String>();
            String idCurso = "";
            String idInst = "";
            pw = null;
            System.out.println("------------------");
            System.out.println("|LISTA DE MUSICOS|");
            System.out.println("------------------");
            try {
                File file = new File("audicoes.xml");
                FileWriter fw = new FileWriter(file, true);
                pw = new PrintWriter(fw);
                pw.println("<musicos>");
            for(String s : $mu.listaOUT)
            {
                if(s.startsWith("P") == false && s.startsWith("A") == false){
                    System.out.println("ERRO: O ID = " + s + " não corresponde a um professor nem a um aluno!");
                }
                else{
                        if(s.startsWith("P") == true){
                            if($d.getPr().getProfs().containsKey(s) == false)
                            {System.out.println("ERRO: O professor com o ID = " + s + " não existe!");}
                            else {
                                    pw.println("<musico>"+s+"</musico>");
                                    idCurso = $d.getPr().getProfessor(s).getCurso();
                                    idInst = $d.getCs().getCurso(idCurso.substring(2)).getId_instrumento();
                                    //System.out.println(idCurso);
                                    instMusicos.add(idInst);
                                    //System.out.println($d.getCs().getCurso(idCurso.substring(2)).getId_instrumento());
                                    System.out.println(">"+$d.getPr().getProfessor(s).getNome()+" ("+s+")");
                                    if($ins.listaOUT.contains(idInst) == false){
                                        erros.add("Aviso: O professor com o ID = "+ s 
                                            + " não toca nenhum dos instrumentos da lista" );
                                    }
                                }
                            
                        }
                        if(s.startsWith("A") == true){
                            if($d.getAl().getAls().containsKey(s) == false)
                                {System.out.println("ERRO: O aluno com o ID = " + s + " não existe!");}
                                else {
                                    idCurso = $d.getAl().getAluno(s).getCurso();
                                    //System.out.println(idCurso);
                                    idInst = $d.getCs().getCurso(idCurso.substring(2)).getId_instrumento();
                                    instMusicos.add(idInst);
                                    
                                    pw.println("<musico>"+s+"</musico>");
                                    System.out.println(">"+$d.getAl().getAluno(s).getNome()+" ("+s+")");
                                    if($ins.listaOUT.contains(idInst) == false){
                                        erros.add("Aviso: O aluno com o ID = "+ s 
                                            + " não toca nenhum dos instrumentos da lista" );
                                    }
                                }
                        }
                    }   
            }
            for(String s: $ins.listaOUT){
                if(instMusicos.contains(s) == false){
                    System.out.println("Aviso: O instrumento com o ID = " + s
                        + " não tem nenhum músico que o toque");
                }
            }
            
            for(String s : erros)
                System.out.println(s);
            
  
            pw.println("</musicos>");
            pw.println("</obra>");
            }catch (IOException e) {
               e.printStackTrace();
            } finally {
               if (pw != null) {
                  pw.close();
               }
            }
        }
    ;

instrumentos [ArrayList<String> listaIN]
    returns [ArrayList<String> listaOUT]
    : 'INSTRUMENTOS' ':' instrumento1=id[$listaIN] 
        { $listaOUT = $instrumento1.out; }

    (',' instrumento2=id[$listaIN])*
    { $listaOUT = $instrumento2.out; }
    ;

maestros [ArrayList<String> listaIN]
    returns [ArrayList<String> listaOUT]
    : 'MAESTROS' ':' idP1=id[$listaIN] 
        { $listaOUT = $idP1.out; }
    (',' idP2=id[$listaIN])*
        { $listaOUT = $idP2.out; }   
    ;

musicos [ArrayList<String> listaIN]
    returns [ArrayList<String> listaOUT]
    : 'MUSICOS' ':' idM1=id[$listaIN] 
        { $listaOUT = $idM1.out; }
    (',' idM2=id[$listaIN] )*
        { $listaOUT = $idM2.out; }
    ;

data
    returns [String dt]
    :
     d=DATA {$dt = $d.text;}
    ;

duracao
    :
    DURACAO
    ;

id [ArrayList<String> in]
    returns [ArrayList<String> out]
    : varID=ID {
                if($in.contains($varID.text) == false) $in.add($varID.text);
                $out = $in;
            }
    ;

/*--------------- Lexer ---------------------------------------*/
NOME:	STRING
	;

PAL : [a-zA-Z]+
    ;

DATA:   ANO '-' MES '-' DIA
    ;

fragment
MES: '0'..'9'+
   ;

fragment
DIA: '0'..'9'+
   ;

ANO: [0-9]+
   ;

ID : [a-zA-Z'-''_'0-9]+
   ;     

HORA: HORAS ':' MINUTOS
    ;

DURACAO: HORAS ':' MINUTOS ':' SEGUNDOS
    ;

SEGUNDOS: '0' .. '9'+
        ;

fragment
HORAS: '0'..'9'+
    ;

fragment
MINUTOS: '0'..'9'+
       ;
      
      
INT :	'0'..'9'+
    ;

WS  :   [ \t\r\n]  -> skip
    ;
    
fragment
STRING
    :  '"' ( ESC_SEQ | ~('"') )* '"'
    ;

fragment
ESC_SEQ
    :   '\\' ('b'|'t'|'n'|'f'|'r'|'\"'|'\''|'\\')
    |   UNICODE_ESC
    |   OCTAL_ESC
    ;

fragment
OCTAL_ESC
    :   '\\' ('0'..'3') ('0'..'7') ('0'..'7')
    |   '\\' ('0'..'7') ('0'..'7')
    |   '\\' ('0'..'7')
    ;

fragment
UNICODE_ESC
    :   '\\' 'u' HEX_DIGIT HEX_DIGIT HEX_DIGIT HEX_DIGIT
    ;
fragment
HEX_DIGIT : ('0'..'9'|'a'..'f'|'A'..'F') 
    ;