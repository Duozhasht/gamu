<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    exclude-result-prefixes="xs"
    version="2.0">
    
    <xsl:output method="xml" indent="yes" />
    
    <xsl:template match="/">
        <compositores>
            <xsl:apply-templates/>
        </compositores>
    </xsl:template>
    
    <xsl:template match="bio">
        <bio>
            <xsl:value-of select="replace(.,'[^\s\w\d\(\)\-,\.:;\?§&quot;\[\]/—–]','')"/>
        </bio>
    </xsl:template>
    

    
    <xsl:template match="compositor">
        <compositor id="{@id}">
            <xsl:apply-templates/>
        </compositor>
    </xsl:template>
    
    <xsl:template match="nome|dataNasc|dataObito|periodo">
        <xsl:copy-of select="." copy-namespaces="no"/>
    </xsl:template>
    
</xsl:stylesheet>