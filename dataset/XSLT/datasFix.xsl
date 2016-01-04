<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    exclude-result-prefixes="xs"
    version="2.0">
    
    <xsl:output method="xml" indent="yes" />
    
    <xsl:template match="/">
        <xsl:variable name="root" select="name(/*)"/>
        
        <xsl:text disable-output-escaping="yes">&#xa;&lt;</xsl:text><xsl:value-of select="$root"/><xsl:text disable-output-escaping="yes">&gt;</xsl:text>
            <xsl:apply-templates/>
        <xsl:text disable-output-escaping="yes">&lt;/</xsl:text><xsl:value-of select="$root"/><xsl:text disable-output-escaping="yes">&gt;</xsl:text>
    </xsl:template>
    
    
    <xsl:template match="dataNasc|dataObito">
        <xsl:text disable-output-escaping="yes">&lt;</xsl:text>
        <xsl:value-of select="name()"/>
        <xsl:text disable-output-escaping="yes">&gt;</xsl:text>
        
        <xsl:variable name="tokens" select="tokenize(.,'-')"/>
        <xsl:for-each select="$tokens">
            
            <xsl:if test="string-length(.) = 1">
                <xsl:text>0</xsl:text>
            </xsl:if>
            <xsl:value-of select="."/>
            
            <xsl:if test="count($tokens) = 1">
                <xsl:text>-00-00</xsl:text>
            </xsl:if>
            
            <xsl:if test="position() != last()">
                <xsl:text>-</xsl:text>
            </xsl:if>
                        
        </xsl:for-each>
        
        <xsl:text disable-output-escaping="yes">&lt;/</xsl:text>
        <xsl:value-of select="name()"/>
        <xsl:text disable-output-escaping="yes">&gt;</xsl:text>
    </xsl:template>
    
    <xsl:template match="aluno">
        <aluno id="{@id}">
            <xsl:apply-templates/>
        </aluno>
    </xsl:template>
    
    <xsl:template match="professor">
        <professor id="{@id}">
            <xsl:apply-templates/>
        </professor>
    </xsl:template>
    
    <xsl:template match="compositor">
        <compositor id="{@id}">
            <xsl:apply-templates/>
        </compositor>
    </xsl:template>
    
    <xsl:template match="nome|curso|anoCurso|instrumento|habilitacoes|bio|periodo">
        <xsl:copy-of select="." copy-namespaces="no"/>
    </xsl:template>
    
    
</xsl:stylesheet>