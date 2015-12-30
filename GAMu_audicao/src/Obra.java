/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author JRCO
 */
public class Obra {
    String nome;
    String descricao;
    String ano;
    String periodo;
    String compositor;
    String duracao;

    public Obra() {
        this.nome = "";
        this.descricao = "";
        this.ano = "";
        this.periodo = "";
        this.compositor = "";
        this.duracao = "";
    }

    public Obra(String nome, String descricao, String ano, String periodo, String compositor, String duracao) {
        this.nome = nome;
        this.descricao = descricao;
        this.ano = ano;
        this.periodo = periodo;
        this.compositor = compositor;
        this.duracao = duracao;
    }

    public String getAno() {
        return ano;
    }

    public String getCompositor() {
        return compositor;
    }

    public String getDescricao() {
        return descricao;
    }

    public String getDuracao() {
        return duracao;
    }

    public String getNome() {
        return nome;
    }

    public String getPeriodo() {
        return periodo;
    }

    public void setAno(String ano) {
        this.ano = ano;
    }

    public void setCompositor(String compositor) {
        this.compositor = compositor;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public void setDuracao(String duracao) {
        this.duracao = duracao;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public void setPeriodo(String periodo) {
        this.periodo = periodo;
    }
    
}
