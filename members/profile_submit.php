<?php

/*
############################################################################
phpAlumni - A web-based, MySQL-backed alumni management program written in PHP4.
Copyright (C) 2002-2005 Ralf Hetzer

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
############################################################################

filename: members/profile_submit.php
release_version: 1.4
last_change: 20041220
description: checks the validity of some profile fields and updates the DB after a user updated his/her profile
[anchor]

*/



session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if user is logged-in

require_once("verify_login.php");




// cleans up the users' input

$first_name = clean_input($_POST['first_name']);
$last_name = clean_input($_POST['last_name']);
$email = clean_input($_POST['email']);
$home_address = clean_input($_POST['home_address']);
$home_address_extra = clean_input($_POST['home_address_extra']);
$home_zip = clean_input($_POST['home_zip']);
$home_city = clean_input($_POST['home_city']);
$home_state = clean_input($_POST['home_state']);
$home_country = clean_input($_POST['home_country']);
$home_phone = clean_input($_POST['home_phone']);
$home_cellphone = clean_input($_POST['home_cellphone']);
$birthday = clean_input($_POST['birthday']);
$home_homepage = clean_input($_POST['home_homepage']);
$year = clean_input($_POST['year']);
$term = clean_input($_POST['term']);
$home_other_info = clean_input($_POST['home_other_info']);
$majors = clean_input($_POST['majors']);
$company_name = clean_input($_POST['company_name']);
$position = clean_input($_POST['position']);
$industry = clean_input($_POST['industry']);
$company_address = clean_input($_POST['company_address']);
$company_address_extra = clean_input($_POST['company_address_extra']);
$company_zip = clean_input($_POST['company_zip']);
$company_city = clean_input($_POST['company_city']);
$company_state = clean_input($_POST['company_state']);
$company_country = clean_input($_POST['company_country']);
$company_phone = clean_input($_POST['company_phone']);
$company_cellphone = clean_input($_POST['company_cellphone']);
$company_homepage = clean_input($_POST['company_homepage']);
$company_description = clean_input($_POST['company_description']);
$company_other_info = clean_input($_POST['company_other_info']);
$subgroup = clean_input($_POST['subgroup']);

$church = clean_input($_POST['church']);
$pastor = clean_input($_POST['pastor']);
$gender = clean_input($_POST['gender']);

$prof = clean_input($_POST['prof']);
$mstatus = clean_input($_POST['mstatus']);
$priv = clean_input($_POST['priv']);
$priv = (empty($priv))? 0:1;



// check if the email address is valid

//if (check_email($email)) die("The emailadress is not valid! Please hit the BACK button and check it!");

check_email2($email);


// checks if the user opted out of informing the others of the profile change

