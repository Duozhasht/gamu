
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
public class Obras {
    HashMap<String, Obra> obras;

    public Obras() {
        this.obras = new HashMap<>();
    }
    
    public void addObra(String id, String nome, String descricao, String ano, String periodo, String id_compositor, String duracao ){
        Obra ob = new Obra(nome, descricao, ano, periodo, id_compositor, duracao);
        this.obras.put(id, ob);
    }
    
    public Obra getObra(String k){
        return this.obras.get(k);
    }
    
    
}
