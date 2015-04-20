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
		<span class="content_headline">Forums</span><br><br>
		You are in the section: <b>{SECTION}</b><br><br>
		Go back to the <a href="forum_index.php" class="content_link">Index</a>
		<br><br><hr width="30%"><br>
		<table width="100%">
		<!-- BEGIN TPL_ROW -->
		<tr><td bgcolor="#69A5A5"><font color="#FFFFFF"><b>{TITLE}</b>&nbsp;by&nbsp;<b>{AUTHOR}</b>&nbsp;on&nbsp;<b>{DATE}</b></font></td></tr>
		<tr><td>{MESSAGE}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<!-- END TPL_ROW -->
		</table>

		<br><br>

		<b>Reply to this message:</b><br><br>
		<form action="{POST_ACTION}" method="POST">
			Title:<br>
			<input name="title" type="text" size="50" maxlength="255" value="{FORM_TITLE}"><br>
			Message:<br>
			<textarea name="message" cols="50" rows="10" wrap="virtual"></textarea><br>
			<br><br>
			<input type="image" src="../templates/images/ok.gif" border="0" name="OK">
		</form>
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
          <td width="150" bgcolor="#69a5a5" height="50" align="center"><a href="#" target="_blank"></td>
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
