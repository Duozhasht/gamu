/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


import java.text.ParseException;
import org.antlr.v4.runtime.ANTLRFileStream;
import org.antlr.v4.runtime.CommonTokenStream;
import org.antlr.v4.runtime.ParserRuleContext;
import org.antlr.v4.runtime.TokenStream;
import org.antlr.v4.runtime.tree.ParseTreeWalker;

/**
 *
 * @author Rangedz
 */
public class GAMu {

    /**
     * @param args the command line arguments
     * @throws java.text.ParseException
     */
    public static void main(String[] args) throws ParseException {
        try{
            // Get our lexer
            GAMuLexer lexer = new GAMuLexer(new ANTLRFileStream("audicao.txt"));

            // Get a list of matched tokens
            TokenStream tokens = new CommonTokenStream(lexer);

            // Pass the tokens to the parser
            GAMuParser parser = new GAMuParser(tokens);

            // Specify our entry point
            ParserRuleContext context = parser.audicoes();

            // Walk it and attach our listener
            ParseTreeWalker walker = new ParseTreeWalker();
            //GAMuListener listener = new AntlrGAMuListener();
            //walker.walk(listener, context);
            //System.out.println("Acabou");
        }
        catch(Exception e){
            e.printStackTrace();
        }
    }
    
}
