/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author JRCO
 */
public class Professor {
    String nome;
    String dataNasc;
    String habilitacoes;
    String curso;

    public Professor() {
        this.nome = "";
        this.dataNasc = "";
        this.habilitacoes = "";
        this.curso = "";
    }

    public Professor(String nome, String dataNasc, String habilitacoes, String curso) {
        this.nome = nome;
        this.dataNasc = dataNasc;
        this.habilitacoes = habilitacoes;
        this.curso = curso;
    }

    public String getCurso() {
        return curso;
    }

    public String getDataNasc() {
        return dataNasc;
    }

    public String getNome() {
        return nome;
    }

    public String getHabilitacoes() {
        return habilitacoes;
    }

    public void setCurso(String curso) {
        this.curso = curso;
    }

    public void setDataNasc(String dataNasc) {
        this.dataNasc = dataNasc;
    }

    public void setHabilitacoes(String habilitacoes) {
        this.habilitacoes = habilitacoes;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }
    
    
    
    
}
