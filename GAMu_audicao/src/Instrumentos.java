
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
public class Instrumentos {
    
    HashMap<String, String> insts;

    public Instrumentos() {
        this.insts = new HashMap<>();
    }

    public HashMap<String, String> getInsts() {
        return this.insts;
    }
    
    public void addInstrumento(String k, String v){
        this.insts.put(k, v);
    }
    
    public String getIntrumento(String k){
        return this.insts.get(k);
    }
    
    public int getSize(){
        return this.insts.size();
    }
    
}
