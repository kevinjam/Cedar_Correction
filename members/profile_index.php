<?php

/*
############################################################################
phpAlumni - A web-based, MySQL-backed alumni management program written in PHP4.
Copyright (C) 2002-2004 Ralf Hetzer

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more members_details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
############################################################################
*/

// displays the personal profile of the person logged-in and allows changes to be made

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");


// validates if user is logged-in

require_once("verify_login.php");



// evaluate the date format to give the user information on how to input the birthday

if($date_format == "us") {
	$birthday_format = "(mm/dd/yyyy)";
} else {
	$birthday_format = "(dd.mm.yyyy)";
};



// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");




// get data to populate the form

$sql = "SELECT first_name, last_name, email, prof, mstatus, priv, home_address, home_address_extra, home_zip, home_city, home_state, home_country, home_phone, home_cellphone, gender, church, pastor, birthday, home_homepage, year, term, home_other_info, majors, company_name, position, industry, company_address, company_address_extra, company_zip, company_city, company_state, company_country, company_phone, company_cellphone, company_homepage, company_description, company_other_info, subgroup FROM members WHERE id='".$_SESSION['IDtag'][0]."'";
$result = mysql_query($sql)
	or die ("Could not retrieve data to populate the fields!");

$row = mysql_fetch_array($result)
	or die ("Could not put result row in the variable!");


$priv  = ($row['priv'] == true)?"Public":"Private";
// parse the templates


$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "profile_index.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));


$t->set_var(array("FIRST_NAME_HEADER" => $_SESSION['IDtag'][1],
			"LAST_NAME_HEADER" => $_SESSION['IDtag'][2],
			"BIRTHDAY_FORMAT" => $birthday_format,
			"FIRST_NAME" => $row['first_name'],
			"LAST_NAME" => $row['last_name'],
			"EMAIL" => $row['email'],
			"PROFESSION" => $row['prof'],
			"MARITAL_STATUS" => $row['mstatus'],
			"PRIVACY" => $row['priv'],
			"GENDER" => $row['gender'],
			"CHURCH" => $row['church'],
			"PASTOR" => $row['pastor'],
			"EMAIL" => $row['email'],
			"HOME_ADDRESS" => $row['home_address'],
			"HOME_ADDRESS_EXTRA" => $row['home_address_extra'],
			"HOME_ZIP" => $row['home_zip'],
			"HOME_CITY" => $row['home_city'],
			"HOME_STATE" => $row['home_state'],
			"HOME_COUNTRY" => $row['home_country'],
			"HOME_PHONE" => $row['home_phone'],
			"HOME_CELLPHONE" => $row['home_cellphone'],
			"BIRTHDAY" => db_to_form($row['birthday'], $date_format),
			"HOME_HOMEPAGE" => $row['home_homepage'],
			"YEAR" => $row['year'],
			"TERM" => $row['term'],
			"HOME_OTHER_INFO" => $row['home_other_info'],
			"MAJORS" => $row['majors'],
			"COMPANY_NAME" => $row['company_name'],
			"POSITION" => $row['position'],
			"INDUSTRY" => $row['industry'],
			"COMPANY_ADDRESS" => $row['company_address'],
			"COMPANY_ADDRESS_EXTRA" => $row['company_address_extra'],
			"COMPANY_ZIP" => $row['company_zip'],
			"COMPANY_CITY" => $row['company_city'],
			"COMPANY_STATE" => $row['company_state'],
			"COMPANY_COUNTRY" => $row['company_country'],
			"COMPANY_PHONE" => $row['company_phone'],
			"COMPANY_CELLPHONE" => $row['company_cellphone'],
			"COMPANY_HOMEPAGE" => $row['company_homepage'],
			"COMPANY_DESCRIPTION" => $row['company_description'],
			"COMPANY_OTHER_INFO" => $row['company_other_info']/*,
			"HTML_HEADER" => $html_header*/));




// build the subgroup field in the form

$sql = "SELECT * FROM members_subgroup WHERE subgroup_id='".$row['subgroup']."'";
$result = mysql_query($sql)
	or die ("Could not get subgroup name from DB!");
$row = mysql_fetch_array($result);

$subgroup = "<option value=".$row['subgroup_id']." selected>".$row['subgroup']."</option>";

$sql = "SELECT * FROM members_subgroup WHERE 1 ORDER BY subgroup";
$result = mysql_query($sql)
	or die ("Could not get all subgroups from DB!");

while ($row = mysql_fetch_array($result)) {
	$subgroup = $subgroup."<option value=".$row['subgroup_id'].">".$row['subgroup']."</option>";
}

$t->set_var("SUBGROUP", $subgroup);
$t->set_var("PRIVACY_DASH", $priv);



$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
