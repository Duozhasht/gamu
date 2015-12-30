// Generated from GAMu.g4 by ANTLR 4.5.1

        import java.util.*;
        import java.lang.*;
        import java.text.*;
        import java.io.*;

import org.antlr.v4.runtime.tree.ParseTreeListener;

/**
 * This interface defines a complete listener for a parse tree produced by
 * {@link GAMuParser}.
 */
public interface GAMuListener extends ParseTreeListener {
	/**
	 * Enter a parse tree produced by {@link GAMuParser#audicoes}.
	 * @param ctx the parse tree
	 */
	void enterAudicoes(GAMuParser.AudicoesContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#audicoes}.
	 * @param ctx the parse tree
	 */
	void exitAudicoes(GAMuParser.AudicoesContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#audicao}.
	 * @param ctx the parse tree
	 */
	void enterAudicao(GAMuParser.AudicaoContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#audicao}.
	 * @param ctx the parse tree
	 */
	void exitAudicao(GAMuParser.AudicaoContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#dadosAud}.
	 * @param ctx the parse tree
	 */
	void enterDadosAud(GAMuParser.DadosAudContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#dadosAud}.
	 * @param ctx the parse tree
	 */
	void exitDadosAud(GAMuParser.DadosAudContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#titulo}.
	 * @param ctx the parse tree
	 */
	void enterTitulo(GAMuParser.TituloContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#titulo}.
	 * @param ctx the parse tree
	 */
	void exitTitulo(GAMuParser.TituloContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#subtitulo}.
	 * @param ctx the parse tree
	 */
	void enterSubtitulo(GAMuParser.SubtituloContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#subtitulo}.
	 * @param ctx the parse tree
	 */
	void exitSubtitulo(GAMuParser.SubtituloContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#tema}.
	 * @param ctx the parse tree
	 */
	void enterTema(GAMuParser.TemaContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#tema}.
	 * @param ctx the parse tree
	 */
	void exitTema(GAMuParser.TemaContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#dataS}.
	 * @param ctx the parse tree
	 */
	void enterDataS(GAMuParser.DataSContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#dataS}.
	 * @param ctx the parse tree
	 */
	void exitDataS(GAMuParser.DataSContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#hora}.
	 * @param ctx the parse tree
	 */
	void enterHora(GAMuParser.HoraContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#hora}.
	 * @param ctx the parse tree
	 */
	void exitHora(GAMuParser.HoraContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#local}.
	 * @param ctx the parse tree
	 */
	void enterLocal(GAMuParser.LocalContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#local}.
	 * @param ctx the parse tree
	 */
	void exitLocal(GAMuParser.LocalContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#organizador}.
	 * @param ctx the parse tree
	 */
	void enterOrganizador(GAMuParser.OrganizadorContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#organizador}.
	 * @param ctx the parse tree
	 */
	void exitOrganizador(GAMuParser.OrganizadorContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#duracaoS}.
	 * @param ctx the parse tree
	 */
	void enterDuracaoS(GAMuParser.DuracaoSContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#duracaoS}.
	 * @param ctx the parse tree
	 */
	void exitDuracaoS(GAMuParser.DuracaoSContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#atuacoes}.
	 * @param ctx the parse tree
	 */
	void enterAtuacoes(GAMuParser.AtuacoesContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#atuacoes}.
	 * @param ctx the parse tree
	 */
	void exitAtuacoes(GAMuParser.AtuacoesContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#atuacao}.
	 * @param ctx the parse tree
	 */
	void enterAtuacao(GAMuParser.AtuacaoContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#atuacao}.
	 * @param ctx the parse tree
	 */
	void exitAtuacao(GAMuParser.AtuacaoContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#obras}.
	 * @param ctx the parse tree
	 */
	void enterObras(GAMuParser.ObrasContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#obras}.
	 * @param ctx the parse tree
	 */
	void exitObras(GAMuParser.ObrasContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#obra}.
	 * @param ctx the parse tree
	 */
	void enterObra(GAMuParser.ObraContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#obra}.
	 * @param ctx the parse tree
	 */
	void exitObra(GAMuParser.ObraContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#dadosObra}.
	 * @param ctx the parse tree
	 */
	void enterDadosObra(GAMuParser.DadosObraContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#dadosObra}.
	 * @param ctx the parse tree
	 */
	void exitDadosObra(GAMuParser.DadosObraContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#instrumentos}.
	 * @param ctx the parse tree
	 */
	void enterInstrumentos(GAMuParser.InstrumentosContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#instrumentos}.
	 * @param ctx the parse tree
	 */
	void exitInstrumentos(GAMuParser.InstrumentosContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#maestros}.
	 * @param ctx the parse tree
	 */
	void enterMaestros(GAMuParser.MaestrosContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#maestros}.
	 * @param ctx the parse tree
	 */
	void exitMaestros(GAMuParser.MaestrosContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#musicos}.
	 * @param ctx the parse tree
	 */
	void enterMusicos(GAMuParser.MusicosContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#musicos}.
	 * @param ctx the parse tree
	 */
	void exitMusicos(GAMuParser.MusicosContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#data}.
	 * @param ctx the parse tree
	 */
	void enterData(GAMuParser.DataContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#data}.
	 * @param ctx the parse tree
	 */
	void exitData(GAMuParser.DataContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#duracao}.
	 * @param ctx the parse tree
	 */
	void enterDuracao(GAMuParser.DuracaoContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#duracao}.
	 * @param ctx the parse tree
	 */
	void exitDuracao(GAMuParser.DuracaoContext ctx);
	/**
	 * Enter a parse tree produced by {@link GAMuParser#id}.
	 * @param ctx the parse tree
	 */
	void enterId(GAMuParser.IdContext ctx);
	/**
	 * Exit a parse tree produced by {@link GAMuParser#id}.
	 * @param ctx the parse tree
	 */
	void exitId(GAMuParser.IdContext ctx);
}