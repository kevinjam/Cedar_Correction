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
		<span class="content_headline">Forums</span><br><br>
		You are in section: <b>{SECTION}</b><br><br>
		Go back to the <a href="forum_index.php" class="content_link">Index</a>.
		<br><br><hr width="30%"><br>
		  <table width="100%">
                    <tr>
                      <td><b>Topic</b></td>
                      <td><b>Author</b></td>
                      <td align="right"><b>Replys</b></td>
                      <td align="right"><b>Last Entry</b></td>
                      <td align="right">&nbsp;</td>
                    </tr>
                    <!-- BEGIN TPL_ROW -->
                    <tr>
                      <td>{TITLE}</td>
                      <td>{AUTHOR}</td>
                      <td align="right">{ANSWERS}</td>
                      <td align="right">{LAST_MESSAGE}</td>
                    </tr>
                    <!-- END TPL_ROW -->
                  </table>
<br><br><br>
		<b>Open new thread:</b><br><br>
		<form action="{POST_ACTION}" method="POST">
			Topic:<br>
			<input name="title" type="text" size="50" maxlength="255"><br>
			Message:<br>
			<textarea name="message" cols="50" rows="10" wrap="virtual"></textarea><br>
			<br>
			<p ><input type="image" src="../templates/images/ok.gif" border="0" name="OK"></p>
		</form>
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
