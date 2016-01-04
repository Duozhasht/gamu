<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="2.0">
    
    <xsl:output method="xml"/>
    
    <xsl:template match="/">
        <fo:root xmlns:fo="http://www.w3.org/1999/XSL/Format">
            <fo:layout-master-set>
                <fo:simple-page-master master-name="Aluno" page-height="297mm" page-width="210mm">
                    <fo:region-body region-name="dados" margin="2cm"/>
                </fo:simple-page-master>
            </fo:layout-master-set>
            
            
            <fo:page-sequence master-reference="Aluno">
                <fo:flow flow-name="dados" font-size="12pt">
                    <fo:block font-size="24pt" space-after="1em" border-bottom-style="solid" text-align="center">
                        Confirmação de criação de um aluno
                    </fo:block>
                    
                    <xsl:apply-templates/>
                    
                </fo:flow>
            </fo:page-sequence>
        </fo:root>
    </xsl:template>

    <xsl:template match="aluno">
        <fo:block>
            Código de identificação do aluno: <xsl:value-of select="@id"/>
        </fo:block>
        <xsl:apply-templates select="nome"/>
        <xsl:apply-templates select="dataNasc"/>
        <xsl:apply-templates select="anoCurso"/>
        <xsl:apply-templates select="instrumento"/>
        <xsl:apply-templates select="curso"/>
    </xsl:template>

    <xsl:template match="nome">
        <fo:block>
            Nome: <xsl:value-of select="."/>
        </fo:block>
    </xsl:template>
    
    <xsl:template match="dataNasc">
        <fo:block>
            Data de Nascimento: <xsl:value-of select="."/>
        </fo:block>
    </xsl:template>
    
    <xsl:template match="anoCurso">
        <fo:block>
            Ano do Curso: <xsl:value-of select="."/>º ano
        </fo:block>
    </xsl:template>
    
    <xsl:template match="instrumento">
        <xsl:variable name="inst" select="."/>
        <fo:block space-after="1em">
            Instrumento: <xsl:value-of select="document('instrumentos.xml')//instrumento[@id=$inst]"/>
        </fo:block>
    </xsl:template>
    
    <xsl:template match="curso">
        <xsl:variable name="cod" select="."/>
        <fo:block>
            Identificação do Curso: <xsl:value-of select="."/>
        </fo:block>
        <fo:block>
            Nome do Curso: <xsl:value-of select="document('cursos.xml')//curso[@id=$cod]/designacao"/>
        </fo:block>
        <fo:block>
            Duração do curso: <xsl:value-of select="document('cursos.xml')//curso[@id=$cod]/duracao"/> anos
        </fo:block>
    </xsl:template>
    
 

</xsl:stylesheet>