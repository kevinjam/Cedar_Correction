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
		<span class="content_headline">Write Email Newsletter</span><br><br>
		You can write newsletters to all registered members_index. All newsletters are archived in the database.
		<br><br><br>
		<form action="newsletter_confirm.php" method="POST">
			<b>Recipients:</b><br><br>
			<table>
			{RECIPIENTS}
			</table>
			<br><br>
			Subject:<br>
			<input name="subject" type="text" size="50" maxlength="255"><br><br>
			Text:<br>
			<textarea name="body" cols="50" rows="15" wrap="virtual"></textarea>
			<br><br>
			<input type="image" src="../templates/images/submit.gif" border="0" name="OK">
		</form>

		<br><br><hr width="30%">
		<span class="content_headline">Newsletter Archive</span><br><br><br>
		  <table width="100%" class="content_text">
                    <!-- BEGIN TPL_ROW -->
                    <tr><td bgcolor="#69A5A5"><font color="#FFFFFF"><b>{SUBJECT}</b>&nbsp;sent&nbsp;on&nbsp;<b>{DATE}</b></font></td></tr>
		    <tr><td width="100"><b>Recipients: </b>{RECIPIENTS_LIST}<hr width="20%"></td></tr>
		    <tr><td width="400">{BODY}</td></tr>
		    <tr><td width="400">&nbsp;</td></tr>
                    <!-- END TPL_ROW -->
                  </table>
		  <br>
		  <p align="center">{BROWSE_URL}</p>

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
