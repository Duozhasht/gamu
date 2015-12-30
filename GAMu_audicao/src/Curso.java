/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author JRCO
 */
public class Curso {
    String designacao;
    String duracao;
    String id_instrumento;

    public Curso() {
        this.designacao = "";
        this.duracao = "";
        this.id_instrumento = "";
    }

    public Curso(String designacao, String duracao, String id_instrumento) {
        this.designacao = designacao;
        this.duracao = duracao;
        this.id_instrumento = id_instrumento;
    }

    public String getDesignacao() {
        return designacao;
    }

    public String getDuracao() {
        return duracao;
    }

    public String getId_instrumento() {
        return id_instrumento;
    }

    public void setDesignacao(String designacao) {
        this.designacao = designacao;
    }

    public void setDuracao(String duracao) {
        this.duracao = duracao;
    }

    public void setId_instrumento(String id_instrumento) {
        this.id_instrumento = id_instrumento;
    }
  
}
