// Generated from GAMu.g4 by ANTLR 4.5.1

        import java.util.*;
        import java.lang.*;
        import java.text.*;
        import java.io.*;

import org.antlr.v4.runtime.atn.*;
import org.antlr.v4.runtime.dfa.DFA;
import org.antlr.v4.runtime.*;
import org.antlr.v4.runtime.misc.*;
import org.antlr.v4.runtime.tree.*;
import java.util.List;
import java.util.Iterator;
import java.util.ArrayList;

@SuppressWarnings({"all", "warnings", "unchecked", "unused", "cast"})
public class GAMuParser extends Parser {
	static { RuntimeMetaData.checkVersion("4.5.1", RuntimeMetaData.VERSION); }

	protected static final DFA[] _decisionToDFA;
	protected static final PredictionContextCache _sharedContextCache =
		new PredictionContextCache();
	public static final int
		T__0=1, T__1=2, T__2=3, T__3=4, T__4=5, T__5=6, T__6=7, T__7=8, T__8=9, 
		T__9=10, T__10=11, T__11=12, T__12=13, T__13=14, T__14=15, T__15=16, T__16=17, 
		NOME=18, PAL=19, DATA=20, ANO=21, ID=22, HORA=23, DURACAO=24, SEGUNDOS=25, 
		INT=26, WS=27;
	public static final int
		RULE_audicoes = 0, RULE_audicao = 1, RULE_dadosAud = 2, RULE_titulo = 3, 
		RULE_subtitulo = 4, RULE_tema = 5, RULE_dataS = 6, RULE_hora = 7, RULE_local = 8, 
		RULE_organizador = 9, RULE_duracaoS = 10, RULE_atuacoes = 11, RULE_atuacao = 12, 
		RULE_obras = 13, RULE_obra = 14, RULE_dadosObra = 15, RULE_instrumentos = 16, 
		RULE_maestros = 17, RULE_musicos = 18, RULE_data = 19, RULE_duracao = 20, 
		RULE_id = 21;
	public static final String[] ruleNames = {
		"audicoes", "audicao", "dadosAud", "titulo", "subtitulo", "tema", "dataS", 
		"hora", "local", "organizador", "duracaoS", "atuacoes", "atuacao", "obras", 
		"obra", "dadosObra", "instrumentos", "maestros", "musicos", "data", "duracao", 
		"id"
	};

	private static final String[] _LITERAL_NAMES = {
		null, "'AUDICAO:'", "'.'", "'TITULO'", "':'", "'SUBTITULO'", "'TEMA'", 
		"'DATA'", "'HORA'", "'LOCAL'", "'ORGANIZADOR'", "'DURACAO'", "'ATUACAO'", 
		"'OBRA'", "'INSTRUMENTOS'", "','", "'MAESTROS'", "'MUSICOS'"
	};
	private static final String[] _SYMBOLIC_NAMES = {
		null, null, null, null, null, null, null, null, null, null, null, null, 
		null, null, null, null, null, null, "NOME", "PAL", "DATA", "ANO", "ID", 
		"HORA", "DURACAO", "SEGUNDOS", "INT", "WS"
	};
	public static final Vocabulary VOCABULARY = new VocabularyImpl(_LITERAL_NAMES, _SYMBOLIC_NAMES);

	/**
	 * @deprecated Use {@link #VOCABULARY} instead.
	 */
	@Deprecated
	public static final String[] tokenNames;
	static {
		tokenNames = new String[_SYMBOLIC_NAMES.length];
		for (int i = 0; i < tokenNames.length; i++) {
			tokenNames[i] = VOCABULARY.getLiteralName(i);
			if (tokenNames[i] == null) {
				tokenNames[i] = VOCABULARY.getSymbolicName(i);
			}

			if (tokenNames[i] == null) {
				tokenNames[i] = "<INVALID>";
			}
		}
	}

	@Override
	@Deprecated
	public String[] getTokenNames() {
		return tokenNames;
	}

	@Override

	public Vocabulary getVocabulary() {
		return VOCABULARY;
	}

	@Override
	public String getGrammarFileName() { return "GAMu.g4"; }

	@Override
	public String[] getRuleNames() { return ruleNames; }

	@Override
	public String getSerializedATN() { return _serializedATN; }

	@Override
	public ATN getATN() { return _ATN; }


	    

	public GAMuParser(TokenStream input) {
		super(input);
		_interp = new ParserATNSimulator(this,_ATN,_decisionToDFA,_sharedContextCache);
	}
	public static class AudicoesContext extends ParserRuleContext {
		public AudicaoContext c;
		public List<AudicaoContext> audicao() {
			return getRuleContexts(AudicaoContext.class);
		}
		public AudicaoContext audicao(int i) {
			return getRuleContext(AudicaoContext.class,i);
		}
		public AudicoesContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_audicoes; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterAudicoes(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitAudicoes(this);
		}
	}

