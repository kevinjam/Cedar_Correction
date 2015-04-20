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
 		<span class="content_headline">Edit Member Profile</span><br><br>
		Corrections in member profiles can be done here
		<br><br><br>
                  <form action="members_index.php" method="POST">
                    <table width="100%" border="0" class="text">
                      <tr valign="top">
                        <td>First Name:</td>
                        <td>
                          <input name="first_name" type="text" size="30" maxlength="30" value="{FIRST_NAME}">
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Last Name:</td>
                        <td>
                          <input name="last_name" type="text" size="30" maxlength="30" value="{LAST_NAME}">
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Email:</td>
                        <td>
                          <input name="email" type="text" size="30" maxlength="50" value="{EMAIL}">
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>&nbsp;</td>
                        <td>&nbsp; </td>
                      </tr>
                      <tr valign="top">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr valign="top">
                        <td><b>At Home</b></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr valign="top">
                        <td>&nbsp;</td>
                        <td>&nbsp; </td>
                      </tr>
                      <tr valign="top">
                        <td>Aderess:</td>
                        <td> 
                          <input name="home_address" type="text" size="30" maxlength="40" value="{HOME_ADDRESS}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>2. Address Row:</td>
                        <td> 
                          <input name="home_address_extra" type="text" size="30" maxlength="40" value="{HOME_ADDRESS_EXTRA}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>ZIP:</td>
                        <td> 
                          <input name="home_zip" type="text" size="10" maxlength="10" value="{HOME_ZIP}">
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>City:</td>
                        <td>
                          <input name="home_city" type="text" size="30" maxlength="30" value="{HOME_CITY}">
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>State:</td>
                        <td>
                          <input name="home_state" type="text" size="30" maxlength="30" value="{HOME_STATE}">
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Country:</td>
                        <td> 
                          <input name="home_country" type="text" size="30" maxlength="30" value="{HOME_COUNTRY}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Telephon:</td>
                        <td> 
                          <input name="home_phone" type="text" size="30" maxlength="30" value="{HOME_PHONE}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Cellphone:</td>
                        <td> 
                          <input name="home_cellphone" type="text" size="30" maxlength="30" value="{HOME_CELLPHONE}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Birthday {BIRTHDAY_FORMAT} :</td>
                        <td> 
                          <input name="birthday" type="text" size="10" maxlength="10" value="{BIRTHDAY}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Homepage:</td>
                        <td> 
                          <input name="home_homepage" type="text" size="30" maxlength="40" value="{HOME_HOMEPAGE}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Year:</td>
                        <td> 
                          <select name="year" size="1">
                            <option value="{YEAR}" selected>{YEAR}</option>
                            <option value="1995">1995</option>
                            <option value="1996">1996</option>
                            <option value="1997">1997</option>
                            <option value="1998">1998</option>
                            <option value="1999">1999</option>
                            <option value="2000">2000</option>
                            <option value="2001">2001</option>
                            <option value="2002">2002</option>
                            <option value="2003">2003</option>
                            <option value="2004">2004</option>
                            <option value="2005">2005</option>
                          </select>
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Term</td>
                        <td>
                          <select name="term" size="1">
                            <option value="{TERM}" selected>{TERM}</option>
                            <option value="Winter">Winter</option>
                            <option value="Summer">Summer</option>
                          </select>
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Majors:</td>
                        <td>
                          <textarea name="majors" cols="30" rows="5" wrap="virtual">{MAJORS}</textarea>
			  <br><br>
                        </td>
                      </tr>
                        <td>Group:</td>
                        <td>
                          <select name="subgroup" size="1">
				{SUBGROUP}
                          </select>
			</td>
                      </tr>
                      <tr valign="top">
                        <td>Other Info:</td>
                        <td>
                          <textarea name="home_other_info" wrap="virtual" cols="30" rows="5">{HOME_OTHER_INFO}</textarea>
			  <br>
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>&nbsp;</td>
                        <td>&nbsp; </td>
                      </tr>
                      <tr valign="top">
                        <td>&nbsp;</td>
                        <td>&nbsp; </td>
                      </tr>
                      <tr valign="top">
                        <td><b>At Work</b></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr valign="top">
                        <td>&nbsp;</td>
                        <td>&nbsp; </td>
                      </tr>
                      <tr valign="top">
                        <td>Company:</td>
                        <td> 
                          <input name="company_name" type="text" size="30" maxlength="30" value="{COMPANY_NAME}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Position:</td>
                        <td> 
                          <input name="position" type="text" size="30" maxlength="30" value="{POSITION}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Industry:</td>
                        <td> 
                          <input name="industry" type="text" size="30" maxlength="30" value="{INDUSTRY}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Address:</td>
                        <td> 
                          <input name="company_address" type="text" size="30" maxlength="30" value="{COMPANY_ADDRESS}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>2. Address Row:</td>
                        <td> 
                          <input name="company_address_extra" type="text" size="30" maxlength="30" value="{COMPANY_ADDRESS_EXTRA}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>ZIP:</td>
                        <td> 
                          <input name="company_zip" type="text" size="10" maxlength="10" value="{COMPANY_ZIP}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>City:</td>
                        <td>
                          <input name="company_city" type="text" size="30" maxlength="30" value="{COMPANY_CITY}">
                        </td>
                      </tr>
                        <td>State:</td>
                        <td>
                          <input name="company_state" type="text" size="30" maxlength="30" value="{COMPANY_STATE}">
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Country:</td>
                        <td>
                          <input name="company_country" type="text" size="30" maxlength="30" value="{COMPANY_COUNTRY}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Phone:</td>
                        <td> 
                          <input name="company_phone" type="text" size="30" maxlength="30" value="{COMPANY_PHONE}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Cellphone:</td>
                        <td> 
                          <input name="company_cellphone" type="text" size="30" maxlength="30" value="{COMPANY_CELLPHONE}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Homepage:</td>
                        <td> 
                          <input name="company_homepage" type="text" size="30" maxlength="40" value="{COMPANY_HOMEPAGE}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Company Description:</td>
                        <td>
                          <textarea name="company_description" cols="30" rows="5">{COMPANY_DESCRIPTION}</textarea>
			  <br><br>
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Other Info:</td>
                        <td>
                          <textarea name="company_other_info" cols="30" rows="5">{COMPANY_OTHER_INFO}</textarea>
			  <br>
                        </td>
                      </tr>
                    </table>
		    <br><br>
                  <p align="right">{DELETE_BUTTON}&nbsp;&nbsp;{UPDATE_BUTTON}</p>

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
