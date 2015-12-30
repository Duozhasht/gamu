
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
public class Cursos {
    HashMap<String, Curso> cursos;

    public Cursos() {
        this.cursos = new HashMap<>();
    }

    public HashMap<String, Curso> getCursos() {
        return cursos;
    }
    
    public Curso getCurso(String id){
        return this.cursos.get(id);
    }
    
    public void addCurso(String id, String designacao, String duracao, String id_instrumento){
        Curso c = new Curso(designacao, duracao, id_instrumento);
        this.cursos.put(id, c);
    }
    
    public int getSize(){
        return this.cursos.size();
    }
    
    
}
