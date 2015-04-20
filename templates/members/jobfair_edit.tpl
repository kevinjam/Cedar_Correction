{HEADER}
  <tr> 
    <td align="left" valign="top"> 
      <table width="740" border="0" cellspacing="0" cellpadding="0" height="300" align="center" style="margin:0 auto; width:960px;">
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
		<span class="content_headline">Edit Job Offer</span><br><br>
		Please update the information in the form below.
		<br><br>
                    <form action="{FORM_LINK}" method="POST">
                    <table width="100%" border="0" class="text">
                      <tr valign="top"> 
                        <td>Company:</td>
                        <td> 
                          <input name="company" type="text" size="30" maxlength="30" value="{COMPANY}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Industry:</td>
                        <td> 
                          <input name="job_industry" type="text" size="30" maxlength="30" value="{JOB_INDUSTRY}">
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Title:</td>
                        <td> 
                          <input name="title" type="text" size="30" maxlength="30" value="{TITLE}">
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Salary:</td>
                        <td> 
                          <input name="salary" type="text" size="30" maxlength="20" value="{SALARY}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>City:</td>
                        <td> 
                          <input name="city" type="text" size="30" maxlength="30" value="{CITY}">
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Country:</td>
                        <td>
                          <input name="country" type="text" size="30" maxlength="30" value="{COUNTRY}">
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Description:</td>
                        <td>
                          <textarea name="description" wrap="virtual" cols="30" rows="5">{DESCRIPTION}</textarea>
			  <br>
			  <br>
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Prerequisites:</td>
                        <td>
                          <textarea name="prerequisites" wrap="virtual" cols="30" rows="5">{PREREQUISITES}</textarea>
			  <br>
			  <br>
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Benefits:</td>
                        <td>
                          <textarea name="benefits" wrap="virtual" cols="30" rows="5">{BENEFITS}</textarea>
			  <br>
			  <br>
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Experience:</td>
                        <td>
                          <select name="experience" size="1">
                            <option value="{EXPERIENCE}" selected>{EXPERIENCE}</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select> Years
                        </td>
                      </tr>
                      <tr valign="top">
                        <td>Start:</td>
                        <td>
                          <select name="start_date_month" size="1">
                            <option value="{START_DATE_MONTH}" selected>{START_DATE_MONTH}</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                          </select>&nbsp;
                          <select name="start_date_year" size="1">
                            <option value="{START_DATE_YEAR}" selected>{START_DATE_YEAR}</option>
                            <option value="2003">2003</option>
                            <option value="2004">2004</option>
                            <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
                            <option value="2008">2008</option>
                          </select><br><br>
                        </td>
                      </tr>
                       <tr valign="top">
                        <td>Contact:</td>
                        <td>
                          <input name="contact" type="text" size="30" maxlength="40" value="{CONTACT}">
                        </td>
                      </tr>
                       <tr align="right">
                        <td>&nbsp;</td>
                        <td>
                    <br>
                    {DELETE}&nbsp;&nbsp;<input type="image" src="../templates/images/save.gif" name="OK" border="0">
                        </td>
                      </tr>
                   </table>
                  </form>
                  <p align="right"> 
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
