<?php

/*
############################################################################
phpAlumni - A web-based, MySQL-backed alumni management program written in PHP4.
Copyright (C) 2002-2005 Ralf Hetzer

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

filename: members/tell_a_friend_sent.php
release_version: 1.4
last_change: 20041220
description: enters the new user into the DB and sends out a random password to the email account specified (tell a friend)
[anchor]

*/



session_start();

include("../config.inc.php");
include("../template.inc.php");
include("../functions.inc.php");


// validates if user is logged-in

require_once("verify_login.php");


// cleans up the users' input

$email = clean_input($_POST['email']);
$first_name = clean_input($_POST['first_name']);
$last_name = clean_input($_POST['last_name']);



// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");



// check if the email address is valid

check_email2($email);



// check if email is already registered

$sql = "SELECT id FROM members WHERE email='".$email."'";
$result = mysql_query($sql)
	or die("Could not check emailaddress!");
$row = mysql_fetch_row($result);

if($row[0]) die ("Email is already registered in the system!<br>Please find your friend in the member's directory!");	// email is already used as a login



// generate a random password and insert data into the DB

$password = rand_pass();

$sql = "INSERT INTO members (first_name, last_name, email, password) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".md5($password.$hash_password)."')";
$result = mysql_query($sql)
	or die ("Could not insert new user!");



// get the emailadress of the current user to put it in the invitation mail

$sql = "SELECT email FROM members WHERE id='".$_SESSION['IDtag'][0]."'";
$result = mysql_query($sql)
	or die("Could not get emailaddress!");
$row = mysql_fetch_array($result);



// replace placeholders from config.inc.php

$mail_text_tellafriend = str_replace("[USER_FIRST_NAME]", $_SESSION['IDtag'][1], $mail_text_tellafriend);
$mail_text_tellafriend = str_replace("[USER_LAST_NAME]", $_SESSION['IDtag'][2], $mail_text_tellafriend);
$mail_text_tellafriend = str_replace("[USER_EMAIL]", $row['email'], $mail_text_tellafriend);
$mail_text_tellafriend = str_replace("[FIRST_NAME]", $first_name, $mail_text_tellafriend);
$mail_text_tellafriend = str_replace("[LAST_NAME]", $last_name, $mail_text_tellafriend);
$mail_text_tellafriend = str_replace("[EMAIL]", $email, $mail_text_tellafriend);
$mail_text_tellafriend = str_replace("[PASSWORD]", $password, $mail_text_tellafriend);
$mail_header = str_replace("[ADMIN_EMAIL]", $admin_email, $mail_header);



// mail password out to new user

send_email($email, $mail_subject_tellafriend, $mail_text_tellafriend, $mail_header);


// parse the templates

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "tell_a_friend_sent.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));
			

$t->set_var(array("FIRST_NAME" => $first_name,
			"LAST_NAME" => $last_name));

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->parse("FOOTER", "FOOTER");
$t->pparse("OUT", "PAGE");
?>
