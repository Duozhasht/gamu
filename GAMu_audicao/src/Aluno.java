/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author JRCO
 */
public class Aluno {
    String nome;
    String dataNasc;
    String curso;
    String anoCurso;

    public Aluno(){
        this.nome = "";
        this.dataNasc = "";
        this.curso = "";
        this.anoCurso = "";
    }
    
    public Aluno(String nome, String dataNasc, String curso, String anoCurso) {
        this.nome = nome;
        this.dataNasc = dataNasc;
        this.curso = curso;
        this.anoCurso = anoCurso;
    }
    
    public String getNome() {
        return nome;
    }

    public String getAnoCurso() {
        return anoCurso;
    }

    public String getCurso() {
        return curso;
    }

    public String getDataNasc() {
        return dataNasc;
    }

    public void setAnoCurso(String anoCurso) {
        this.anoCurso = anoCurso;
    }

    public void setCurso(String curso) {
        this.curso = curso;
    }

    public void setDataNasc(String dataNasc) {
        this.dataNasc = dataNasc;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }
    
    
}
