<!DOCTYPE HTML>
<html class="no-js">
<head>
<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Cedar of Lebanon | MUSTCU Alumni</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<!-- CSS
  ================================================== -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="plugins/mediaelement/mediaelementplayer.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css">
<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css" media="screen" /><![endif]-->
<!-- Color Style -->
<link class="alt" href="colors/color1.css" rel="stylesheet" type="text/css">
<link href="style-switcher/css/style-switcher.css" rel="stylesheet" type="text/css">
<!-- SCRIPTS
  ================================================== -->
<script src="js/modernizr.js"></script><!-- Modernizr -->
</head>

<style type="text/css">
	table.profile tr td{
		padding:2px;
	}
</style>

<body>
<!--[if lt IE 7]>
  <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<div class="body"> 
  <!-- Start Site Header -->
  <header class="site-header">
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6 col-xs-8">
            <h1 class="logo"> <a href="index-2.html"><img src="images/logo.png" alt="Logo"></a> </h1>
          </div>
          <div class="col-md-8 col-sm-6 col-xs-4">
            <ul class="top-navigation hidden-sm hidden-xs">
              <li>Hello {FIRST_NAME_HEADER}!</li>
            </ul>
            <a href="#" class="visible-sm visible-xs menu-toggle"><i class="fa fa-bars"></i></a> </div>
        </div>
      </div>
    </div>
    <div class="main-menu-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <nav class="navigation">
              <ul class="sf-menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">My Profile</a>
                  <ul class="dropdown">
                    <li><a href="#">Edit My profile</a></li>
                    <li><a href="#">Change My Password</a></li>
                    <li><a href="#">Invente a Friend</a></li>
                  </ul>
                </li>
                <li><a href="#">Members</a>
                  <ul class="dropdown">
                    <li><a href="#">Member List</a></li>
                    <li><a href="#">Contact List</a></li>
                  </ul>
                </li>
                <li><a href="#">Forum</a></li>
     
                <li><a href="#">Search</a></li>
                  
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Start Content -->
  <div class="main" role="main">
    <div id="content" class="content full">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <header class="single-post-header clearfix">
              <h2 class="post-title">Here is how you can reach us</h2>
            </header>
            <div class="post-content">
              <p class="label label-danger"> </p>
            
              {HEADER}
  <tr> 
    <td align="left" valign="top"> 
      <table width="740" border="0" cellspacing="0" cellpadding="0" height="300" align="center" style="margin:0 auto; width:960px;">
        <tr align="left" valign="top"> 
          <td width="150" bgcolor="#69a5a5" height="300"> 
      {NAVIGATION}
            <img src="../templates/images/border_navigation.gif" width="150" height="20"> 
          </td>
          <td width="450" height="300"><br>
            <table width="100%" border="0" class="profile" cellspacing="0" cellpadding="6" class="content_text" style="margin:0 0 0 10px;">
              <tr> 
                <td class="text" align="left" valign="top"> 
                  <!-- This is where the content starts -->
    <span class="content_headline">My Profile</span> <br />
    Privacy : {PRIVACY_DASH}
    <br><br>
    Please enter information about you here. Your profile will help other memebers of the community to identify you as their old friend. Remember: The more you give here, the more you will get from others.
    <br><br><br>
                  <form action="profile_submit.php" method="POST">
                    <table width="100%" border="0" class="text" style="font-size:14px; margin:0 0 0 10px;">
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
                        <td>Profession:</td>
                        <td> 
                          <input name="prof" type="text" size="30" maxlength="50" value="{PROFESSION}">
                        </td>
                      </tr>

                	  <tr valign="top"> 
                        <td>Marital status:</td>
                        <td> 
                         <select name="mstatus" required>
                            <option value="{MARITAL_STATUS}" selected>{MARITAL_STATUS}</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                        </select>
                        </td>
                      </tr>
                      
                      <tr valign="top"> 
                        <td>Gender:</td>
                        <td> 
                          <select name="gender">
                                <option value="{GENDER}" selected>{GENDER}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                          </select>
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
                        <td><b>At Church</b></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr valign="top">
                        <td>&nbsp;</td>
                        <td>&nbsp; </td>
                      </tr>
                      <tr valign="top">
                        <td>Church name:</td>
                        <td> 
                          <input name="church" type="text" size="30" maxlength="40" value="{CHURCH}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Pastor's Names:</td>
                        <td> 
                          <input name="pastor" type="text" size="30" maxlength="40" value="{PASTOR}">
                        </td>
                      </tr>
                      
                      
                      <tr valign="top">
                        <td>&nbsp;</td>
                        <td>&nbsp; </td>
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
                        <td>Address:</td>
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
                          
                          <select name="home_country">
                      <option value="{GENDER}" selected>{HOME_COUNTRY}</option>
                        <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Brunei">Brunei</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland (Malvinas) Islands">Falkland (Malvinas) Islands</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macau">Macau</option>
                            <option value="Macedonia">Macedonia</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia">Micronesia</option>
                            <option value="Moldova">Moldova</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="North Korea">North Korea</option>
                            <option value="Northern Marianas">Northern Marianas</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestine">Palestine</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russian Federation">Russian Federation</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Helena">Saint Helena</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Korea">South Korea</option>
                            <option value="South Sudan">South Sudan</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syria</option>
                            <option value="Taiwan">Taiwan</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States of America">United States of America</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                            <option value="Democratic Republic of Congo">Democratic Republic of Congo</option>
                                        
                    </select>
                          
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Phone:</td>
                        <td> 
                          <input name="home_phone" type="text" size="30" maxlength="30" value="{HOME_PHONE}">
                        </td>
                      </tr>
                      <tr valign="top"> 
                        <td>Tel Phone:</td>
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
                        <td>Term:</td>
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
                    <input type="checkbox" name="priv" value="{PRIVACY}" checked>
				Allow to share my information with other cedars </p>
                    <input type="radio" name="send_info" value="yes" checked>&nbsp;Inform my contacts about these changes!<br>
                    <input type="radio" name="send_info" value="no">&nbsp;Do NOT inform my contacts about these changes!
        <br><br>
                  <p align="right" style="margin:0 15px 0 0;"><input type="image" src="../templates/images/update.gif" name="Update" border="0"></p>
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
     
          </td>
          <td width="140" bgcolor="#CCCCCC" height="50">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>

            </div>
          </div>
          <!-- Start Sidebar -->
          <div class="col-md-3 sidebar">
            <div class="widget-upcoming-events widget">
              <div class="sidebar-widget-title">
                <h3>Upcoming Events</h3>
              </div>
              <ul>
                {SPONSORS}
              </ul>
            </div>
            <!-- Recent Posts Widget -->
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Start Footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="row"> 
        <!-- Start Footer Widgets -->
        <div class="col-md-4 col-sm-4 widget footer-widget">
          <h4 class="footer-widget-title">About our Church</h4>
          <img src="images/logo.png" alt="Logo">
          <div class="spacer-20"></div>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis consectetur adipiscing elit. Nulla convallis egestas rhoncus</p>
        </div>
        <div class="col-md-4 col-sm-4 widget footer-widget">
          <h4 class="footer-widget-title">Blogroll</h4>
          <ul>
            <li><a href="index-2.html">Church Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="events.html">All Events</a></li>
            <li><a href="sermons.html">Sermons Archive</a></li>
            <li><a href="blog-masonry.html">Our Blog</a></li>
          </ul>
        </div>
        <div class="col-md-4 col-sm-4 widget footer-widget">
          <h4 class="footer-widget-title">Our Church on twitter</h4>
          <ul class="twitter-widget">
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <footer class="site-footer-bottom">
    <div class="container">
      <div class="row">
        <div class="copyrights-col-left col-md-6 col-sm-6">
          <p>&copy; 2014 NativeChurch. All Rights Reserved</p>
        </div>
        <div class="copyrights-col-right col-md-6 col-sm-6">
          <div class="social-icons"> <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a> <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a> <a href="http://www.pinterest.com/" target="_blank"><i class="fa fa-pinterest"></i></a> <a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a> <a href="http://www.pinterest.com/" target="_blank"><i class="fa fa-youtube"></i></a> <a href="#"><i class="fa fa-rss"></i></a> </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer --> 
</div>
<script src="js/jquery-2.0.0.min.js"></script> <!-- Jquery Library Call --> 
<script src="plugins/prettyphoto/js/prettyphoto.js"></script> <!-- PrettyPhoto Plugin --> 
<script src="js/helper-plugins.js"></script> <!-- Plugins --> 
<script src="js/bootstrap.js"></script> <!-- UI --> 
<script src="js/waypoints.js"></script> <!-- Waypoints --> 
<script src="plugins/mediaelement/mediaelement-and-player.min.js"></script> <!-- MediaElements --> 
<script src="js/init.js"></script> <!-- All Scripts --> 
<script src="plugins/flexslider/js/jquery.flexslider.js"></script> <!-- FlexSlider --> 
<script src="plugins/countdown/js/jquery.countdown.min.js"></script> <!-- Jquery Timer --> 
<script src="style-switcher/js/jquery_cookie.js"></script> 
<script src="style-switcher/js/script.js"></script> 

</body>
</html>