if($_POST['send_info'] == 'yes') {

	// gets old data from DB to include it in the emails

	$sql = "SELECT first_name, last_name, email, prof, mstatus, priv, home_address, home_address_extra, home_zip, home_city, home_state, home_country, home_phone, home_cellphone, gender, church, pastor, birthday, home_homepage, year, term, home_other_info, majors, company_name, position, industry, company_address, company_address_extra, company_zip, company_city, company_state, company_country, company_phone, company_cellphone, company_homepage, company_description, company_other_info FROM members WHERE id='".$_SESSION['IDtag'][0]."'";
	$result = mysql_query($sql)
		or die ("Could not retrieve data from DB!");

	$row = mysql_fetch_array($result)		// array with the old data
		or die ("Could not put result row in the variable!");



	// replaces the placeholders with the new data

	$mail_text_profile_update = str_replace("[FIRST_NAME_2]", $row[0], $mail_text_profile_update);
	$mail_text_profile_update = str_replace("[LAST_NAME_2]", $row[1], $mail_text_profile_update);
	
	$first_name_2 = $row['first_name']." -> ".$first_name;
	$mail_text_profile_update = str_replace("[FIRST_NAME]", $first_name_2, $mail_text_profile_update);
	
	$last_name_2 = $row['last_name']." -> ".$last_name;
	$mail_text_profile_update = str_replace("[LAST_NAME]", $last_name_2, $mail_text_profile_update);
	
	$prof_2 = $row['prof']." -> ".$priv;
	$mail_text_profile_update = str_replace("[PROFESSION]", $prof_2, $mail_text_profile_update);
	
	$mstatus_2 = $row['prof']." -> ".$mstatus;
	$mail_text_profile_update = str_replace("[MARITAL_STATUS]", $mstatus_2, $mail_text_profile_update);
	
	$email_2 = $row['email']." -> ".$email;
	$mail_text_profile_update = str_replace("[EMAIL]", $email_2, $mail_text_profile_update);
	$home_address_2 = $row['home_address']." -> ".$home_address;
	$mail_text_profile_update = str_replace("[HOME_ADDRESS]", $home_address_2, $mail_text_profile_update);
	$home_address_extra_2 = $row['home_address_extra']." -> ".$home_address_extra;
	$mail_text_profile_update = str_replace("[HOME_ADDRESS_EXTRA]", $home_address_extra_2, $mail_text_profile_update);
	$home_zip_2 = $row['home_zip']." -> ".$home_zip;
	$mail_text_profile_update = str_replace("[HOME_ZIP]", $home_zip_2, $mail_text_profile_update);
	$home_city_2 = $row['home_city']." -> ".$home_city;
	$mail_text_profile_update = str_replace("[HOME_CITY]", $home_city_2, $mail_text_profile_update);
	$home_state_2 = $row['home_state']." -> ".$home_state;
	$mail_text_profile_update = str_replace("[HOME_STATE]", $home_state_2, $mail_text_profile_update);
	$home_country_2 = $row['home_country']." -> ".$home_country;
	$mail_text_profile_update = str_replace("[HOME_COUNTRY]", $home_country_2, $mail_text_profile_update);
	$home_phone_2 = $row['home_phone']." -> ".$home_phone;
	$mail_text_profile_update = str_replace("[HOME_PHONE]", $home_phone_2, $mail_text_profile_update);
	$home_cellphone_2 = $row['home_cellphone']." -> ".$home_cellphone;
	$mail_text_profile_update = str_replace("[HOME_CELLPHONE]", $home_cellphone_2, $mail_text_profile_update);
	
	$gender_2 = $row['gender']." -> ".$gender;
	$mail_text_profile_update = str_replace("[GENDER]", $gender_2, $mail_text_profile_update);
	
	$church_2 = $row['church']." -> ".$church;
	$mail_text_profile_update = str_replace("[CHURCH]", $church_2, $mail_text_profile_update);
	
	$pastor_2 = $row['pastor']." -> ".$pastor;
	$mail_text_profile_update = str_replace("[PASTOR]", $pastor_2, $mail_text_profile_update);
	
	
	
	$birthday_2 = db_to_form($row['birthday'], $date_format)." -> ".$birthday;
	$mail_text_profile_update = str_replace("[BIRTHDAY]", $birthday_2, $mail_text_profile_update);
	$home_homepage_2 = $row['home_homepage']." -> ".$home_homepage;
	$mail_text_profile_update = str_replace("[HOME_HOMEPAGE]", $home_homepage_2, $mail_text_profile_update);
	$year_2 = $row['year']." -> ".$year;
	$mail_text_profile_update = str_replace("[YEAR]", $year_2, $mail_text_profile_update);
	$term_2 = $row['term']." -> ".$term;
	$mail_text_profile_update = str_replace("[TERM]", $term_2, $mail_text_profile_update);
	$home_other_info_2 = $row['home_other_info']." -> ".$home_other_info;
	$mail_text_profile_update = str_replace("[HOME_OTHER_INFO]", $home_other_info_2, $mail_text_profile_update);
	$majors_2 = $row['majors']." -> ".$majors;
	$mail_text_profile_update = str_replace("[MAJORS]", $majors_2, $mail_text_profile_update);
	$company_name_2 = $row['company_name']." -> ".$company_name;
	$mail_text_profile_update = str_replace("[COMPANY_NAME]", $company_name_2, $mail_text_profile_update);
	$position_2 = $row['position']." -> ".$position;
	$mail_text_profile_update = str_replace("[POSITION]", $position_2, $mail_text_profile_update);
	$industry_2 = $row['industry']." -> ".$industry;
	$mail_text_profile_update = str_replace("[INDUSTRY]", $industry_2, $mail_text_profile_update);
	$company_address_2 = $row['company_address']." -> ".$company_address;
	$mail_text_profile_update = str_replace("[COMPANY_ADDRESS]", $company_address_2, $mail_text_profile_update);
	$company_address_extra_2 = $row['company_address_extra']." -> ".$company_address_extra;
	$mail_text_profile_update = str_replace("[COMPANY_ADDRESS_EXTRA]", $company_address_extra_2, $mail_text_profile_update);
	$company_zip_2 = $row['company_zip']." -> ".$company_zip;
	$mail_text_profile_update = str_replace("[COMPANY_ZIP]", $company_zip_2, $mail_text_profile_update);
	$company_city_2 = $row['company_city']." -> ".$company_city;
	$mail_text_profile_update = str_replace("[COMPANY_CITY]", $company_city_2, $mail_text_profile_update);
	$company_state_2 = $row['company_state']." -> ".$company_state;
	$mail_text_profile_update = str_replace("[COMPANY_STATE]", $company_state_2, $mail_text_profile_update);
	$company_country_2 = $row['company_country']." -> ".$company_country;
	$mail_text_profile_update = str_replace("[COMPANY_COUNTRY]", $company_country_2, $mail_text_profile_update);
	$company_phone_2 = $row['company_phone']." -> ".$company_phone;
	$mail_text_profile_update = str_replace("[COMPANY_PHONE]", $company_phone_2, $mail_text_profile_update);
	$company_cellphone_2 = $row['company_cellphone']." -> ".$company_cellphone;
	$mail_text_profile_update = str_replace("[COMPANY_CELLPHONE]", $company_cellphone_2, $mail_text_profile_update);
	$company_homepage_2 = $row['company_homepage']." -> ".$company_homepage;
	$mail_text_profile_update = str_replace("[COMPANY_HOMEPAGE]", $company_homepage_2, $mail_text_profile_update);
	$company_description_2 = $row['company_description']." -> ".$company_description;
	$mail_text_profile_update = str_replace("[COMPANY_DESCRIPTION]", $company_description_2, $mail_text_profile_update);
	$company_other_info_2 = $row['company_other_info']." -> ".$company_other_info;
	$mail_text_profile_update = str_replace("[COMPANY_OTHER_INFO]", $company_other_info_2, $mail_text_profile_update);

	$mail_header = str_replace("[ADMIN_EMAIL]", $admin_email, $mail_header);


	
	// gets all contacts from the DB

	$sql = "SELECT first_name, last_name, email FROM members LEFT JOIN contacts ON (members.id=contacts.initiator AND contacts.recipient='".$_SESSION['IDtag'][0]."') OR (members.id=contacts.recipient AND contacts.initiator='".$_SESSION['IDtag'][0]."') WHERE contacts.acceptance='1'";
	$result_2 = mysql_query($sql)
		or die ("Could not retrieve contacts from DB!");



	// finish mail text and send them out

	while($row_2 = mysql_fetch_array($result_2)) {
		
		$mail_text_profile_update = str_replace("[FIRST_NAME_1]", $row_2[0], $mail_text_profile_update);
		$mail_text_profile_update = str_replace("[LAST_NAME_1]", $row_2[1], $mail_text_profile_update);

		send_email($row_2[2], $mail_subject_profile_update, $mail_text_profile_update, $mail_header);
	}
}



