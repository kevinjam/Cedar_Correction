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


// sends out the newsletter and displays a confirmation page

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if admin is logged-in

require_once("verify_login.php");




// stuff to connect correctly to the DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");



// do this only if someone really pressed the submit button

if ($_SESSION['sess_recipients'] && $_SESSION['sess_subject'] && $_SESSION['sess_body']) {
	
	// send out the newsletter to all recipients

	foreach($_SESSION['sess_recipients'] as $subgroup_id) {
		$sql = "SELECT email FROM members WHERE first_login=0 AND terms_ok=1 AND subgroup=".$subgroup_id;
		$result = mysql_query($sql)
			or die("Could not get email addresses from DB!");

		while($row = mysql_fetch_array($result)) {
			send_email($row['email'], $_SESSION['sess_subject'], $_SESSION['sess_body'], $mail_header);
		}
	}


	// enter the newsletter into the DB archive

	$_SESSION['sess_recipients'] = implode(",", $_SESSION['sess_recipients']);

	$sql = "INSERT INTO newsletters (recipients, subject, body) VALUES ('".$_SESSION['sess_recipients']."', '".$_SESSION['sess_subject']."', '".$_SESSION['sess_body']."')";
	$result = mysql_query($sql)
		or die("INSERT of newsletter did not work!");
}

// delete session variables

$_SESSION['sess_recipients'] = "0";
$_SESSION['sess_subject'] = "0";
$_SESSION['sess_body'] = "0";


// paste the data into the template

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "newsletter_sent.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
