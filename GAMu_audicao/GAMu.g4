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
            int cont = gdb.getDs().getIdAudicao()+1;
            int ats = gdb.getDs().getIdAtuacao()+1;
            int erros = 0;

            //System.out.println("CONT: "+ cont);
            //System.out.println("ATS: "+ ats);
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

             c=audicao[cont, ats, erros, gdb.getDs(),gdb] (audicao[$c.cont2,$c.ats2,$c.erros2,gdb.getDs(),gdb])*
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

audicao[int cont, int ats, int erros, Datasets d, GrammarJDBC gdb]
    returns [int cont2, int ats2, int erros2]
    @init{
      ArrayList<String> intSql = new ArrayList<>();
    }
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
      da=dadosAud[intSql,$cont]
      a=atuacoes[$ats, $erros, $d, $cont, $da.out]
      '.' {
            $ats2 = $a.ats2;
            $erros2 = $a.erros2;
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
            //System.out.println("Erros da audicao: " + $erros2 );
            /*for(String s : $a.out){
              System.out.println(s);
            }*/


            if($erros2 == 0){
              $gdb.carregaAudicao($a.out);
              System.out.println("------------------------------");
              System.out.println("Audição carregada com sucesso!");
            }
            else {
              System.out.println("-------------------------------------------------------");
              System.out.println("Impossivel carregar audição devido à presença de erros!");}
         }
    ;

