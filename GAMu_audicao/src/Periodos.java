
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
public class Periodos {
    HashMap<String, Periodo> periodos;

    public Periodos() {
        this.periodos = new HashMap<>();
    }

    public Periodos(HashMap<String, Periodo> periodos) {
        this.periodos = periodos;
    }

    public HashMap<String, Periodo> getPeriodos() {
        return this.periodos;
    }
    
    public String getPeriodo(String id){
        return this.periodos.get(id).getNome();
    }
    
    public void addPeriodo(String id, String valor){
        Periodo p = new Periodo(valor);
        this.periodos.put(id, p);
    }
    
    
}