// converts the human readable date to MySQL readable format

$birthday_sql = form_to_db($birthday, $date_format);



// update of user profile

$sql = "UPDATE members SET first_name='".$first_name."', last_name='".$last_name."', email='".$email."', prof='".$prof."', mstatus='".$mstatus."', priv='".$priv."', home_address='".$home_address."', home_address_extra='".$home_address_extra."', home_zip='".$home_zip."', home_city='".$home_city."', home_state='".$home_state."', home_country='".$home_country."', home_phone='".$home_phone."', home_cellphone='".$home_cellphone."', gender='".$gender."', church='".$church."', pastor='".$pastor."',  birthday='".$birthday_sql."', home_homepage='".$home_homepage."', year='".$year."', term='".$term."', home_other_info='".$home_other_info."', majors='".$majors."', company_name='".$company_name."', position='".$position."', industry='".$industry."', company_address='".$company_address."', company_address_extra='".$company_address_extra."', company_zip='".$company_zip."', company_city='".$company_city."', company_state='".$company_state."', company_country='".$company_country."', company_phone='".$company_phone."', company_cellphone='".$company_cellphone."', company_homepage='".$company_homepage."', company_description='".$company_description."', company_other_info='".$company_other_info."', subgroup='".$subgroup."' WHERE id='".$_SESSION['IDtag'][0]."'";
$result = mysql_query($sql)
	or die ("Could not update profile!");



// update of session and hash info in case name or email were changed

$_COOKIE['check_email'] = $email;
$_COOKIE['check_hash'] = md5($email.$hash_password);

$sql = "SELECT id, first_name, last_name FROM members WHERE id='".$_SESSION['IDtag'][0]."'";
$result = mysql_query($sql)
	or die ("Could not update session data");

$_SESSION['IDtag'] = mysql_fetch_row($result);



// parse the templates

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "profile_submit.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_var(array("FIRST_NAME_HEADER" => $_SESSION['IDtag'][1],
			"LAST_NAME_HEADER" => $_SESSION['IDtag'][2],
			/*"HTML_HEADER" => $html_header*/));

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
