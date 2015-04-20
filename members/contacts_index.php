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

// shows all contacts a user has, as well as the incoming and outgoing requests

session_start();

include("../template.inc.php");
include("../config.inc.php");



// validates if user is logged-in

require_once("verify_login.php");



// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");




// defines the template variables

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "contacts_index.tpl",
			"SPONSORS" => "sponsors.tpl",
			"HEADER" => "header.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_block("PAGE", "MEMBERS_ROW", "MEMBERS_OUTPUT");
$t->set_block("PAGE", "OUTGOING_ROW", "OUTGOING_OUTPUT");
$t->set_block("PAGE", "INCOMING_ROW", "INCOMING_OUTPUT");



// gets the members basic data from the DB

$sql = "SELECT id, first_name, last_name, term, year, priv FROM members LEFT JOIN contacts ON (members.id=contacts.initiator AND contacts.recipient=".$_SESSION['IDtag'][0].") OR (members.id=contacts.recipient AND contacts.initiator=".$_SESSION['IDtag'][0].") WHERE members.priv=0 and contacts.acceptance=1 ORDER BY last_name";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");



// constructs the members table with the help of the "block" function of PHPLib

while ($row = mysql_fetch_array($result)) {
	$t->set_var(array("MEMBERS_NAME" => "<a href=members_details.php?member=".$row[id]." class=content_link>".$row[last_name].", ".$row[first_name]."</a>",
				"MEMBERS_TERM" => $row[term],
				"MEMBERS_YEAR" => $row[year],
				"MEMBERS_REMOVE" => "<a href=contacts_management.php?member=".$row[id]."&decision=remove><img src=../templates/images/delete.gif border=0></a>"));
	$t->parse("MEMBERS_OUTPUT", "MEMBERS_ROW", true);
}



// gets the incoming requests from the DB

$sql = "SELECT id, first_name, last_name FROM members LEFT JOIN contacts ON members.id=contacts.initiator WHERE contacts.recipient=".$_SESSION['IDtag'][0]." AND contacts.acceptance=0 ORDER BY last_name";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");



// constructs the table with the help of the "block" function of PHPLib

while ($row = mysql_fetch_array($result)) {
	$t->set_var(array("INCOMING_NAME" => "<a href=members_details.php?member=".$row[id]." class=content_link>".$row[last_name].", ".$row[first_name]."</a>",
				"INCOMING_ACCEPT" => "<a href=contacts_management.php?member=".$row[id]."&decision=accept><img src=../templates/images/accept.gif border=0></a>",
				"INCOMING_DECLINE" => "<a href=contacts_management.php?member=".$row[id]."&decision=decline><img src=../templates/images/decline.gif border=0></a>"));
	$t->parse("INCOMING_OUTPUT", "INCOMING_ROW", true);
}



// gets the outgoing requests from the DB

$sql = "SELECT id, first_name, last_name FROM members LEFT JOIN contacts ON members.id=contacts.recipient WHERE contacts.initiator=".$_SESSION['IDtag'][0]." AND contacts.acceptance=0 ORDER BY last_name";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");



// constructs the table with the help of the "block" function of PHPLib

while ($row = mysql_fetch_array($result)) {
	$t->set_var(array("OUTGOING_NAME" => "<a href=members_details.php?member=".$row['id']." class=content_link>".$row['last_name'].", ".$row['first_name']."</a>",
				"OUTGOING_DELETE" => "<a href=contacts_management.php?member=".$row['id']."&decision=cancel><img src=../templates/images/delete.gif border=0></a>"));
	$t->parse("OUTGOING_OUTPUT", "OUTGOING_ROW", true);
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
