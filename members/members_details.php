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

// shows the details of a member in the network

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if user is logged-in

require_once("verify_login.php");



// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");




// get details from member

$sql = "SELECT first_name, last_name, email, home_address, home_address_extra, home_zip, home_city, home_state, home_country, home_phone, home_cellphone, birthday, home_homepage, year, term, home_other_info, majors, company_name, position, industry, company_address, company_address_extra, company_zip, company_city, company_state, company_country, company_phone, company_cellphone, company_homepage, company_description, company_other_info, subgroup FROM members WHERE id=".$_GET['member'];
$result = mysql_query($sql)
	or die ("Could not run query on the DB!");

$row = mysql_fetch_array($result)
	or die ("Could not get result from query!");



// parse the templates

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "members_details.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));


$t->set_var(array("FIRST_NAME_HEADER" => $_SESSION['IDtag'][1],
			"LAST_NAME_HEADER" => $_SESSION['IDtag'][2],
			"FIRST_NAME" => $row[first_name],
			"LAST_NAME" => $row[last_name],
			"EMAIL" => $row[email],
			"HOME_ADDRESS" => $row[home_address],
			"HOME_ADDRESS_EXTRA" => $row[home_address_extra],
			"HOME_ZIP" => $row[home_zip],
			"HOME_CITY" => $row[home_city],
			"HOME_STATE" => $row[home_state],
			"HOME_COUNTRY" => $row[home_country],
			"HOME_PHONE" => $row[home_phone],
			"HOME_CELLPHONE" => $row[home_cellphone],
			"BIRTHDAY" => db_to_form($row[birthday], $date_format),
			"HOME_HOMEPAGE" => $row[home_homepage],
			"YEAR" => $row[year],
			"TERM" => $row[term],
			"HOME_OTHER_INFO" => str_replace("\n", "<br>", $row[home_other_info]),
			"MAJORS" => str_replace("\n", "<br>", $row[majors]),
			"COMPANY_NAME" => $row[company_name],
			"POSITION" => $row[position],
			"INDUSTRY" => $row[industry],
			"COMPANY_ADDRESS" => $row[company_address],
			"COMPANY_ADDRESS_EXTRA" => $row[company_address_extra],
			"COMPANY_ZIP" => $row[company_zip],
			"COMPANY_CITY" => $row[company_city],
			"COMPANY_STATE" => $row[company_state],
			"COMPANY_COUNTRY" => $row[company_country],
			"COMPANY_PHONE" => $row[company_phone],
			"COMPANY_CELLPHONE" => $row[company_cellphone],
			"COMPANY_HOMEPAGE" => $row[company_homepage],
			"COMPANY_DESCRIPTION" => str_replace("\n", "<br>", $row[company_description]),
			"COMPANY_OTHER_INFO" => str_replace("\n", "<br>", $row[company_other_info])));




// build the subgroup field in the form

$sql = "SELECT subgroup FROM members_subgroup WHERE subgroup_id=".$row[subgroup];
$result = mysql_query($sql)
	or die ("Could not get subgroup name from DB!");
$row = mysql_fetch_array($result);

$t->set_var("SUBGROUP", $row[subgroup]);




$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
