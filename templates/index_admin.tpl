{HEADER}
  <tr> 
    <td align="left" valign="top"> 
      <table width="740" border="0" cellspacing="0" cellpadding="0" height="300" align="center" style="margin:0 auto; width:960px;">
        <tr align="left" valign="top"> 
          <td width="150" bgcolor="#69a5a5" height="300"> 
			{NAVIGATION}
          </td>
          <td width="450" height="300"><br>
            <table width="100%" border="0" cellspacing="0" cellpadding="6" class="content_text">
              <tr> 
                <td class="text" align="left" valign="top"> 
                  <!-- This is where the content starts -->
		<span class="content_headline">Admin Login</span><br><br>
		Came here by accident? Please <a href="index.php">click here</a> to log in and access all features!
		<br><br>
		<form action="login_admin.php" method="POST">
			<p>Login:<br>
			<input name="login" type="text" size="30" maxlength="20">
			</p>
			Password:<br>
			<input name="password" type="password" size="30" maxlength="20">
			<br><br>
			<input type="image" src="templates/images/login.gif" name="image" border="0">
		</form>

	<!-- This is where the content ends -->
                </td>
              </tr>
            </table>
          </td>
          <td width="140" bgcolor="#CCCCCC" height="300"><img src="templates/images/border_sponsors_bottom.gif" width="140" height="20"><br>
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
