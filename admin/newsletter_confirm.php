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


// lets the superuser verity the contents before sending

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if admin is logged-in

require_once("verify_login.php");




// cleans up the users' input

$subject = clean_input($_POST['subject']);
$body = clean_input($_POST['body']);


// defines the template variables

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "newsletter_confirm.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));



// get the number of recipients for each subgroup

$i = 0;
$recipients_list = '';
if ($_POST['recipients'] == "") die("You did not select any recipients! Hit the BACK button!");

foreach ($_POST['recipients'] as $subgroup_id) {
	if ($i <> 0) {
		$recipients_list = $recipients_list.", ";
	}

	$sql = "SELECT subgroup FROM members_subgroup WHERE subgroup_id=".$subgroup_id;
	$result = mysql_query($sql)
		or die ("Could not retrieve data from DB!");
	$name = mysql_fetch_array($result);

	$recipients_list = $recipients_list.$name['subgroup'];

	$sql = "SELECT id FROM members WHERE first_login=0 AND terms_ok=1 AND  subgroup=".$subgroup_id;
	$result = mysql_query($sql)
		or die ("Could not retrieve data from DB!");
	$recipients_list = $recipients_list." (".mysql_num_rows($result).")";

	$i = "1";
}



$t->set_var(array("SUBJECT" => $subject,
			"BODY" => str_replace("\n", "<br>", $body),
			"RECIPIENTS_LIST" => $recipients_list));




// assign the values from the form to the session variables

$_SESSION['sess_recipients'] = $_POST['recipients'];
$_SESSION['sess_subject'] = $subject;
$_SESSION['sess_body'] = $body;



// parses the templates

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
