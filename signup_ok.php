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



// enters the new user into the DB and sends out a random password to the email account specified


include("config.inc.php");
include("functions.inc.php");
include("template.inc.php");




// cleans up the users' input

$email = clean_input($_POST['email']);
$first_name = clean_input($_POST['first_name']);
$last_name = clean_input($_POST['last_name']);
$date_join = clean_input($_POST['date_join']);
$church = clean_input($_POST['church']);
$pastor = clean_input($_POST['pastor']);
$gender = clean_input($_POST['gender']);
$home_city = clean_input($_POST['home_city']);
$home_country = clean_input($_POST['home_country']);
$home_phone = clean_input($_POST['home_phone']);
$prof = clean_input($_POST['prof']);
$mstatus = clean_input($_POST['mstatus']);
$priv = clean_input($_POST['priv']);



// connect to DB


// check if the user accepts the terms of service

if (empty($_POST['terms_ok'])) die ("You did not accept our Terms of Service. In this case we can't let you sign up.");




// check if the email address is valid

check_email2($email);



// check if email is already registered
$sql = "SELECT id FROM members WHERE email='".$email."'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

if($row[0]) die ("Email is already registered in the system!<br>Please use your email and password to log in!");	// email is already used as a login



// generate a random password and insert data into the DB

$password = rand_pass();

$priv = (empty($priv))? 0:1;

$sql = "INSERT INTO members (first_name, last_name, email, prof, mstatus, priv, date_join, password, home_city, home_country, gender, church, pastor, terms_ok) VALUES ('".$first_name."','".$last_name."','".$email."', '".$prof."', '".$mstatus."', '".$priv."', '".$date_join."', '".$password."', '".$home_city."', '".$home_country."', '".$gender."', '".$church."', '".$pastor."', '1')";
$result = mysql_query($sql)
	or die ("Could not insert new user! " . mysql_error());



// replace placeholders from config.inc.php

$mail_text_signup = str_replace("[FIRST_NAME]", $first_name, $mail_text_signup);
$mail_text_signup = str_replace("[LAST_NAME]", $last_name, $mail_text_signup);
$mail_text_signup = str_replace("[EMAIL]", $email, $mail_text_signup);
$mail_text_signup = str_replace("[DATE_JOIN]", $date_join, $mail_text_signup);
$mail_text_signup = str_replace("[PASSWORD]", $password, $mail_text_signup);
$mail_header = str_replace("[ADMIN_EMAIL]", $admin_email, $mail_header);



// mail password out to new user

send_email($email, $mail_subject_signup, $mail_text_signup, $mail_header);


// parse the templates

$t = new Template("templates", "remove");

$t->set_file(array("PAGE" => "signup_ok.tpl",
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
