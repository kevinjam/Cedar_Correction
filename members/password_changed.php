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


// confirms that the password was changed successfully

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if user is logged-in

require_once("verify_login.php");



// cleans up the users' input

$password_old = clean_input($_POST['password_old']);
$password_new = clean_input($_POST['password_new']);
$password_new_check = clean_input($_POST['password_new_check']);




// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");


// check if the user knows his/her old password

$sql = "SELECT password FROM members WHERE id='".$_SESSION['IDtag'][0]."'";
$result = mysql_query($sql)
	or die("Could not check old password!");
$row = mysql_fetch_array($result);

if($row['password'] != $password_old) die("Your old password is not correct!<br>Hit the BACK button and try again!");



// check if the new password was entered correctly

if($password_new == $password_new_check) {

	if(strlen($password_new) >= $min_password_length) {
		
		$sql = "UPDATE members SET password='".$password_new."' WHERE id='".$_SESSION['IDtag'][0]."'";
		$result = mysql_query($sql)
			or die ("Could not update password!");

	} else die ("The password is too short! A valid password must have at least $min_password_length characters.<br>Hit the BACK button to try again.");

} else die ("The passwords you entered did not match!<br>Please hit BACK an try again.");



// paste the data into the template

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "password_changed.tpl",
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
