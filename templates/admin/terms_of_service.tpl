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
		<span class="content_headline">Terms of service</span><br><br>
		Current Document : {CURRENT_FILE_NAME}
		<br><br><br>
		<form action="{POST_ACTION}" method="POST" enctype="multipart/form-data">
        	<input type="hidden" name="file_upload">
			<input name="file" type="file" required><br><br>
			<input type="image" src="../templates/images/ok.gif" border="0" name="upload">
		</form>

		<br><br>
		  <table width="100%" class="content_text">
                    <!-- BEGIN TPL_ROW -->
                    <tr><td bgcolor="#69A5A5"><font color="#FFFFFF"><b>{DISPLAY_HEADLINE}</b>&nbsp;on&nbsp;<b>{DISPLAY_DATE}</b></font></td></tr>
		    <tr><td>{DISPLAY_BODY}</td></tr>
		    <tr align="right"><td>{EDIT}&nbsp;&nbsp;{DELETE}</td></tr>
                    <!-- END TPL_ROW -->
                  </table>
		  <br><br>
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
