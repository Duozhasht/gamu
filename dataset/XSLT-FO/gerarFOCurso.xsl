<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="2.0">
    
    <xsl:output method="xml"/>
    
    <xsl:template match="/">
        <fo:root xmlns:fo="http://www.w3.org/1999/XSL/Format">
            <fo:layout-master-set>
                <fo:simple-page-master master-name="Curso" page-height="297mm" page-width="210mm">
                    <fo:region-body region-name="dados" margin="2cm"/>
                </fo:simple-page-master>
            </fo:layout-master-set>
            
            <fo:page-sequence master-reference="Curso">
                <fo:flow flow-name="dados" font-size="12pt">
                    <xsl:apply-templates/>
                    
                </fo:flow>
            </fo:page-sequence>
        </fo:root>
    </xsl:template>
    
    <xsl:template match="curso">
        <fo:block font-size="24pt" space-after="1em" border-bottom-style="solid" text-align="center">
            Alunos do <xsl:value-of select="designacao"/>
        </fo:block>
        
        
        <fo:block>
            Identificação do Curso: <xsl:value-of select="@id"/>
        </fo:block>
        <fo:block>
            Nome do Curso: <xsl:value-of select="designacao"/>
        </fo:block>
        <fo:block>
            Duração do curso: <xsl:value-of select="duracao"/> anos
        </fo:block>
        <fo:block>
            Intrumento ensinado no curso: <xsl:value-of select="instrumento"/>
        </fo:block>
        
        <xsl:variable name="id" select="@id"/>
        <xsl:apply-templates select="document('alunos.xml')//aluno[curso=$id]"/>
                    
        <xsl:if test="following-sibling::curso">
            <fo:block page-break-before="always"/>
        </xsl:if>
    </xsl:template>
    
    

    <xsl:template match="aluno">
        <fo:block space-before="1em">
            Código de identificação do aluno: <xsl:value-of select="@id"/>
        </fo:block>
        <xsl:apply-templates select="nome"/>
        <xsl:apply-templates select="dataNasc"/>
        <xsl:apply-templates select="anoCurso"/>
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
    
    
    
    
</xsl:stylesheet>