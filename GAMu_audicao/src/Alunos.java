
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

public class Alunos {
    HashMap<String, Aluno> alunos;
   
    public Alunos(){
        this.alunos = new HashMap<>();
    }
    
    public HashMap<String, Aluno> getAls() {
        return this.alunos;
    }
    
   public void addAluno(String id, String nome, String dataNasc, String curso, String anoCurso){
       Aluno al = new Aluno(nome, dataNasc, curso, anoCurso);
       this.alunos.put(id, al);
   }
    
    public Aluno getAluno(String k) {
        return this.alunos.get(k);
    }
    
    public int getSize(){
        return this.alunos.size();
    }
    
}