	public final AudicoesContext audicoes() throws RecognitionException {
		AudicoesContext _localctx = new AudicoesContext(_ctx, getState());
		enterRule(_localctx, 0, RULE_audicoes);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{

			            GrammarJDBC gdb = new GrammarJDBC(); 
			            gdb.carregaDataSets(); 
			            int cont = 1;
			            System.out.println("----------------------------------------");
			            System.out.println("|           AUDIÇÕES MUSICAIS           |");
			            System.out.println("----------------------------------------");
			            
			            PrintWriter pw = null;
			            try {
			                File file = new File("audicoes.xml");
			                if(file.exists()) file.delete();
			                FileWriter fw = new FileWriter(file, true);
			                pw = new PrintWriter(fw);
			                pw.println("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
			                pw.println("<audicoes>");
			             } catch (IOException e) {
			                e.printStackTrace();
			             } finally {
			                if (pw != null) {
			                   pw.close();
			                }
			             }
			            
			setState(45);
			((AudicoesContext)_localctx).c = audicao(cont, gdb.getDs());
			setState(49);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__0) {
				{
				{
				setState(46);
				audicao(((AudicoesContext)_localctx).c.cont2,gdb.getDs());
				}
				}
				setState(51);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}

			              try {
			               File file = new File("audicoes.xml");
			               FileWriter fw = new FileWriter(file, true);
			               pw = new PrintWriter(fw);
			               pw.println("</audicoes>");
			            } catch (IOException e) {
			               e.printStackTrace();
			            } finally {
			               if (pw != null) {
			                  pw.close();
			               }
			            }
			              
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class AudicaoContext extends ParserRuleContext {
		public int cont;
		public Datasets d;
		public int cont2;
		public DadosAudContext dadosAud() {
			return getRuleContext(DadosAudContext.class,0);
		}
		public AtuacoesContext atuacoes() {
			return getRuleContext(AtuacoesContext.class,0);
		}
		public AudicaoContext(ParserRuleContext parent, int invokingState) { super(parent, invokingState); }
		public AudicaoContext(ParserRuleContext parent, int invokingState, int cont, Datasets d) {
			super(parent, invokingState);
			this.cont = cont;
			this.d = d;
		}
		@Override public int getRuleIndex() { return RULE_audicao; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterAudicao(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitAudicao(this);
		}
	}

	public final AudicaoContext audicao(int cont,Datasets d) throws RecognitionException {
		AudicaoContext _localctx = new AudicaoContext(_ctx, getState(), cont, d);
		enterRule(_localctx, 2, RULE_audicao);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(54);
			match(T__0);

			                    PrintWriter pw = null;
			                    System.out.println("----------------------------------------");
			                    System.out.println("|           AUDIÇÃO " + _localctx.cont +"                  |");
			                    System.out.println("----------------------------------------");
			                    ((AudicaoContext)_localctx).cont2 =  _localctx.cont+1;
			                    try {
			                       File file = new File("audicoes.xml");
			                       FileWriter fw = new FileWriter(file, true);
			                       pw = new PrintWriter(fw);
			                       pw.println("<audicao>");
			                       pw.println("<id>AUD" + _localctx.cont + "</id>");
			                    } catch (IOException e) {
			                       e.printStackTrace();
			                    } finally {
			                       if (pw != null) {
			                          pw.close();
			                       }
			                    }
			                   
			                   
			setState(56);
			dadosAud();
			setState(57);
			atuacoes(_localctx.d);
			setState(58);
			match(T__1);

			            try {
			               File file = new File("audicoes.xml");
			               FileWriter fw = new FileWriter(file, true);
			               pw = new PrintWriter(fw);
			               pw.println("</audicao>");
			            } catch (IOException e) {
			               e.printStackTrace();
			            } finally {
			               if (pw != null) {
			                  pw.close();
			               }
			            }
			           
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class DadosAudContext extends ParserRuleContext {
		public TituloContext ti;
		public SubtituloContext st;
		public TemaContext te;
		public DataSContext da;
		public HoraContext h;
		public LocalContext l;
		public OrganizadorContext o;
		public DuracaoSContext du;
		public TituloContext titulo() {
			return getRuleContext(TituloContext.class,0);
		}
		public SubtituloContext subtitulo() {
			return getRuleContext(SubtituloContext.class,0);
		}
		public TemaContext tema() {
			return getRuleContext(TemaContext.class,0);
		}
		public DataSContext dataS() {
			return getRuleContext(DataSContext.class,0);
		}
		public HoraContext hora() {
			return getRuleContext(HoraContext.class,0);
		}
		public LocalContext local() {
			return getRuleContext(LocalContext.class,0);
		}
		public OrganizadorContext organizador() {
			return getRuleContext(OrganizadorContext.class,0);
		}
		public DuracaoSContext duracaoS() {
			return getRuleContext(DuracaoSContext.class,0);
		}
		public DadosAudContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_dadosAud; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterDadosAud(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitDadosAud(this);
		}
	}

	public final DadosAudContext dadosAud() throws RecognitionException {
		DadosAudContext _localctx = new DadosAudContext(_ctx, getState());
		enterRule(_localctx, 4, RULE_dadosAud);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(61);
			((DadosAudContext)_localctx).ti = titulo();
			setState(62);
			((DadosAudContext)_localctx).st = subtitulo();
			setState(63);
			((DadosAudContext)_localctx).te = tema();
			setState(64);
			((DadosAudContext)_localctx).da = dataS();
			setState(65);
			((DadosAudContext)_localctx).h = hora();
			setState(66);
			((DadosAudContext)_localctx).l = local();
			setState(67);
			((DadosAudContext)_localctx).o = organizador();
			setState(68);
			((DadosAudContext)_localctx).du = duracaoS();

			        System.out.println("----------------------------------------");
			        System.out.println("|       INFORMAÇÕES DA AUDIÇÃO         |");
			        System.out.println("----------------------------------------");
			        System.out.println("TITULO: " + ((DadosAudContext)_localctx).ti.tx);
			        System.out.println("SUBTITULO: " + ((DadosAudContext)_localctx).st.tx);
			        System.out.println("TEMA: " + ((DadosAudContext)_localctx).te.tx);
			        System.out.println("DATA: " + ((DadosAudContext)_localctx).da.td);
			        System.out.println("HORA: " + ((DadosAudContext)_localctx).h.tx);
			        System.out.println("LOCAL: " + ((DadosAudContext)_localctx).l.tx);
			        System.out.println("ORGANIZADOR: " + ((DadosAudContext)_localctx).o.tx);
			        System.out.println("DURAÇÃO: " + ((DadosAudContext)_localctx).du.tx);
			        
			        PrintWriter pw = null;
			        try {
			           File file = new File("audicoes.xml");
			           FileWriter fw = new FileWriter(file, true);
			           pw = new PrintWriter(fw);
			           pw.println("<metadados>");
			           pw.println("<titulo>"+((DadosAudContext)_localctx).ti.tx+"</titulo>");
			           pw.println("<subtitulo>"+((DadosAudContext)_localctx).st.tx+"</subtitulo>");
			           pw.println("<tema>"+((DadosAudContext)_localctx).te.tx+"</tema>");
			           pw.println("<data>"+((DadosAudContext)_localctx).da.td+"</data>");
			           pw.println("<hora>"+((DadosAudContext)_localctx).h.tx+"</hora>");
			           pw.println("<local>"+((DadosAudContext)_localctx).l.tx+"</local>");
			           pw.println("<organizador>"+((DadosAudContext)_localctx).o.tx+"</organizador>");
			           pw.println("<duracao>"+((DadosAudContext)_localctx).du.tx+"</duracao>");
			           pw.println("</metadados>");
			           if (((DadosAudContext)_localctx).da.tx.equals("")== false)
			            System.out.println(((DadosAudContext)_localctx).da.tx);
			        } catch (IOException e) {
			           e.printStackTrace();
			        } finally {
			           if (pw != null) {
			              pw.close();
			           }
			        }
			       
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class TituloContext extends ParserRuleContext {
		public String tx;
		public Token tit;
		public TerminalNode NOME() { return getToken(GAMuParser.NOME, 0); }
		public TituloContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_titulo; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterTitulo(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitTitulo(this);
		}
	}

	public final TituloContext titulo() throws RecognitionException {
		TituloContext _localctx = new TituloContext(_ctx, getState());
		enterRule(_localctx, 6, RULE_titulo);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(71);
			match(T__2);
			setState(72);
			match(T__3);
			setState(73);
			((TituloContext)_localctx).tit = match(NOME);
			((TituloContext)_localctx).tx =  (((TituloContext)_localctx).tit!=null?((TituloContext)_localctx).tit.getText():null);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class SubtituloContext extends ParserRuleContext {
		public String tx;
		public Token subtit;
		public TerminalNode NOME() { return getToken(GAMuParser.NOME, 0); }
		public SubtituloContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_subtitulo; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterSubtitulo(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitSubtitulo(this);
		}
	}

	public final SubtituloContext subtitulo() throws RecognitionException {
		SubtituloContext _localctx = new SubtituloContext(_ctx, getState());
		enterRule(_localctx, 8, RULE_subtitulo);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(76);
			match(T__4);
			setState(77);
			match(T__3);
			setState(78);
			((SubtituloContext)_localctx).subtit = match(NOME);
			((SubtituloContext)_localctx).tx =  (((SubtituloContext)_localctx).subtit!=null?((SubtituloContext)_localctx).subtit.getText():null);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class TemaContext extends ParserRuleContext {
		public String tx;
		public Token vtema;
		public TerminalNode NOME() { return getToken(GAMuParser.NOME, 0); }
		public TemaContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_tema; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterTema(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitTema(this);
		}
	}

	public final TemaContext tema() throws RecognitionException {
		TemaContext _localctx = new TemaContext(_ctx, getState());
		enterRule(_localctx, 10, RULE_tema);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(81);
			match(T__5);
			setState(82);
			match(T__3);
			setState(83);
			((TemaContext)_localctx).vtema = match(NOME);
			((TemaContext)_localctx).tx =  (((TemaContext)_localctx).vtema!=null?((TemaContext)_localctx).vtema.getText():null);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class DataSContext extends ParserRuleContext {
		public String tx;
		public String td;
		public DataContext d;
		public DataContext data() {
			return getRuleContext(DataContext.class,0);
		}
		public DataSContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_dataS; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterDataS(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitDataS(this);
		}
	}

	public final DataSContext dataS() throws RecognitionException {
		DataSContext _localctx = new DataSContext(_ctx, getState());
		enterRule(_localctx, 12, RULE_dataS);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(86);
			match(T__6);
			setState(87);
			match(T__3);
			setState(88);
			((DataSContext)_localctx).d = data();

			        ((DataSContext)_localctx).tx =  "";
			        ((DataSContext)_localctx).td =  ((DataSContext)_localctx).d.dt;
			        try {
			                Calendar today = new GregorianCalendar();
			                //System.out.println("HOJE "+today.get(Calendar.YEAR)+"|"+today.get(Calendar.MONTH)+"|"+today.get(Calendar.DAY_OF_MONTH));
					String data = ((DataSContext)_localctx).d.dt;
					SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
					Calendar cal = Calendar.getInstance();
					cal.setTime(sdf.parse(data));
			                //System.out.println("DIA :"+cal.get(Calendar.YEAR)+"|"+cal.get(Calendar.MONTH)+"|"+cal.get(Calendar.DAY_OF_MONTH));
			                if(cal.get(Calendar.YEAR) < today.get(Calendar.YEAR))
			                {
			                    ((DataSContext)_localctx).tx =  "ERRO: O ano da audição já foi ultrapassado";
			                } else
			                {
			                    if(cal.get(Calendar.MONTH)+1 < today.get(Calendar.MONTH)+1)
			                    { ((DataSContext)_localctx).tx =  "ERRO: O mês da atuação já foi ultrapassado" ;}
			                    else
			                    {
			                        if(cal.get(Calendar.DAY_OF_MONTH) < today.get(Calendar.DAY_OF_MONTH))
			                       {((DataSContext)_localctx).tx =  "ERRO: O dia da atuação já foi ultrapassado";}
			                    }
			                 
			                 }
			                
				} catch (ParseException e) {
					e.printStackTrace();
				}
			       
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class HoraContext extends ParserRuleContext {
		public String tx;
		public Token vhora;
		public TerminalNode HORA() { return getToken(GAMuParser.HORA, 0); }
		public HoraContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_hora; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterHora(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitHora(this);
		}
	}

	public final HoraContext hora() throws RecognitionException {
		HoraContext _localctx = new HoraContext(_ctx, getState());
		enterRule(_localctx, 14, RULE_hora);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(91);
			match(T__7);
			setState(92);
			match(T__3);
			setState(93);
			((HoraContext)_localctx).vhora = match(HORA);
			((HoraContext)_localctx).tx =  (((HoraContext)_localctx).vhora!=null?((HoraContext)_localctx).vhora.getText():null);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class LocalContext extends ParserRuleContext {
		public String tx;
		public Token vlocal;
		public TerminalNode NOME() { return getToken(GAMuParser.NOME, 0); }
		public LocalContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_local; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterLocal(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitLocal(this);
		}
	}

	public final LocalContext local() throws RecognitionException {
		LocalContext _localctx = new LocalContext(_ctx, getState());
		enterRule(_localctx, 16, RULE_local);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(96);
			match(T__8);
			setState(97);
			match(T__3);
			setState(98);
			((LocalContext)_localctx).vlocal = match(NOME);
			((LocalContext)_localctx).tx =  (((LocalContext)_localctx).vlocal!=null?((LocalContext)_localctx).vlocal.getText():null);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class OrganizadorContext extends ParserRuleContext {
		public String tx;
		public Token vorganizador;
		public TerminalNode NOME() { return getToken(GAMuParser.NOME, 0); }
		public OrganizadorContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_organizador; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterOrganizador(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitOrganizador(this);
		}
	}

	public final OrganizadorContext organizador() throws RecognitionException {
		OrganizadorContext _localctx = new OrganizadorContext(_ctx, getState());
		enterRule(_localctx, 18, RULE_organizador);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(101);
			match(T__9);
			setState(102);
			match(T__3);
			setState(103);
			((OrganizadorContext)_localctx).vorganizador = match(NOME);
			((OrganizadorContext)_localctx).tx =  (((OrganizadorContext)_localctx).vorganizador!=null?((OrganizadorContext)_localctx).vorganizador.getText():null);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class DuracaoSContext extends ParserRuleContext {
		public String tx;
		public DuracaoContext vduracao;
		public DuracaoContext duracao() {
			return getRuleContext(DuracaoContext.class,0);
		}
		public DuracaoSContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_duracaoS; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterDuracaoS(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitDuracaoS(this);
		}
	}

	public final DuracaoSContext duracaoS() throws RecognitionException {
		DuracaoSContext _localctx = new DuracaoSContext(_ctx, getState());
		enterRule(_localctx, 20, RULE_duracaoS);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(106);
			match(T__10);
			setState(107);
			match(T__3);
			setState(108);
			((DuracaoSContext)_localctx).vduracao = duracao();
			((DuracaoSContext)_localctx).tx =  (((DuracaoSContext)_localctx).vduracao!=null?_input.getText(((DuracaoSContext)_localctx).vduracao.start,((DuracaoSContext)_localctx).vduracao.stop):null);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class AtuacoesContext extends ParserRuleContext {
		public Datasets d;
		public List<AtuacaoContext> atuacao() {
			return getRuleContexts(AtuacaoContext.class);
		}
		public AtuacaoContext atuacao(int i) {
			return getRuleContext(AtuacaoContext.class,i);
		}
		public AtuacoesContext(ParserRuleContext parent, int invokingState) { super(parent, invokingState); }
		public AtuacoesContext(ParserRuleContext parent, int invokingState, Datasets d) {
			super(parent, invokingState);
			this.d = d;
		}
		@Override public int getRuleIndex() { return RULE_atuacoes; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterAtuacoes(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitAtuacoes(this);
		}
	}

	public final AtuacoesContext atuacoes(Datasets d) throws RecognitionException {
		AtuacoesContext _localctx = new AtuacoesContext(_ctx, getState(), d);
		enterRule(_localctx, 22, RULE_atuacoes);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{

			        System.out.println("----------------------------------------");
			        System.out.println("|           LISTA DE ATUAÇÕES          | ");
			        System.out.println("----------------------------------------");
			        PrintWriter pw = null;
			        try {
			           File file = new File("audicoes.xml");
			           FileWriter fw = new FileWriter(file, true);
			           pw = new PrintWriter(fw);
			           pw.println("<atuacoes>");
			        } catch (IOException e) {
			           e.printStackTrace();
			        } finally {
			           if (pw != null) {
			              pw.close();
			           }
			        }
			    
			setState(113); 
			_errHandler.sync(this);
			_la = _input.LA(1);
			do {
				{
				{
				setState(112);
				atuacao(_localctx.d);
				}
				}
				setState(115); 
				_errHandler.sync(this);
				_la = _input.LA(1);
			} while ( _la==T__11 );

			        pw = null;
			        try {
			           File file = new File("audicoes.xml");
			           FileWriter fw = new FileWriter(file, true);
			           pw = new PrintWriter(fw);
			           pw.println("</atuacoes>");
			        } catch (IOException e) {
			           e.printStackTrace();
			        } finally {
			           if (pw != null) {
			              pw.close();
			           }
			        }
			    
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class AtuacaoContext extends ParserRuleContext {
		public Datasets d;
		public Token idAt;
		public ObrasContext obras() {
			return getRuleContext(ObrasContext.class,0);
		}
		public TerminalNode ID() { return getToken(GAMuParser.ID, 0); }
		public AtuacaoContext(ParserRuleContext parent, int invokingState) { super(parent, invokingState); }
		public AtuacaoContext(ParserRuleContext parent, int invokingState, Datasets d) {
			super(parent, invokingState);
			this.d = d;
		}
		@Override public int getRuleIndex() { return RULE_atuacao; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterAtuacao(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitAtuacao(this);
		}
	}

	public final AtuacaoContext atuacao(Datasets d) throws RecognitionException {
		AtuacaoContext _localctx = new AtuacaoContext(_ctx, getState(), d);
		enterRule(_localctx, 24, RULE_atuacao);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(119);
			match(T__11);
			setState(120);
			((AtuacaoContext)_localctx).idAt = match(ID);
			setState(121);
			match(T__3);
			   System.out.println("----------------------------------------");
			                System.out.println("|           ATUAÇÃO: " + (((AtuacaoContext)_localctx).idAt!=null?((AtuacaoContext)_localctx).idAt.getText():null) + "               |");
			                System.out.println("----------------------------------------");;
			                PrintWriter pw = null;
			                try {
			                   File file = new File("audicoes.xml");
			                   FileWriter fw = new FileWriter(file, true);
			                   pw = new PrintWriter(fw);
			                    pw.println("<atuacao>");
			                   pw.println("<idAt>"+(((AtuacaoContext)_localctx).idAt!=null?((AtuacaoContext)_localctx).idAt.getText():null)+"</idAt>");
			                } catch (IOException e) {
			                   e.printStackTrace();
			                } finally {
			                   if (pw != null) {
			                      pw.close();
			                   }
			                }
			            
			setState(123);
			obras(_localctx.d);
			   pw = null;
			                try {
			                   File file = new File("audicoes.xml");
			                   FileWriter fw = new FileWriter(file, true);
			                   pw = new PrintWriter(fw);
			                   pw.println("</atuacao>");
			                } catch (IOException e) {
			                   e.printStackTrace();
			                } finally {
			                   if (pw != null) {
			                      pw.close();
			                   }
			                }
			            
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class ObrasContext extends ParserRuleContext {
		public Datasets d;
		public List<ObraContext> obra() {
			return getRuleContexts(ObraContext.class);
		}
		public ObraContext obra(int i) {
			return getRuleContext(ObraContext.class,i);
		}
		public ObrasContext(ParserRuleContext parent, int invokingState) { super(parent, invokingState); }
		public ObrasContext(ParserRuleContext parent, int invokingState, Datasets d) {
			super(parent, invokingState);
			this.d = d;
		}
		@Override public int getRuleIndex() { return RULE_obras; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterObras(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitObras(this);
		}
	}

	public final ObrasContext obras(Datasets d) throws RecognitionException {
		ObrasContext _localctx = new ObrasContext(_ctx, getState(), d);
		enterRule(_localctx, 26, RULE_obras);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			 
			        System.out.println("-------------------------");
			        System.out.println("|    LISTA DE OBRAS     |");
			        System.out.println("-------------------------");
			        PrintWriter pw = null;
			        try {
			           File file = new File("audicoes.xml");
			           FileWriter fw = new FileWriter(file, true);
			           pw = new PrintWriter(fw);
			           pw.println("<obras>");
			        } catch (IOException e) {
			           e.printStackTrace();
			        } finally {
			           if (pw != null) {
			              pw.close();
			           }
			        }
			    
			setState(128); 
			_errHandler.sync(this);
			_la = _input.LA(1);
			do {
				{
				{
				setState(127);
				obra(_localctx.d);
				}
				}
				setState(130); 
				_errHandler.sync(this);
				_la = _input.LA(1);
			} while ( _la==T__12 );
			 
			        pw = null;
			        try {
			           File file = new File("audicoes.xml");
			           FileWriter fw = new FileWriter(file, true);
			           pw = new PrintWriter(fw);
			           pw.println("</obras>");
			        } catch (IOException e) {
			           e.printStackTrace();
			        } finally {
			           if (pw != null) {
			              pw.close();
			           }
			        }
			    
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class ObraContext extends ParserRuleContext {
		public Datasets d;
		public Token idObra;
		public DadosObraContext dadosObra() {
			return getRuleContext(DadosObraContext.class,0);
		}
		public TerminalNode ID() { return getToken(GAMuParser.ID, 0); }
		public ObraContext(ParserRuleContext parent, int invokingState) { super(parent, invokingState); }
		public ObraContext(ParserRuleContext parent, int invokingState, Datasets d) {
			super(parent, invokingState);
			this.d = d;
		}
		@Override public int getRuleIndex() { return RULE_obra; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterObra(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitObra(this);
		}
	}

	public final ObraContext obra(Datasets d) throws RecognitionException {
		ObraContext _localctx = new ObraContext(_ctx, getState(), d);
		enterRule(_localctx, 28, RULE_obra);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(134);
			match(T__12);
			setState(135);
			((ObraContext)_localctx).idObra = match(ID);
			setState(136);
			match(T__3);
			    PrintWriter pw = null;  
			            System.out.println("---------------");
			            System.out.println("|    OBRA     |");
			            System.out.println("---------------");
			            
			            /*System.out.println("OBRA: "+ (((ObraContext)_localctx).idObra!=null?((ObraContext)_localctx).idObra.getText():null) + " (\"" +
			            _localctx.d.getOb().getObra((((ObraContext)_localctx).idObra!=null?((ObraContext)_localctx).idObra.getText():null)).getNome() + "\"" + " - "  
			            + "nome compositor" + 
			            _localctx.d.getCp().getCompositor(_localctx.d.getOb().getObra((((ObraContext)_localctx).idObra!=null?((ObraContext)_localctx).idObra.getText():null)).getCompositor()).getNome() + ")");*/
			            
			            System.out.println("Id: "+ (((ObraContext)_localctx).idObra!=null?((ObraContext)_localctx).idObra.getText():null));
			            System.out.println("Titulo: " + _localctx.d.getOb().getObra((((ObraContext)_localctx).idObra!=null?((ObraContext)_localctx).idObra.getText():null)).getNome());
			            System.out.println("Compositor: " + _localctx.d.getCp().getCompositor(_localctx.d.getOb().getObra((((ObraContext)_localctx).idObra!=null?((ObraContext)_localctx).idObra.getText():null)).getCompositor()).getNome());                
			            
			            try {
			               File file = new File("audicoes.xml");
			               FileWriter fw = new FileWriter(file, true);
			               pw = new PrintWriter(fw);
			               pw.println("<obra>");
			               pw.println("<idOb>"+(((ObraContext)_localctx).idObra!=null?((ObraContext)_localctx).idObra.getText():null)+"</idOb>");
			            } catch(IOException e){
			                e.printStackTrace();
			            } finally {
			               if (pw != null) {
			                  pw.close();
			               }
			            }
			        
			setState(138);
			dadosObra(_localctx.d);
			 
			            pw = null;
			            try {
			               File file = new File("audicoes.xml");
			               FileWriter fw = new FileWriter(file, true);
			               pw = new PrintWriter(fw);
			            } catch (IOException e) {
			               e.printStackTrace();
			            } finally {
			               if (pw != null) {
			                  pw.close();
			               }
			            }
			    
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class DadosObraContext extends ParserRuleContext {
		public Datasets d;
		public InstrumentosContext ins;
		public MaestrosContext ms;
		public MusicosContext mu;
		public InstrumentosContext instrumentos() {
			return getRuleContext(InstrumentosContext.class,0);
		}
		public MaestrosContext maestros() {
			return getRuleContext(MaestrosContext.class,0);
		}
		public MusicosContext musicos() {
			return getRuleContext(MusicosContext.class,0);
		}
		public DadosObraContext(ParserRuleContext parent, int invokingState) { super(parent, invokingState); }
		public DadosObraContext(ParserRuleContext parent, int invokingState, Datasets d) {
			super(parent, invokingState);
			this.d = d;
		}
		@Override public int getRuleIndex() { return RULE_dadosObra; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterDadosObra(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitDadosObra(this);
		}
	}

	public final DadosObraContext dadosObra(Datasets d) throws RecognitionException {
		DadosObraContext _localctx = new DadosObraContext(_ctx, getState(), d);
		enterRule(_localctx, 30, RULE_dadosObra);
		 
		        ArrayList<String> intrumentos = new ArrayList<String>(); 
		        ArrayList<String> maestros = new ArrayList<String>();
		        ArrayList<String> musicos = new ArrayList<String>();

		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(141);
			((DadosObraContext)_localctx).ins = instrumentos(intrumentos);
			   
			            System.out.println("-----------------------");
			            System.out.println("|LISTA DE INSTRUMENTOS|");
			            System.out.println("-----------------------");
			            //for(String s : ((DadosObraContext)_localctx).ins.listaOUT)System.out.print(s+",");
			            PrintWriter pw = null;
			            try {
			                File file = new File("audicoes.xml");
			                FileWriter fw = new FileWriter(file, true);
			                pw = new PrintWriter(fw);
			                pw.println("<instrumentos>");
			                for (String s: ((DadosObraContext)_localctx).ins.listaOUT)
			                {
			                    if(_localctx.d.getIn().getInsts().containsKey(s) == false)
			                        {System.out.println("ERRO: O instrumento " + s + " não existe!");}
			                    else {
			                        pw.println("<instrumento>"+s+"</instrumento>");
			                        System.out.println(">"+_localctx.d.getIn().getIntrumento(s)+" ("+s+")");    
			                    }
			                }
			                pw.println("</instrumentos>");
			            }catch (IOException e) {
			               e.printStackTrace();
			            } finally {
			               if (pw != null) {
			                  pw.close();
			               }
			            }
			        
			setState(143);
			((DadosObraContext)_localctx).ms = maestros(maestros);

			            System.out.println("-------------------");
			            System.out.println("|LISTA DE MAESTROS|");
			            System.out.println("-------------------");
			            //for(String s : ((DadosObraContext)_localctx).ms.listaOUT)System.out.print(s+",");
			            pw = null;
			            try {
			                File file = new File("audicoes.xml");
			                FileWriter fw = new FileWriter(file, true);
			                pw = new PrintWriter(fw);
			                pw.println("<maestros>");
			                for(String s : ((DadosObraContext)_localctx).ms.listaOUT)
			                {
			                    if(s.contains("P") == false){
			                        System.out.println("ERRO: O ID = " + s + " não corresponde a um professor!");
			                    }
			                    else{
			                        if(_localctx.d.getPr().getProfs().containsKey(s) == false)
			                            System.out.println("ERRO: O professor com o ID = " + s + " não existe!");
			                        else {
			                                pw.println("<maestro>"+s+"</maestro>");
			                                System.out.println(">"+_localctx.d.getPr().getProfessor(s).getNome()+" ("+s+")");
			                            }
			                    }
			                }
			                pw.println("</maestros>");
			            }catch (IOException e) {
			               e.printStackTrace();
			            } finally {
			               if (pw != null) {
			                  pw.close();
			               }
			            }
			        
			setState(145);
			((DadosObraContext)_localctx).mu = musicos(musicos);
			   
			            ArrayList<String> instMusicos = new ArrayList<String>();
			            ArrayList<String> erros = new ArrayList<String>();
			            String idCurso = "";
			            String idInst = "";
			            pw = null;
			            System.out.println("------------------");
			            System.out.println("|LISTA DE MUSICOS|");
			            System.out.println("------------------");
			            try {
			                File file = new File("audicoes.xml");
			                FileWriter fw = new FileWriter(file, true);
			                pw = new PrintWriter(fw);
			                pw.println("<musicos>");
			            for(String s : ((DadosObraContext)_localctx).mu.listaOUT)
			            {
			                if(s.startsWith("P") == false && s.startsWith("A") == false){
			                    System.out.println("ERRO: O ID = " + s + " não corresponde a um professor nem a um aluno!");
			                }
			                else{
			                        if(s.startsWith("P") == true){
			                            if(_localctx.d.getPr().getProfs().containsKey(s) == false)
			                            {System.out.println("ERRO: O professor com o ID = " + s + " não existe!");}
			                            else {
			                                    pw.println("<musico>"+s+"</musico>");
			                                    idCurso = _localctx.d.getPr().getProfessor(s).getCurso();
			                                    idInst = _localctx.d.getCs().getCurso(idCurso.substring(2)).getId_instrumento();
			                                    //System.out.println(idCurso);
			                                    instMusicos.add(idInst);
			                                    //System.out.println(_localctx.d.getCs().getCurso(idCurso.substring(2)).getId_instrumento());
			                                    System.out.println(">"+_localctx.d.getPr().getProfessor(s).getNome()+" ("+s+")");
			                                    if(((DadosObraContext)_localctx).ins.listaOUT.contains(idInst) == false){
			                                        erros.add("Aviso: O professor com o ID = "+ s 
			                                            + " não toca nenhum dos instrumentos da lista" );
			                                    }
			                                }
			                            
			                        }
			                        if(s.startsWith("A") == true){
			                            if(_localctx.d.getAl().getAls().containsKey(s) == false)
			                                {System.out.println("ERRO: O aluno com o ID = " + s + " não existe!");}
			                                else {
			                                    idCurso = _localctx.d.getAl().getAluno(s).getCurso();
			                                    //System.out.println(idCurso);
			                                    idInst = _localctx.d.getCs().getCurso(idCurso.substring(2)).getId_instrumento();
			                                    instMusicos.add(idInst);
			                                    
			                                    pw.println("<musico>"+s+"</musico>");
			                                    System.out.println(">"+_localctx.d.getAl().getAluno(s).getNome()+" ("+s+")");
			                                    if(((DadosObraContext)_localctx).ins.listaOUT.contains(idInst) == false){
			                                        erros.add("Aviso: O aluno com o ID = "+ s 
			                                            + " não toca nenhum dos instrumentos da lista" );
			                                    }
			                                }
			                        }
			                    }   
			            }
			            for(String s: ((DadosObraContext)_localctx).ins.listaOUT){
			                if(instMusicos.contains(s) == false){
			                    System.out.println("Aviso: O instrumento com o ID = " + s
			                        + " não tem nenhum músico que o toque");
			                }
			            }
			            
			            for(String s : erros)
			                System.out.println(s);
			            
			  
			            pw.println("</musicos>");
			            pw.println("</obra>");
			            }catch (IOException e) {
			               e.printStackTrace();
			            } finally {
			               if (pw != null) {
			                  pw.close();
			               }
			            }
			        
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class InstrumentosContext extends ParserRuleContext {
		public ArrayList<String> listaIN;
		public ArrayList<String> listaOUT;
		public IdContext instrumento1;
		public IdContext instrumento2;
		public List<IdContext> id() {
			return getRuleContexts(IdContext.class);
		}
		public IdContext id(int i) {
			return getRuleContext(IdContext.class,i);
		}
		public InstrumentosContext(ParserRuleContext parent, int invokingState) { super(parent, invokingState); }
		public InstrumentosContext(ParserRuleContext parent, int invokingState, ArrayList<String> listaIN) {
			super(parent, invokingState);
			this.listaIN = listaIN;
		}
		@Override public int getRuleIndex() { return RULE_instrumentos; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterInstrumentos(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitInstrumentos(this);
		}
	}

	public final InstrumentosContext instrumentos(ArrayList<String> listaIN) throws RecognitionException {
		InstrumentosContext _localctx = new InstrumentosContext(_ctx, getState(), listaIN);
		enterRule(_localctx, 32, RULE_instrumentos);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(148);
			match(T__13);
			setState(149);
			match(T__3);
			setState(150);
			((InstrumentosContext)_localctx).instrumento1 = id(_localctx.listaIN);
			 ((InstrumentosContext)_localctx).listaOUT =  ((InstrumentosContext)_localctx).instrumento1.out; 
			setState(156);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__14) {
				{
				{
				setState(152);
				match(T__14);
				setState(153);
				((InstrumentosContext)_localctx).instrumento2 = id(_localctx.listaIN);
				}
				}
				setState(158);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			 ((InstrumentosContext)_localctx).listaOUT =  ((InstrumentosContext)_localctx).instrumento2.out; 
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class MaestrosContext extends ParserRuleContext {
		public ArrayList<String> listaIN;
		public ArrayList<String> listaOUT;
		public IdContext idP1;
		public IdContext idP2;
		public List<IdContext> id() {
			return getRuleContexts(IdContext.class);
		}
		public IdContext id(int i) {
			return getRuleContext(IdContext.class,i);
		}
		public MaestrosContext(ParserRuleContext parent, int invokingState) { super(parent, invokingState); }
		public MaestrosContext(ParserRuleContext parent, int invokingState, ArrayList<String> listaIN) {
			super(parent, invokingState);
			this.listaIN = listaIN;
		}
		@Override public int getRuleIndex() { return RULE_maestros; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterMaestros(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitMaestros(this);
		}
	}

	public final MaestrosContext maestros(ArrayList<String> listaIN) throws RecognitionException {
		MaestrosContext _localctx = new MaestrosContext(_ctx, getState(), listaIN);
		enterRule(_localctx, 34, RULE_maestros);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(161);
			match(T__15);
			setState(162);
			match(T__3);
			setState(163);
			((MaestrosContext)_localctx).idP1 = id(_localctx.listaIN);
			 ((MaestrosContext)_localctx).listaOUT =  ((MaestrosContext)_localctx).idP1.out; 
			setState(169);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__14) {
				{
				{
				setState(165);
				match(T__14);
				setState(166);
				((MaestrosContext)_localctx).idP2 = id(_localctx.listaIN);
				}
				}
				setState(171);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			 ((MaestrosContext)_localctx).listaOUT =  ((MaestrosContext)_localctx).idP2.out; 
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class MusicosContext extends ParserRuleContext {
		public ArrayList<String> listaIN;
		public ArrayList<String> listaOUT;
		public IdContext idM1;
		public IdContext idM2;
		public List<IdContext> id() {
			return getRuleContexts(IdContext.class);
		}
		public IdContext id(int i) {
			return getRuleContext(IdContext.class,i);
		}
		public MusicosContext(ParserRuleContext parent, int invokingState) { super(parent, invokingState); }
		public MusicosContext(ParserRuleContext parent, int invokingState, ArrayList<String> listaIN) {
			super(parent, invokingState);
			this.listaIN = listaIN;
		}
		@Override public int getRuleIndex() { return RULE_musicos; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterMusicos(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitMusicos(this);
		}
	}

	public final MusicosContext musicos(ArrayList<String> listaIN) throws RecognitionException {
		MusicosContext _localctx = new MusicosContext(_ctx, getState(), listaIN);
		enterRule(_localctx, 36, RULE_musicos);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(174);
			match(T__16);
			setState(175);
			match(T__3);
			setState(176);
			((MusicosContext)_localctx).idM1 = id(_localctx.listaIN);
			 ((MusicosContext)_localctx).listaOUT =  ((MusicosContext)_localctx).idM1.out; 
			setState(182);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__14) {
				{
				{
				setState(178);
				match(T__14);
				setState(179);
				((MusicosContext)_localctx).idM2 = id(_localctx.listaIN);
				}
				}
				setState(184);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			 ((MusicosContext)_localctx).listaOUT =  ((MusicosContext)_localctx).idM2.out; 
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class DataContext extends ParserRuleContext {
		public String dt;
		public Token d;
		public TerminalNode DATA() { return getToken(GAMuParser.DATA, 0); }
		public DataContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_data; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterData(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitData(this);
		}
	}

	public final DataContext data() throws RecognitionException {
		DataContext _localctx = new DataContext(_ctx, getState());
		enterRule(_localctx, 38, RULE_data);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(187);
			((DataContext)_localctx).d = match(DATA);
			((DataContext)_localctx).dt =  (((DataContext)_localctx).d!=null?((DataContext)_localctx).d.getText():null);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class DuracaoContext extends ParserRuleContext {
		public TerminalNode DURACAO() { return getToken(GAMuParser.DURACAO, 0); }
		public DuracaoContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_duracao; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterDuracao(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitDuracao(this);
		}
	}

	public final DuracaoContext duracao() throws RecognitionException {
		DuracaoContext _localctx = new DuracaoContext(_ctx, getState());
		enterRule(_localctx, 40, RULE_duracao);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(190);
			match(DURACAO);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static class IdContext extends ParserRuleContext {
		public ArrayList<String> in;
		public ArrayList<String> out;
		public Token varID;
		public TerminalNode ID() { return getToken(GAMuParser.ID, 0); }
		public IdContext(ParserRuleContext parent, int invokingState) { super(parent, invokingState); }
		public IdContext(ParserRuleContext parent, int invokingState, ArrayList<String> in) {
			super(parent, invokingState);
			this.in = in;
		}
		@Override public int getRuleIndex() { return RULE_id; }
		@Override
		public void enterRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).enterId(this);
		}
		@Override
		public void exitRule(ParseTreeListener listener) {
			if ( listener instanceof GAMuListener ) ((GAMuListener)listener).exitId(this);
		}
	}

	public final IdContext id(ArrayList<String> in) throws RecognitionException {
		IdContext _localctx = new IdContext(_ctx, getState(), in);
		enterRule(_localctx, 42, RULE_id);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(192);
			((IdContext)_localctx).varID = match(ID);

			                if(_localctx.in.contains((((IdContext)_localctx).varID!=null?((IdContext)_localctx).varID.getText():null)) == false) _localctx.in.add((((IdContext)_localctx).varID!=null?((IdContext)_localctx).varID.getText():null));
			                ((IdContext)_localctx).out =  _localctx.in;
			            
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static final String _serializedATN =
		"\3\u0430\ud6d1\u8206\uad2d\u4417\uaef1\u8d80\uaadd\3\35\u00c6\4\2\t\2"+
		"\4\3\t\3\4\4\t\4\4\5\t\5\4\6\t\6\4\7\t\7\4\b\t\b\4\t\t\t\4\n\t\n\4\13"+
		"\t\13\4\f\t\f\4\r\t\r\4\16\t\16\4\17\t\17\4\20\t\20\4\21\t\21\4\22\t\22"+
		"\4\23\t\23\4\24\t\24\4\25\t\25\4\26\t\26\4\27\t\27\3\2\3\2\3\2\7\2\62"+
		"\n\2\f\2\16\2\65\13\2\3\2\3\2\3\3\3\3\3\3\3\3\3\3\3\3\3\3\3\4\3\4\3\4"+
		"\3\4\3\4\3\4\3\4\3\4\3\4\3\4\3\5\3\5\3\5\3\5\3\5\3\6\3\6\3\6\3\6\3\6\3"+
		"\7\3\7\3\7\3\7\3\7\3\b\3\b\3\b\3\b\3\b\3\t\3\t\3\t\3\t\3\t\3\n\3\n\3\n"+
		"\3\n\3\n\3\13\3\13\3\13\3\13\3\13\3\f\3\f\3\f\3\f\3\f\3\r\3\r\6\rt\n\r"+
		"\r\r\16\ru\3\r\3\r\3\16\3\16\3\16\3\16\3\16\3\16\3\16\3\17\3\17\6\17\u0083"+
		"\n\17\r\17\16\17\u0084\3\17\3\17\3\20\3\20\3\20\3\20\3\20\3\20\3\20\3"+
		"\21\3\21\3\21\3\21\3\21\3\21\3\21\3\22\3\22\3\22\3\22\3\22\3\22\7\22\u009d"+
		"\n\22\f\22\16\22\u00a0\13\22\3\22\3\22\3\23\3\23\3\23\3\23\3\23\3\23\7"+
		"\23\u00aa\n\23\f\23\16\23\u00ad\13\23\3\23\3\23\3\24\3\24\3\24\3\24\3"+
		"\24\3\24\7\24\u00b7\n\24\f\24\16\24\u00ba\13\24\3\24\3\24\3\25\3\25\3"+
		"\25\3\26\3\26\3\27\3\27\3\27\3\27\2\2\30\2\4\6\b\n\f\16\20\22\24\26\30"+
		"\32\34\36 \"$&(*,\2\2\u00b5\2.\3\2\2\2\48\3\2\2\2\6?\3\2\2\2\bI\3\2\2"+
		"\2\nN\3\2\2\2\fS\3\2\2\2\16X\3\2\2\2\20]\3\2\2\2\22b\3\2\2\2\24g\3\2\2"+
		"\2\26l\3\2\2\2\30q\3\2\2\2\32y\3\2\2\2\34\u0080\3\2\2\2\36\u0088\3\2\2"+
		"\2 \u008f\3\2\2\2\"\u0096\3\2\2\2$\u00a3\3\2\2\2&\u00b0\3\2\2\2(\u00bd"+
		"\3\2\2\2*\u00c0\3\2\2\2,\u00c2\3\2\2\2./\b\2\1\2/\63\5\4\3\2\60\62\5\4"+
		"\3\2\61\60\3\2\2\2\62\65\3\2\2\2\63\61\3\2\2\2\63\64\3\2\2\2\64\66\3\2"+
		"\2\2\65\63\3\2\2\2\66\67\b\2\1\2\67\3\3\2\2\289\7\3\2\29:\b\3\1\2:;\5"+
		"\6\4\2;<\5\30\r\2<=\7\4\2\2=>\b\3\1\2>\5\3\2\2\2?@\5\b\5\2@A\5\n\6\2A"+
		"B\5\f\7\2BC\5\16\b\2CD\5\20\t\2DE\5\22\n\2EF\5\24\13\2FG\5\26\f\2GH\b"+
		"\4\1\2H\7\3\2\2\2IJ\7\5\2\2JK\7\6\2\2KL\7\24\2\2LM\b\5\1\2M\t\3\2\2\2"+
		"NO\7\7\2\2OP\7\6\2\2PQ\7\24\2\2QR\b\6\1\2R\13\3\2\2\2ST\7\b\2\2TU\7\6"+
		"\2\2UV\7\24\2\2VW\b\7\1\2W\r\3\2\2\2XY\7\t\2\2YZ\7\6\2\2Z[\5(\25\2[\\"+
		"\b\b\1\2\\\17\3\2\2\2]^\7\n\2\2^_\7\6\2\2_`\7\31\2\2`a\b\t\1\2a\21\3\2"+
		"\2\2bc\7\13\2\2cd\7\6\2\2de\7\24\2\2ef\b\n\1\2f\23\3\2\2\2gh\7\f\2\2h"+
		"i\7\6\2\2ij\7\24\2\2jk\b\13\1\2k\25\3\2\2\2lm\7\r\2\2mn\7\6\2\2no\5*\26"+
		"\2op\b\f\1\2p\27\3\2\2\2qs\b\r\1\2rt\5\32\16\2sr\3\2\2\2tu\3\2\2\2us\3"+
		"\2\2\2uv\3\2\2\2vw\3\2\2\2wx\b\r\1\2x\31\3\2\2\2yz\7\16\2\2z{\7\30\2\2"+
		"{|\7\6\2\2|}\b\16\1\2}~\5\34\17\2~\177\b\16\1\2\177\33\3\2\2\2\u0080\u0082"+
		"\b\17\1\2\u0081\u0083\5\36\20\2\u0082\u0081\3\2\2\2\u0083\u0084\3\2\2"+
		"\2\u0084\u0082\3\2\2\2\u0084\u0085\3\2\2\2\u0085\u0086\3\2\2\2\u0086\u0087"+
		"\b\17\1\2\u0087\35\3\2\2\2\u0088\u0089\7\17\2\2\u0089\u008a\7\30\2\2\u008a"+
		"\u008b\7\6\2\2\u008b\u008c\b\20\1\2\u008c\u008d\5 \21\2\u008d\u008e\b"+
		"\20\1\2\u008e\37\3\2\2\2\u008f\u0090\5\"\22\2\u0090\u0091\b\21\1\2\u0091"+
		"\u0092\5$\23\2\u0092\u0093\b\21\1\2\u0093\u0094\5&\24\2\u0094\u0095\b"+
		"\21\1\2\u0095!\3\2\2\2\u0096\u0097\7\20\2\2\u0097\u0098\7\6\2\2\u0098"+
		"\u0099\5,\27\2\u0099\u009e\b\22\1\2\u009a\u009b\7\21\2\2\u009b\u009d\5"+
		",\27\2\u009c\u009a\3\2\2\2\u009d\u00a0\3\2\2\2\u009e\u009c\3\2\2\2\u009e"+
		"\u009f\3\2\2\2\u009f\u00a1\3\2\2\2\u00a0\u009e\3\2\2\2\u00a1\u00a2\b\22"+
		"\1\2\u00a2#\3\2\2\2\u00a3\u00a4\7\22\2\2\u00a4\u00a5\7\6\2\2\u00a5\u00a6"+
		"\5,\27\2\u00a6\u00ab\b\23\1\2\u00a7\u00a8\7\21\2\2\u00a8\u00aa\5,\27\2"+
		"\u00a9\u00a7\3\2\2\2\u00aa\u00ad\3\2\2\2\u00ab\u00a9\3\2\2\2\u00ab\u00ac"+
		"\3\2\2\2\u00ac\u00ae\3\2\2\2\u00ad\u00ab\3\2\2\2\u00ae\u00af\b\23\1\2"+
		"\u00af%\3\2\2\2\u00b0\u00b1\7\23\2\2\u00b1\u00b2\7\6\2\2\u00b2\u00b3\5"+
		",\27\2\u00b3\u00b8\b\24\1\2\u00b4\u00b5\7\21\2\2\u00b5\u00b7\5,\27\2\u00b6"+
		"\u00b4\3\2\2\2\u00b7\u00ba\3\2\2\2\u00b8\u00b6\3\2\2\2\u00b8\u00b9\3\2"+
		"\2\2\u00b9\u00bb\3\2\2\2\u00ba\u00b8\3\2\2\2\u00bb\u00bc\b\24\1\2\u00bc"+
		"\'\3\2\2\2\u00bd\u00be\7\26\2\2\u00be\u00bf\b\25\1\2\u00bf)\3\2\2\2\u00c0"+
		"\u00c1\7\32\2\2\u00c1+\3\2\2\2\u00c2\u00c3\7\30\2\2\u00c3\u00c4\b\27\1"+
		"\2\u00c4-\3\2\2\2\b\63u\u0084\u009e\u00ab\u00b8";
	public static final ATN _ATN =
		new ATNDeserializer().deserialize(_serializedATN.toCharArray());
	static {
		_decisionToDFA = new DFA[_ATN.getNumberOfDecisions()];
		for (int i = 0; i < _ATN.getNumberOfDecisions(); i++) {
			_decisionToDFA[i] = new DFA(_ATN.getDecisionState(i), i);
		}
	}
}