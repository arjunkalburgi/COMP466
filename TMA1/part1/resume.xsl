<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <html>
  <body>
  <h2>My Resume</h2>
  <table border="1">
    <tr bgcolor="#9acd32">
      <th><xsl:value-of select="firstname"/> <xsl:value-of select="lastname"/></th>
      <th><xsl:value-of select="lastname"/></th>
    </tr>
    <tr bgcolor="#9acd32">
      <th><xsl:value-of select="street"/></th>
      <th><xsl:value-of select="city"/> <xsl:value-of select="state"/></th>
      <th><xsl:value-of select="zip"/></th>
    </tr>
    <tr bgcolor="#9acd32">
      <th><xsl:value-of select="phone"/></th>
      <th><xsl:value-of select="email"/></th>
      <th><xsl:value-of select="url"/></th>
    </tr>
  </table>

  <table border="1">
    <tr bgcolor="#9acd32">
      <th><xsl:value-of select="profile"/></th>
    </tr>
    <tr bgcolor="#9acd32">
      <th><xsl:value-of select="github"/></th>
      <th><xsl:value-of select="instagram"/></th>
      <th><xsl:value-of select="youtube"/></th>
    </tr>
  </table>

  <table border="1">
    <xsl:for-each select="education/degrees">
    <tr bgcolor="#9acd32">
      <th><xsl:value-of select="level"/></th>
      <th><xsl:value-of select="major"/></th>
      <th><xsl:value-of select="institution"/></th>
    </tr>
    <tr bgcolor="#9acd32">
      <th>Grad Date: </th>
      <th><xsl:value-of select="graduationdate/month"/></th>
      <th><xsl:value-of select="graduationdate/year"/></th>
    </tr>
    <tr bgcolor="#9acd32">
      <th><xsl:value-of select="annotation"/></th>
    </tr>
    <tr bgcolor="#9acd32">
    </tr>
    </xsl:for-each>

  </table>


  <table border="1">
    <xsl:for-each select="workexperience/job">
    <tr bgcolor="#9acd32">
      <th><xsl:value-of select="jobtitle"/></th>
      <th><xsl:value-of select="employer"/></th>
    </tr>
    <tr bgcolor="#9acd32">
      <th>From <xsl:value-of select="period/from/date/month"/> <xsl:value-of select="period/from/date/year"/></th>
      <th>To <xsl:value-of select="period/to/date/month"/> <xsl:value-of select="period/to/date/year"/></th>
    </tr>
    <tr bgcolor="#9acd32">
      <th><xsl:value-of select="description"/></th>
    </tr>
    <tr bgcolor="#9acd32">
    </tr>
    </xsl:for-each>
  </table>

  </body>
  </html>
</xsl:template>

</xsl:stylesheet>