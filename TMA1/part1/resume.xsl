<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="resume">
  <html>
  <body>
  <h2>My Resume</h2>
  <table border="1">
    <tr bgcolor="#9acd32">
      <td><xsl:value-of select="header/name/firstname"/>_<xsl:value-of select="header/name/lastname"/> </td>
    </tr>
    <tr bgcolor="#9acd32">
      <td><xsl:value-of select="header/address/street"/></td>
      <td><xsl:value-of select="header/address/city"/> <xsl:value-of select="header/address/state"/></td>
      <td><xsl:value-of select="header/address/zip"/></td>
    </tr>
    <tr bgcolor="#9acd32">
      <td><xsl:value-of select="header/contact/phone"/></td>
      <td><xsl:value-of select="header/contact/email"/></td>
      <td><xsl:value-of select="header/contact/url"/></td>
    </tr>
  </table>

  <table border="1">
    <tr bgcolor="#9acd32">
      <td><xsl:value-of select="general/profile"/></td>
    </tr>
    <tr bgcolor="#9acd32">
      <td><xsl:value-of select="general/additionallinks/github"/></td>
      <td><xsl:value-of select="general/additionallinks/instagram"/></td>
      <td><xsl:value-of select="general/additionallinks/youtube"/></td>
    </tr>
  </table>

  <table border="1">
    <xsl:for-each select="education/degrees">
    <tr bgcolor="#9acd32">
      <td><xsl:value-of select="degree/level"/></td>
      <td><xsl:value-of select="degree/major"/></td>
      <td><xsl:value-of select="degree/institution"/></td>
    </tr>
    <tr bgcolor="#9acd32">
      <td>Grad Date: </td>
      <td><xsl:value-of select="degree/graduationdate/month"/></td>
      <td><xsl:value-of select="degree/graduationdate/year"/></td>
    </tr>
    <tr bgcolor="#9acd32">
      <td><xsl:value-of select="degree/annotation"/></td>
    </tr>
    <tr bgcolor="#9acd32">
    </tr>
    </xsl:for-each>

  </table>


  <table border="1">
    <xsl:for-each select="workexperience/job">
    <tr bgcolor="#9acd32">
      <td><xsl:value-of select="jobtitle"/></td>
      <td><xsl:value-of select="employer"/></td>
    </tr>
    <tr bgcolor="#9acd32">
      <td>From <xsl:value-of select="period/from/date/month"/> <xsl:value-of select="period/from/date/year"/></td>
      <td>To <xsl:value-of select="period/to/date/month"/> <xsl:value-of select="period/to/date/year"/></td>
    </tr>
    <tr bgcolor="#9acd32">
      <td><xsl:value-of select="description"/></td>
    </tr>
    <tr bgcolor="#9acd32">
    </tr>
    </xsl:for-each>
  </table>

  </body>
  </html>
</xsl:template>

</xsl:stylesheet>