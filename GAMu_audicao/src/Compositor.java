/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author JRCO
 */
public class Compositor {
    String nome;
    String bio;
    String data_de_nascimento;
    String data_de_obito;
    String id_periodo;

    public Compositor() {
        this.nome = "";
        this.bio = "";
        this.data_de_nascimento = "";
        this.data_de_obito = "";
        this.id_periodo = "";
    }

    public Compositor(String nome, String bio, String data_de_nascimento, String data_de_obito, String id_periodo) {
        this.nome = nome;
        this.bio = bio;
        this.data_de_nascimento = data_de_nascimento;
        this.data_de_obito = data_de_obito;
        this.id_periodo = id_periodo;
    }

    public String getNome() {
        return nome;
    }

    public String getBio() {
        return bio;
    }

    public String getData_de_nascimento() {
        return data_de_nascimento;
    }

    public String getData_de_obito() {
        return data_de_obito;
    }

    public String getId_periodo() {
        return id_periodo;
    }

    public void setData_de_nascimento(String data_de_nascimento) {
        this.data_de_nascimento = data_de_nascimento;
    }

    public void setBio(String bio) {
        this.bio = bio;
    }

    public void setData_de_obito(String data_de_obito) {
        this.data_de_obito = data_de_obito;
    }

    public void setId_periodo(String id_periodo) {
        this.id_periodo = id_periodo;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }
   
   
}
