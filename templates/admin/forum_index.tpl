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
		<span class="content_headline">Forum Administration</span><br><br>
		Add new forums or delete unwanted member messages.
		<br><br><br>
		    <!-- BEGIN TPL_ROW -->
		  <b>{TITLE}</b>&nbsp;&nbsp;({MESSAGE_COUNT} Messages in {THREAD_COUNT} Threads)<br>
		  <i>{DESCRIPTION}</i>
		  <p align="right">{DELETE}</p><br>
                    <!-- END TPL_ROW -->
		<br><br>
		<b>Open a new forum:</b><br><br>

		<form action="forum_index.php" method="POST">
			Name:<br>
			<input name="title" type="text" size="50" maxlength="255"><br><br>
			Description:<br>
			<input name="description" type="text" size="50" maxlength="255"><br><br>
			<input type="image" src="../templates/images/ok.gif" border="0" name="OK">
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
