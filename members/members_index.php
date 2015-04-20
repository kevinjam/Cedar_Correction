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

// shows all members in the alumni network, allows to access the detials or add members to the personal contact list

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if user is logged-in

require_once("verify_login.php");




// cleans up the users' input
if(isset($_GET['start_letter'])){
	$start_letter = clean_input($_GET['start_letter']);
}else{
	$start_letter = '';
}

if(isset($_GET['start_row'])){
	$start_row = clean_input($_GET['start_row']);
}else{
	$start_row = 0;
}



// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");




// defines the template variables

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "members_index.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_block("PAGE", "TPL_ROW", "OUTPUT_ROW");



// gets the accepted contacts from the DB

// for users of MySQL version 4.0.0 and up (used with only one "while" loop)
// $sql = "SELECT recipient FROM contacts WHERE initiator='".$_SESSION['IDtag'][0]."' AND acceptance='1' UNION SELECT initiator AS contact_id FROM contacts WHERE recipient='".$_SESSION['IDtag'][0]."' AND acceptance='1'";

$sql = "SELECT initiator FROM contacts WHERE recipient='".$_SESSION['IDtag'][0]."' AND acceptance='1'";
$result = mysql_query($sql)
	or die ("Could not get contacts from DB!");

$i = '0';			// counter for $contacts and $row in the first loop
$contacts = array("XXX");	// cheat to avoid warnings when no contact exits

while($row = mysql_fetch_row($result)) {
	$contacts[$i] = $row[0];
	$i++;
}


$sql = "SELECT recipient FROM contacts WHERE initiator='".$_SESSION['IDtag'][0]."' AND acceptance='1'";
$result = mysql_query($sql)
	or die ("Could not get contacts from DB!");

while($row = mysql_fetch_row($result)) {
	$contacts[$i] = $row[0];
	$i++;
}



// gets the PENDING contacts from the DB

$sql = "SELECT initiator FROM contacts WHERE recipient='".$_SESSION['IDtag'][0]."' AND acceptance='0'";
$result = mysql_query($sql)
	or die ("Could not get pending contacts from DB!");

$i = '0';				// counter for $pending_contacts and $row in the first loop
$pending_contacts = array("XXX");	// cheat to avoid warnings when no contact exits

while($row = mysql_fetch_row($result)) {
	$pending_contacts[$i] = $row[0];
	$i++;
}


$sql = "SELECT recipient FROM contacts WHERE initiator='".$_SESSION['IDtag'][0]."' AND acceptance='0'";
$result = mysql_query($sql)
	or die ("Could not get pending contacts from DB!");

while($row = mysql_fetch_row($result)) {
	$pending_contacts[$i] = $row[0];
	$i++;
}



// configures the memberlist-query according to the variables passed to the page
$sql_start_letter = '';
if (isset($_GET['start_letter'])) $sql_start_letter = " AND last_name LIKE '".$start_letter."%'";		// LIKE is not case-sensitive

if (!isset($_GET['start_row'])) {
	$start_row = '0';
}



// determines the number of matches for the following query

if (isset($_GET['start_letter'])) {
	$sql = "SELECT id FROM members WHERE last_name LIKE '".$start_letter."%'";
} else {
	$sql = "SELECT id FROM members WHERE 1";
}

$result = mysql_query($sql)
	or die ("Could not get number of matches from DB!");
$num_rows = mysql_num_rows($result);




// gets the members basic data from the DB (does not display the user himself and all members that have not yet logged in at least once)

$sql = "SELECT id, first_name, last_name, term, year FROM members WHERE id<>'".$_SESSION['IDtag'][0]."'".$sql_start_letter." AND first_login='0' AND terms_ok='1' ORDER BY last_name LIMIT ".$start_row.",".$rows_per_page;
$result = mysql_query($sql)
	or die ("Could not retrieve member data from DB!");



// constructs the table with the help of the "block" function of PHPLib

while ($row = mysql_fetch_array($result)) {
	$t->set_var(array("MEMBERS_NAME" => "<a href=members_details.php?member=".$row['id']." class=content_link>".$row['last_name'].", ".$row['first_name']."</a>",
				"MEMBERS_TERM" => $row['term'],
				"MEMBERS_YEAR" => $row['year']));
	
	if(in_array($row['id'], $contacts))  {	// checks if the member is in the contact list or not
		$t->set_var("MEMBERS_CONTACT", "<a href=contacts_index.php><img src=../templates/images/contact.gif border=0></a>");

	} elseif(in_array($row['id'], $pending_contacts))  {	// checks if user already requested a contact
		$t->set_var("MEMBERS_CONTACT", "<a href=contacts_index.php><img src=../templates/images/pending.gif border=0></a>");

	} else {
		$t->set_var("MEMBERS_CONTACT", "<a href=contacts_request_confirm.php?member=".$row['id']."&start_letter=".$start_letter."&start_row=".$start_row."><img src=../templates/images/add.gif border=0></a>");
	}
	
	$t->parse("OUTPUT_ROW", "TPL_ROW", true);
}



// puts NEXT / PREVIOUS links on the page where needed

if (isset($_GET['start_letter'])) {
	$start_letter_url = "&start_letter=".$start_letter;	// makes the URL in the links look nicer
}

if (isset($_GET['start_row']) && ($start_row != "0")) {	// browsing backward
	$row_jumper = $start_row - $rows_per_page;
	if ($row_jumper < "0") $row_jumper = "0";
	$t->set_var("PREVIOUS", "<a href=".$PHP_SELF."?start_row=".$row_jumper.$start_letter_url." class=content_link><<&nbsp;</a>");
}

if ($num_rows-1 > ($start_row + $rows_per_page)) {	// browsing forward
	$t->set_var("NEXT", "<a href=".$PHP_SELF."?start_row=".($start_row + $rows_per_page).$start_letter_url." class=content_link>&nbsp;>></a>");
}



// parses the templates

$t->set_var(array("FIRST_NAME_HEADER" => $_SESSION['IDtag'][1],
			"LAST_NAME_HEADER" => $_SESSION['IDtag'][2],
			/*"HTML_HEADER" => $html_header*/));


$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
