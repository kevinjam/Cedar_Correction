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
		<span class="content_headline">Member List</span><br><br>
		All members of the network can be found in this list. Their profiles can be edited or you can delete a member record.
		<br><br><br>
                   <b>Browse by last name:</b><br>
                    <!-- Add lines for special characters e.g. ä, ö, ü... if needed -->
		<a href="members_index.php?start_letter=A" class="content_link">A</a>&nbsp;<a href="members_index.php?start_letter=B" class="content_link">B</a>&nbsp;<a href="members_index.php?start_letter=C" class="content_link">C</a>&nbsp;<a href="members_index.php?start_letter=D" class="content_link">D</a>&nbsp;<a href="members_index.php?start_letter=E" class="content_link">E</a>&nbsp;<a href="members_index.php?start_letter=F" class="content_link">F</a>&nbsp;<a href="members_index.php?start_letter=G" class="content_link">G</a>&nbsp;<a href="members_index.php?start_letter=H" class="content_link">H</a>&nbsp;<a href="members_index.php?start_letter=I" class="content_link">&nbsp;I</a>&nbsp;<a href="members_index.php?start_letter=J" class="content_link">J</a>&nbsp;<a href="members_index.php?start_letter=K" class="content_link">K</a>&nbsp;<a href="members_index.php?start_letter=L" class="content_link">L</a>&nbsp;<a href="members_index.php?start_letter=M" class="content_link">M</a>&nbsp;<a href="members_index.php?start_letter=N" class="content_link">N</a>&nbsp;<a href="members_index.php?start_letter=O" class="content_link">O</a>&nbsp;<a href="members_index.php?start_letter=P" class="content_link">P</a>&nbsp;<a href="members_index.php?start_letter=Q" class="content_link">Q</a>&nbsp;<a href="members_index.php?start_letter=R" class="content_link">R</a>&nbsp;<a href="members_index.php?start_letter=S" class="content_link">S</a>&nbsp;<a href="members_index.php?start_letter=T" class="content_link">T</a>&nbsp;<a href="members_index.php?start_letter=U" class="content_link">U</a>&nbsp;<a href="members_index.php?start_letter=V" class="content_link">V</a>&nbsp;<a href="members_index.php?start_letter=W" class="content_link">W</a>&nbsp;<a href="members_index.php?start_letter=X" class="content_link">X</a>&nbsp;<a href="members_index.php?start_letter=Y" class="content_link">Y</a>&nbsp;<a href="members_index.php?start_letter=Z" class="content_link">Z</a>
                  <br><br>
		  <table width="100%">
                    <tr>
                      <td><b>Last Name, First Name</b></td>
                      <td><b>Year</b></td>
                      <td><b>Term</b></td>
                      <td><b>&nbsp;</b></td>
                    </tr>
                    <!-- BEGIN TPL_ROW -->
                    <tr>
                      <td>{MEMBERS_NAME}</td>
                      <td>{MEMBERS_YEAR}</td>
                      <td>{MEMBERS_TERM}</td>
                      <td>{MEMBERS_DELETE}</td>
                    </tr>
                    <!-- END TPL_ROW -->
                  </table>
                  <p align="center">{PREVIOUS} {NEXT}</p>
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
