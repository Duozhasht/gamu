<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="2.0">

    <xsl:output method="xml"/>
    
    
    <xsl:template match="/">
        <fo:root xmlns:fo="http://www.w3.org/1999/XSL/Format">
            <fo:layout-master-set>
                <fo:simple-page-master master-name="Audicao" page-height="297mm" page-width="210mm">
                    <fo:region-body region-name="dados" margin="2cm"/>
                </fo:simple-page-master>
            </fo:layout-master-set>
            
            <fo:page-sequence master-reference="Audicao">
                <fo:flow flow-name="dados" font-size="12pt">
                    <xsl:apply-templates/>
                </fo:flow>
            </fo:page-sequence>
        </fo:root>
    </xsl:template>
    
    <xsl:template match="audicao">
        <fo:block font-size="24pt" space-after="1em" border-bottom-style="solid" text-align="center">
            Audição <xsl:value-of select="id"/>
        </fo:block>
        
        <xsl:apply-templates select="metadados"/>
        <xsl:apply-templates select="atuacoes"/>
        
        
        <xsl:if test="following-sibling::audicao">
            <fo:block page-break-before="always"/>
        </xsl:if>
    </xsl:template>
    
    <xsl:template match="metadados">
        <fo:block font-size="16pt" space-before="1em" font-weight="bold">
            Dados da audição
        </fo:block>
        <fo:block>
            Título: <xsl:value-of select="titulo"/>
        </fo:block>
        <fo:block>
            Subtítulo: <xsl:value-of select="subtitulo"/>
        </fo:block>
        <fo:block>
            Tema: <xsl:value-of select="tema"/>
        </fo:block>
        <fo:block>
            Data: <xsl:value-of select="data"/>
            <xsl:text>  </xsl:text>
            <xsl:value-of select="hora"/>
        </fo:block>
        <fo:block>
            Local da audição: <xsl:value-of select="local"/>
        </fo:block>
        <fo:block>
            Organizador: <xsl:value-of select="organizador"/>
        </fo:block>
        <fo:block>
            Duração: <xsl:value-of select="duracao"/>
        </fo:block>
    </xsl:template>
    
    <xsl:template match="atuacoes">
        <xsl:apply-templates/>
    </xsl:template>
    
    <xsl:template match="atuacao">
        <fo:block font-size="16pt" space-before="1em" font-weight="bold">
            <xsl:value-of select="tituloAt"/>
        </fo:block>
        <fo:block>
            Identificação da atuação: <xsl:value-of select="idAt"/>
        </fo:block>
        <xsl:apply-templates/>
    </xsl:template>
    
    <xsl:template match="obras">
        <fo:block space-before="1em" font-weight="bold">
            Obras desta atuação:
        </fo:block>
        <fo:block text-indent="3em">
            <xsl:apply-templates/>
        </fo:block>
    </xsl:template>
    
    <xsl:template match="obra">
        <xsl:variable name="id" select="idOb"/>
        <fo:block space-before="2em" font-weight="bold">
            <xsl:value-of select="document('obras.xml')//obra[@id=$id]/nome"/>
        </fo:block>
        <xsl:variable name="compositor" select="document('obras.xml')//obra[@id=$id]/compositor"/>
        <fo:block>
            Compositor da obra: <xsl:value-of select="document('compositores.xml')//compositor[@id=$compositor]/nome"/>
        </fo:block>
        <xsl:apply-templates select="instrumentos"/>
        <xsl:apply-templates select="maestros"/>
        <xsl:apply-templates select="musicos"/>
    </xsl:template>
    
    <xsl:template match="instrumentos">
        <fo:block space-before="1em">
            Instrumentos:
        </fo:block>
        <fo:block text-indent="3em">
            <fo:list-block>
                <xsl:apply-templates/>
            </fo:list-block>
        </fo:block>
    </xsl:template>
    
    <xsl:template match="instrumento">
        <fo:list-item>
            <fo:list-item-label end-indent="label-end()">
                <fo:block>
                    <fo:inline>•</fo:inline>
                </fo:block>
            </fo:list-item-label>
            <fo:list-item-body start-indent="body-start()">
                <fo:block>
                    <xsl:variable name="id" select="."/>
                    <xsl:value-of select="document('instrumentos.xml')//instrumento[@id=$id]"/>
                </fo:block>
            </fo:list-item-body>
        </fo:list-item>
    </xsl:template>
    
    <xsl:template match="maestros">
        <fo:block space-before="1em">
            Maestros:
        </fo:block>
        <fo:block text-indent="3em">
            <fo:list-block>
                <xsl:apply-templates/>
            </fo:list-block>
        </fo:block>
    </xsl:template>
    
    <xsl:template match="maestro">
        <fo:list-item>
            <fo:list-item-label end-indent="label-end()">
                <fo:block>
                    <fo:inline>•</fo:inline>
                </fo:block>
            </fo:list-item-label>
            <fo:list-item-body start-indent="body-start()">
                <fo:block>
                    <xsl:variable name="id" select="."/>
                    <xsl:value-of select="document('professores.xml')//professor[@id=$id]/nome"/>
                </fo:block>
            </fo:list-item-body>
        </fo:list-item>
    </xsl:template>
    
    <xsl:template match="musicos">
        <fo:block space-before="1em">
            Músicos:
        </fo:block>
        <fo:block text-indent="3em">
            <fo:list-block>
                <xsl:apply-templates/>
            </fo:list-block>
        </fo:block>
    </xsl:template>
    
    <xsl:template match="musico">
        <fo:list-item>
            <fo:list-item-label end-indent="label-end()">
                <fo:block>
                    <fo:inline>•</fo:inline>
                </fo:block>
            </fo:list-item-label>
            <fo:list-item-body start-indent="body-start()">
                <fo:block>
                    <xsl:variable name="id" select="."/>
                    <xsl:value-of select="document('alunos.xml')//aluno[@id=$id]/nome"/>
                </fo:block>
            </fo:list-item-body>
        </fo:list-item>
    </xsl:template>
    

    
    
    
    
</xsl:stylesheet>