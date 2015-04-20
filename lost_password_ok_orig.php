<?php

/*
############################################################################
phpAlumni - A web-based, MySQL-backed alumni management program written in PHP4.
Copyright (C) 2002-2003 Ralf Hetzer

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



// sends out the new password to the user who has lost his/hers


include("config.inc.php");
include("functions.inc.php");
include("template.inc.php");




// clean up the users' input

$email = clean_input($_POST['email']);



// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");



// check if email is registered

$sql = "SELECT id FROM members WHERE email='".$email."'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

if($row[0]) {
	// generate a random password and insert it into the DB

	$password = rand_pass();
	$sql = "UPDATE members SET password='".$password."' WHERE id='".$row[0]."'";
	$result = mysql_query($sql)
		or die ("Could not change password!");



	// replace placeholders from config.inc.php

	$mail_text_lostpw = str_replace("[PASSWORD]", $password, $mail_text_lostpw);
	$mail_header = str_replace("[ADMIN_EMAIL]", $admin_email, $mail_header);



	// mail password out to new user

	send_email($email, $mail_subject_lostpw, $mail_text_lostpw, $mail_header);
}



// if there is no such email registered in the system, the phreak will not be told. the output for valid/invalid email addresses is always the same



// parse the templates

$t = new Template("templates", "remove");

$t->set_file(array("PAGE" => "lost_password_ok.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->parse("FOOTER", "FOOTER");
$t->pparse("OUT", "PAGE");

?>
