/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author JRCO
 */
public class Datasets {

    Professores pr;
    Alunos al;
    Instrumentos in;
    Obras ob;
    Cursos cs;
    Periodos ps;
    Compositores cp;
    int idAudicao;
    int idAtuacao;

    public Datasets() {
        this.pr = new Professores();
        this.al = new Alunos();
        this.in = new Instrumentos();
        this.ob = new Obras();
        this.cs = new Cursos();
        this.ps = new Periodos();
        this.cp = new Compositores();
        this.idAudicao = -1;
        this.idAtuacao = -1;
    }

    public Professores getPr() {
        return pr;
    }

    public Alunos getAl() {
        return this.al;
    }

    public Instrumentos getIn() {
        return this.in;
    }

    public Obras getOb() {
        return this.ob;
    }

    public Cursos getCs() {
        return this.cs;
    }

    public Periodos getPs() {
        return this.ps;
    }

    public Compositores getCp() {
        return this.cp;
    }

    public int getIdAtuacao() {
        return this.idAtuacao;
    }

    public int getIdAudicao() {
        return this.idAudicao;
    }

    public void setIdAtuacao(int idAtuacao) {
        this.idAtuacao = idAtuacao;
    }

    public void setIdAudicao(int idAudicao) {
        this.idAudicao = idAudicao;
    }

    public void setCp(Compositores cp) {
        this.cp = cp;
    }

    public void setPs(Periodos ps) {
        this.ps = ps;
    }

    public void setCs(Cursos cs) {
        this.cs = cs;
    }

    public void setAl(Alunos al) {
        this.al = al;
    }

    public void setIn(Instrumentos in) {
        this.in = in;
    }

    public void setOb(Obras ob) {
        this.ob = ob;
    }

    public void setPr(Professores pr) {
        this.pr = pr;
    }



}
