{HEADER}
  <tr> 
    <td align="left" valign="top"> 
      <table width="740" border="0" cellspacing="0" cellpadding="0" height="300" align="left">
        <tr align="left" valign="top"> 
          <td width="150" bgcolor="#69a5a5" height="300"> 
			{NAVIGATION}
            <img src="../templates/images/border_navigation.gif" width="150" height="20"> 
          </td>
          <td width="450" height="300"><img src="../templates/images/border_content_bottom.gif" width="450" height="20"><br>
            <table width="100%" border="0" cellspacing="0" cellpadding="6" class="content_text">
              <tr> 
                <td align="left" valign="top">
                  <!-- This is where the content starts -->
		<span class="content_headline">Publish Newsflash on Homepage</span><br><br>
		Post newsflashes which will appear on the homepage in the members' section.
		<br><br><br>
		<form action="{POST_ACTION}" method="POST">
			Headline:<br>
			<input name="headline" type="text" size="50" maxlength="255" value="{EDIT_HEADLINE}"><br><br>
			Message:<br>
			<textarea name="body" cols="50" rows="12" wrap="virtual">{EDIT_BODY}</textarea><br>
			<br><br>
			<input type="image" src="../templates/images/ok.gif" border="0" name="OK">
		</form>

		<br><br><hr width="30%"><br>
		<span class="content_headline">Newsflash Preview</span><br><br>
		  <table width="100%" class="content_text">
                    <!-- BEGIN TPL_ROW -->
                    <tr><td bgcolor="#69A5A5"><font color="#FFFFFF"><b>{DISPLAY_HEADLINE}</b>&nbsp;on&nbsp;<b>{DISPLAY_DATE}</b></font></td></tr>
		    <tr><td>{DISPLAY_BODY}</td></tr>
		    <tr align="right"><td>{EDIT}&nbsp;&nbsp;{DELETE}</td></tr>
                    <!-- END TPL_ROW -->
                  </table>
		  <br><br>
		  <p align="center">{BROWSE_URL}</p>
                </td>
              </tr>
            </table>
          </td>
          <td width="140" bgcolor="#CCCCCC" height="300"><img src="../templates/images/border_sponsors_bottom.gif" width="140" height="20"><br>
          {SPONSORS}
          </td>
        </tr>
        <tr align="left" valign="middle"> 
          <td width="150" bgcolor="#69a5a5" height="50" align="center"><a href="http://www.phpalumni.org" target="_blank"><img src="../templates/images/phpAlumni.gif" width="107" height="47" border="0" alt="Go to homepage!"></a></td>
          <td width="450" height="50">
		  {FOOTER}
          </td>
          <td width="140" bgcolor="#CCCCCC" height="50">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