dadosAud[ArrayList<String> in, int cont]
  returns[ArrayList<String> out]
    : ti=titulo st=subtitulo te=tema da=dataS h=hora l=local o=organizador du=duracaoS
      {
        System.out.println("----------------------------------------");
        System.out.println("|       INFORMAÇÕES DA AUDIÇÃO         |");
        System.out.println("----------------------------------------");
        System.out.println("TITULO: " + $ti.tx.substring(1,$ti.tx.length()-1));
        System.out.println("SUBTITULO: " + $st.tx.substring(1,$st.tx.length()-1));
        System.out.println("TEMA: " + $te.tx.substring(1,$te.tx.length()-1));
        System.out.println("DATA: " + $da.td);
        System.out.println("HORA: " + $h.tx);
        System.out.println("LOCAL: " + $l.tx.substring(1,$l.tx.length()-1));
        System.out.println("ORGANIZADOR: " + $o.tx.substring(1,$o.tx.length()-1));
        System.out.println("DURAÇÃO: " + $du.tx);

        String sql = "INSERT INTO gamu.Audicao VALUES(" +$cont+ ",\'" +
                      $ti.tx.substring(1,$ti.tx.length()-1)+"\',\'"
                      +$st.tx.substring(1,$st.tx.length()-1)+"\',\'"+ $te.tx.substring(1,$te.tx.length()-1)+"\',\'"
                      +$da.td+" "+$h.tx+ ":00\'" +  ",\'" + $l.tx.substring(1,$l.tx.length()-1)+"\',\'"+
                      $o.tx.substring(1,$o.tx.length()-1)+"\',\'"+ $du.tx+"\');";

        //System.out.println(sql);

        $in.add(sql);
        $out = $in;
        PrintWriter pw = null;
        try {
           File file = new File("audicoes.xml");
           FileWriter fw = new FileWriter(file, true);
           pw = new PrintWriter(fw);
           pw.println("<metadados>");
           pw.println("<titulo>"+$ti.tx.substring(1,$ti.tx.length()-1)+"</titulo>");
           pw.println("<subtitulo>"+$st.tx.substring(1,$st.tx.length()-1)+"</subtitulo>");
           pw.println("<tema>"+$te.tx.substring(1,$te.tx.length()-1)+"</tema>");
           pw.println("<data>"+$da.td+"</data>");
           pw.println("<hora>"+$h.tx+"</hora>");
           pw.println("<local>"+$l.tx.substring(1,$l.tx.length()-1)+"</local>");
           pw.println("<organizador>"+$o.tx.substring(1,$o.tx.length()-1)+"</organizador>");
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
                    $tx = "Aviso: O ano da audição já foi ultrapassado";
                } else
                {
                    if(cal.get(Calendar.MONTH)+1 < today.get(Calendar.MONTH)+1)
                    { $tx = "Aviso: O mês da atuação já foi ultrapassado" ;}
                    else
                    {
                        if(cal.get(Calendar.DAY_OF_MONTH) < today.get(Calendar.DAY_OF_MONTH))
                       {$tx = "Aviso: O dia da atuação já foi ultrapassado";}
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

atuacoes[int ats, int erros, Datasets d, int cont, ArrayList<String> in]
    returns [int ats2, int erros2,ArrayList<String> out]
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
    a=atuacao[$ats,$erros,$d,$cont,$in] (b=atuacao[$a.ats2,$a.erros2,$d,$cont,$a.out])*
    {
        if ($b.text != null) {
          $ats2 = $b.ats2;
          $erros2 = $b.erros2;
          $out = $b.out;
        } else {
          $ats2 = $a.ats2;
          $erros2 = $a.erros2;
          $out = $a.out;
        }

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

atuacao[int ats,int erros,Datasets d, int cont, ArrayList<String> in]
    returns [int ats2, int erros2, ArrayList<String> out]
    : 'ATUACAO' desig=NOME ':'
            {   System.out.println("----------------------------------------");
                System.out.println("           ATUAÇÃO: " + $desig.text.substring(1,$desig.text.length()-1) + "       ");
                System.out.println("----------------------------------------");;
                PrintWriter pw = null;
                try {
                   File file = new File("audicoes.xml");
                   FileWriter fw = new FileWriter(file, true);
                   pw = new PrintWriter(fw);
                   pw.println("<atuacao>");
                   pw.println("<idAt>AT"+$ats+"</idAt>");
                   pw.println("<tituloAt>"+$desig.text.substring(1,$desig.text.length()-1)+"</tituloAt>");
                   $ats2 = $ats + 1;
                   String sql = "INSERT INTO gamu.Actuacao VALUES ("+ $ats + "," + $cont + ",\'"
                                    + $desig.text.substring(1,$desig.text.length()-1) + "\');";
                  $in.add(sql);
                  $out = $in;
                	//System.out.println(sql);
                } catch (IOException e) {
                   e.printStackTrace();
                } finally {
                   if (pw != null) {
                      pw.close();
                   }
                }
            }
        o=obras[$d, $erros, $ats, $out]
        {       $erros2 = $o.erros2;
                $out = $o.out;
                pw = null;
                try {
                   $erros2 = $o.erros2;
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
                //System.out.println("ERROS obras: " + $erros2);
        }
    ;

obras[Datasets d, int erros, int ats, ArrayList<String> in]
    returns[int erros2, ArrayList<String> out]
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
    //a=atuacao[$ats,$erros,$d] (b=atuacao[$a.ats2,$a.erros2,$d])*
    o=obra[$d, $erros, $ats, $in] (ob=obra[$d,$o.erros2,$ats,$o.out])*
    {
        pw = null;
        try {
          if ($ob.text != null) {
            $erros2 = $ob.erros2;
            $out = $ob.out;
          } else {
            $erros2 = $o.erros2;
            $out = $o.out;
          }

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

obra[Datasets d, int erros, int ats, ArrayList<String> in]
    returns [int erros2, ArrayList<String> out]
    : 'OBRA' idObra=ID ':'
       {
            $erros2 = $erros;
            PrintWriter pw = null;
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

            String sql = "INSERT INTO gamu.Actuacao_Obra VALUES (" + $ats + "," +
                          $idObra.text.substring(1)+ ");";

            $in.add(sql);
            //System.out.println(sql);

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
            //System.out.println("ERROS obra: " + $erros2);
        }
      dados=dadosObra[$d, $erros, $ats, $idObra.text.substring(1),$in]
        {
            $erros2 = $dados.erros2;
            $out = $dados.out;
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
            //System.out.println("ERROS dadosObra: " + $dados.erros2);
    }
    ;

dadosObra[Datasets d, int erros, int ats, String idOb, ArrayList<String> in]
    returns [int erros2, ArrayList<String> out]
@init {
        ArrayList<String> intrumentos = new ArrayList<String>();
        ArrayList<String> maestros = new ArrayList<String>();
        ArrayList<String> musicos = new ArrayList<String>();
}
    : ins=instrumentos[intrumentos]
        {
            $erros2 = $erros;
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
            //System.out.println("ERROS intrumentos: " + $erros2);
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
                        $erros2++;
                    }
                    else{
                        if($d.getPr().getProfs().containsKey(s) == false){
                            System.out.println("ERRO: O professor com o ID = " + s + " não existe!");
                            $erros2++;
                        }
                        else {
                                pw.println("<maestro>"+s+"</maestro>");
                                System.out.println(">"+$d.getPr().getProfessor(s).getNome()+" ("+s+")");
                                String sql= "INSERT INTO gamu.Participante VALUES (" + $ats + "," + $idOb
                                + "," + s.substring(1) +",NULL);";

                                $in.add(sql);

                                //System.out.println(sql);
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
            //System.out.println("ERROS maestros: " + $erros2);
        }

        mu=musicos[musicos]
        {
            ArrayList<String> instMusicos = new ArrayList<String>();
            ArrayList<String> lerros = new ArrayList<String>();
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

                if(s.startsWith("A") == false){
                    System.out.println("ERRO: O ID = " + s + " não corresponde a um aluno!");
                    $erros2++;
                }
                else{
                        if($d.getAl().getAls().containsKey(s) == false)
                            {System.out.println("ERRO: O aluno com o ID = " + s + " não existe!"); $erros2++;}
                            else {
                                idCurso = $d.getAl().getAluno(s).getCurso();
                                //System.out.println(idCurso);
                                idInst = $d.getCs().getCurso(idCurso.substring(2)).getId_instrumento();
                                instMusicos.add(idInst);

                                pw.println("<musico>"+s+"</musico>");

                                String sql= "INSERT INTO gamu.Participante VALUES (" + $ats + "," + $idOb
                                + ",NULL," + s.substring(1) +");";

                                $in.add(sql);

                                //System.out.println(sql);

                                System.out.println(">"+$d.getAl().getAluno(s).getNome()+" ("+s+")");
                                if($ins.listaOUT.contains(idInst) == false){
                                    lerros.add("Aviso: O aluno com o ID = "+ s
                                        + " não toca nenhum dos instrumentos da lista" );

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

            for(String s : lerros)
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
            //System.out.println("ERROS musicos: " + $erros2);
            $out = $in;
        }
    ;

instrumentos [ArrayList<String> listaIN]
    returns [ArrayList<String> listaOUT]
    : 'INSTRUMENTOS' ':' instrumento1=id[$listaIN]
        { $listaOUT = $instrumento1.out; }

    (',' instrumento2=id[$listaIN])*
    {   if($instrumento2.text != null)
            $listaOUT = $instrumento2.out; 
    }
    ;

maestros [ArrayList<String> listaIN]
    returns [ArrayList<String> listaOUT]
    : 'MAESTROS' ':' idP1=id[$listaIN]
        { $listaOUT = $idP1.out; }
    (',' idP2=id[$listaIN])*
        {   if($idP2.text != null)
                $listaOUT = $idP2.out; 
        }
    ;

musicos [ArrayList<String> listaIN]
    returns [ArrayList<String> listaOUT]
    : 'MUSICOS' ':' idM1=id[$listaIN]
        { $listaOUT = $idM1.out; }
    (',' idM2=id[$listaIN] )*
        {   if($idM2.text != null)
                $listaOUT = $idM2.out; 
        }
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
