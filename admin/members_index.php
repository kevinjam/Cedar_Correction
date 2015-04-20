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
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
############################################################################
*/


// displays a member list


include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if admin is logged-in

require_once("verify_login.php");



// cleans up the users' input
if(isset($_POST['email'])){
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
//$birthday = clean_input(form_to_db($_POST['birthday'], $date_format));
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
$POSTmember = clean_input($_POST['member']);
if(isset($_GET['member'])){
	$GETmember = clean_input($_GET['member']);
}
$start_row = 0;
$start_letter = '';
//$delete = clean_input($_GET['delete']);
$update = clean_input($_POST['update']);

// update of user profile

if($update == 'yes') {
	
	check_email2($email);
	
	$sql = "UPDATE members SET first_name='".$first_name."', last_name='".$last_name."', email='".$email."', home_address='".$home_address."', home_address_extra='".$home_address_extra."', home_zip='".$home_zip."', home_city='".$home_city."', home_state='".$home_state."', home_country='".$home_country."', home_phone='".$home_phone."', home_cellphone='".$home_cellphone."', birthday='".$birthday."', home_homepage='".$home_homepage."', year='".$year."', term='".$term."', home_other_info='".$home_other_info."', majors='".$majors."', company_name='".$company_name."', position='".$position."', industry='".$industry."', company_address='".$company_address."', company_address_extra='".$company_address_extra."', company_zip='".$company_zip."', company_city='".$company_city."', company_state='".$company_state."', company_country='".$company_country."', company_phone='".$company_phone."', company_cellphone='".$company_cellphone."', company_homepage='".$company_homepage."', company_description='".$company_description."', company_other_info='".$company_other_info."', subgroup='".$subgroup."' WHERE id='".$POSTmember."'";
	$result = mysql_query($sql)
		or die ("Could not update profile!");
}

}

// deletes users in the DB

if(isset($_GET['member']) && isset($_GET['delete']) &&  ($_GET['delete'] == 'yes')) {
	$GETmember = $_GET['member'];
	$sql = "DELETE FROM members WHERE id='".$GETmember."'";
	$result = mysql_query($sql)
		or die("Could not delete user!");

	$sql = "DELETE FROM contacts WHERE initiator='".$GETmember."' OR recipient='".$GETmember."'";
	$result = mysql_query($sql)
		or die("Could not delete user's contact references!");
		
		$start_letter = '';
}



// defines the template variables

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "members_index.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_block("PAGE", "TPL_ROW", "OUTPUT_ROW");



// configures the SQL-query and the variables according to the info passed to the page

if (isset($_GET['start_letter'])) {
	$sql_start_letter = "WHERE last_name LIKE '".$start_letter."%'";	// LIKE is not case-sensitive
	$url_start_letter = "&start_letter=".$start_letter;
	
} else {
	$start_letter = "";
	$sql_start_letter = '';
	$url_start_letter = '';
}

if (!isset($_GET['start_row'])) {
	$start_row = "0";
}



// determines the number of matches for the following query

$sql = "SELECT id FROM members ".$sql_start_letter;
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");
$num_rows = mysql_num_rows($result);



// runs the query on the DB

$sql = "SELECT id, first_name, last_name, term, year FROM members ".$sql_start_letter." ORDER BY last_name LIMIT ".$start_row.",".$rows_per_page;
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");



// constructs the table with the help of the "block" function of PHPLib

while ($row = mysql_fetch_array($result)) {
	$t->set_var(array("MEMBERS_NAME" => "<a href=members_details.php?member=".$row['id'].$url_start_letter." class=content_link>".$row['last_name'].", ".$row['first_name']."</a>",
				"MEMBERS_TERM" => $row['term'],
				"MEMBERS_YEAR" => $row['year'],
				"MEMBERS_DELETE" => "<a href=members_delete_confirm.php?member=".$row['id']."&delete=yes".$url_start_letter."><img src=../templates/images/delete.gif border=0></a>"));
	$t->parse("OUTPUT_ROW", "TPL_ROW", true);
}



// puts NEXT / PREVIOUS links on the page where needed

if ($start_row && ($start_row != "0")) {	// browsing backward
	$row_jumper = $start_row - $rows_per_page;
	if ($row_jumper < "0") $row_jumper = "0";
	$t->set_var("PREVIOUS", "<a href=".$PHP_SELF."?start_row=".$row_jumper.$url_start_letter." class=content_link><<</a>");
}

if ($num_rows-1 >= ($start_row + $rows_per_page)) {	// browsing forward
	$t->set_var("NEXT", "<a href=".$PHP_SELF."?start_row=".($start_row + $rows_per_page).$url_start_letter."  class=content_link>>></a>");
}



// parses the templates

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
