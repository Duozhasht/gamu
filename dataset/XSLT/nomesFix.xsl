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
    
    <xsl:template match="nome">
        <nome>
            <xsl:for-each select="tokenize(.,' ')">
                
                <xsl:value-of select="substring(.,1,1)"/><xsl:value-of select="lower-case(substring(.,2))"/>
                
                <xsl:if test="position() != last()">
                    <xsl:text>&#160;</xsl:text>
                </xsl:if>
                
            </xsl:for-each>
        </nome>
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
    
    <xsl:template match="dataNasc|curso|anoCurso|instrumento|habilitacoes">
        <xsl:copy-of select="." copy-namespaces="no"/>
    </xsl:template>
    
</xsl:stylesheet>