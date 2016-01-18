/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author JRCO
 */
import java.sql.*;
import java.util.*;
import java.lang.*;

public class GrammarJDBC {

    String JDBC_DRIVER = "com.mysql.jdbc.Driver";
    String DB_URL = "jdbc:mysql://localhost:8889/gamu";
    String USER = "root";
    String PASS = "root";

    Datasets ds;

    public Datasets getDs() {
        return this.ds;
    }

    public void carregaDataSets(){
        this.ds = new Datasets();
	try{
            Connection conn = null;
	    Statement stmt = null;

	    Class.forName(JDBC_DRIVER);
	    System.out.println("Connecting to database...");

	    conn = DriverManager.getConnection(DB_URL,USER,PASS);

	    System.out.println("Creating statement...");
            System.out.println("--------------------------");
            System.out.println("--------------------------");
	    stmt = conn.createStatement();
	    String sql;

            /* CARREGA CURSOS */
            sql = "SELECT * FROM curso";
            ResultSet rs = stmt.executeQuery(sql);

            while(rs.next()){
                //Retrieve by column name
                this.ds.getCs().addCurso(""+rs.getInt("id_curso"),
                        rs.getNString("designacao"), ""+rs.getInt("duracao"),
                        "I"+rs.getInt("id_instrumento"));
            }
            rs.close();

            //-------------------------------------------------------------------//
             /* CARREGA INSTRUMENTOS */
            sql = "SELECT * FROM instrumento";
            rs = stmt.executeQuery(sql);

            while(rs.next()){
                //Retrieve by column name
                this.ds.getIn().addInstrumento("I"+rs.getInt("id_instrumento"),
                        rs.getNString("nome"));
            }

            rs.close();

            //-------------------------------------------------------------------//
            /* CARREGA PERIODOS */
            sql = "SELECT * FROM periodo";
            rs = stmt.executeQuery(sql);

            while(rs.next()){
                //Retrieve by column name
                this.ds.getPs().addPeriodo("PE"+rs.getInt("id_periodo"),
                        rs.getNString("nome"));
            }

            rs.close();

            //-------------------------------------------------------------------//

            /* CARREGA PROFESSORES */
	    sql = "SELECT * FROM professor";
	    rs = stmt.executeQuery(sql);

	    while(rs.next()){
                //Retrieve by column name
                String curso = ""+rs.getInt("id_curso");
                if(this.ds.getCs().getCurso(curso).getDesignacao().contains("Basico")){
                    this.ds.getPr().addProfessor("P"+rs.getInt("id_professor"),
                        rs.getNString("nome"),""+rs.getDate("data_de_nascimento"),
                        rs.getNString("habilitacoes"),"CB"+curso);
                }
                else {
                    this.ds.getPr().addProfessor("P"+rs.getInt("id_professor"),
                        rs.getNString("nome"),""+rs.getDate("data_de_nascimento"),
                        rs.getNString("habilitacoes"),"CS"+curso);
                }

	    }
            rs.close();

            //-------------------------------------------------------------------//
            /* CARREGA ALUNOS */
	    sql = "SELECT * FROM aluno";
	    rs = stmt.executeQuery(sql);

	    while(rs.next()){
                //Retrieve by column name
                String curso = ""+rs.getInt("id_curso");
                if(this.ds.getCs().getCurso(curso).getDesignacao().contains("Basico")){
                    this.ds.getAl().addAluno("A"+rs.getInt("id_aluno"), rs.getNString("nome"),
                            ""+rs.getDate("data_de_nascimento"), "CB"+curso,
                            ""+rs.getInt("ano_curso"));
                }
                else {
                    this.ds.getAl().addAluno("A"+rs.getInt("id_aluno"), rs.getNString("nome"),
                            ""+rs.getDate("data_de_nascimento"), "CS"+curso,
                            ""+rs.getInt("ano_curso"));
                }
	    }
            rs.close();

            //-------------------------------------------------------------------//
            /* CARREGA COMPOSITORES */
	    sql = "SELECT * FROM COMPOSITOR";
	    rs = stmt.executeQuery(sql);

	    while(rs.next()){
                //Retrieve by column name
                this.ds.getCp().addCompositor("C"+rs.getInt("id_compositor"),
                        rs.getNString("nome"), "",
                        "",
                        "", "PE"+rs.getInt("id_periodo") );
            }
            rs.close();

            //-------------------------------------------------------------------//
            /* CARREGA OBRAS */
            sql = "SELECT * FROM obra";
            rs = stmt.executeQuery(sql);

            while(rs.next()){
                //Retrieve by column name
                /*this.ds.getOb().addObra("O"+rs.getInt("id_obra"),
                        rs.getNString("nome"), "",
                        rs.getNString("ano"), "PE"+rs.getInt("periodo"),
                        "C"+rs.getInt("id_compositor"), ""+rs.getTime("duracao"));*/
                this.ds.getOb().addObra("O"+rs.getInt("id_obra"),
                        rs.getNString("nome"), "",
                        rs.getNString("ano"), "PE"+rs.getInt("id_periodo"),
                        "C"+rs.getInt("id_compositor"), ""+rs.getTime("duracao"));
            }

            //-------------------------------------------------------------------//
            /* CARREGA ULTIMO ID AUDICOES */
            sql = "SELECT id_audicao FROM Audicao ORDER BY id_audicao DESC LIMIT 1";
            rs = stmt.executeQuery(sql);

            if(rs.next()){
                this.ds.setIdAudicao((int)rs.getObject("id_audicao"));
                //System.out.println("Audicao JDBC: " + (int)rs.getObject("id_audicao"));
            }



            //-------------------------------------------------------------------//
            /* CARREGA ULTIMO ID ATUACOES */
            sql = "SELECT id_actuacao FROM Actuacao ORDER BY id_actuacao DESC LIMIT 1";
            rs = stmt.executeQuery(sql);

            if(rs.next()){
                this.ds.setIdAtuacao((int)rs.getObject("id_actuacao"));
                //System.out.println("Atuacao JDBC: " + (int)rs.getObject("id_actuacao"));
            }
            rs.close();

            stmt.close();
            conn.close();

        }catch(ClassNotFoundException | SQLException e){
                e.printStackTrace();
            }
        }

    public void carregaAudicao(ArrayList<String> sqls){
        try{
            Connection conn = null;
	    Statement stmt = null;

	    Class.forName(JDBC_DRIVER);
	    //System.out.println("Connecting to database...");

	    conn = DriverManager.getConnection(DB_URL,USER,PASS);

	    //System.out.println("Creating statement...");
            //System.out.println("--------------------------");
            //System.out.println("--------------------------");
	    stmt = conn.createStatement();
	    String sql;

            /* CARREGA CURSOS */
            for(String s : sqls){
                stmt.executeUpdate(s);
            }

            stmt.close();
            conn.close();

        } catch(ClassNotFoundException | SQLException e){
                e.printStackTrace();
            }
    }

}
