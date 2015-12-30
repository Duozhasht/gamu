
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
public class Compositores {
    HashMap<String, Compositor> comps;

    public Compositores() {
        this.comps = new HashMap<>();
    }

    public Compositores(HashMap<String, Compositor> comps) {
        this.comps = comps;
    }

    public HashMap<String, Compositor> getComps() {
        return comps;
    }
    
    public void addCompositor(String id, String nome, String bio, String data_de_nascimento, String data_de_obito, String id_periodo ){
        Compositor cp = new Compositor(nome, bio, data_de_nascimento, data_de_obito, id_periodo);
        this.comps.put(id, cp);
    }
    
    public Compositor getCompositor(String id){
        return this.comps.get(id);
    }
    
    
}
