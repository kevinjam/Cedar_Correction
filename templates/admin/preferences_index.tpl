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
                <td class="text" align="left" valign="top"> 
                  <!-- This is where the content starts -->
		<span class="content_headline">Preferences</span><br><br>
		Subgroups are useful to organize members and control newsletter recipients.
		<br><br><br>
		<form action="{POST_ACTION}" method="POST">
			Add new subgroup:<br><br>
			<input name="subgroup" type="text" size="40" maxlength="40" value="{EDIT_SUBGROUP}"><br>
			<br>
			<input type="image" src="../templates/images/ok.gif" border="0" name="OK">
		</form>
		<br><br>
		  <table class="content_text" width="100%">
                    <!-- BEGIN TPL_ROW -->
		    <tr><td>{DISPLAY_SUBGROUP}</td><td>{DELETE}</td></tr>
                    <!-- END TPL_ROW -->
                  </table>
		<br><br>
		  <!-- This is where the content ends -->
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
