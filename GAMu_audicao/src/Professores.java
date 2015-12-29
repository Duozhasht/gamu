
import java.util.HashMap;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author JRCO
 */
public class Professores {
    HashMap<String, Professor> profs;

    public Professores() {
        this.profs = new HashMap<>();
    }

    public HashMap<String, Professor> getProfs() {
        return this.profs;
    }

    public void addProfessor(String id, String nome, String dataNasc, String habilacoes, String curso){
        Professor pr = new Professor(nome, dataNasc, habilacoes, curso);
        this.profs.put(id, pr);
    }

    public Professor getProfessor(String k) {
        return this.profs.get(k);
    }
    
    public int getSize(){
        return this.profs.size();
    }

    
}
