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



// verifies the login data on every page in the member's section (this code has to be included on the top of every access-restricted page)


session_start();

include("config.inc.php");
include("functions.inc.php");



// cleans up the users' input

$email = clean_input($_POST['email']);
$password = clean_input($_POST['password']);



// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");



// user verification

$sql = "SELECT id, first_name, last_name FROM members WHERE email='".$email."' AND password='".$password."'";
$result = mysql_query($sql)
	or die ("Could not retrieve data!");


if (mysql_num_rows($result) != 1) {
	
	session_unset();
	session_destroy();

	setcookie("check_email", "", time()-1800, "/", "", 0);
	setcookie("check_hash", "", time()-1800, "/", "", 0);
	setcookie(session_name(), "", time()-1800, "/", "", 0);

	die("Authentification failed!<br>Go to <a href=index.php>Login</a> and authentificate yourself!");	// authentification failed


} else {

	$_SESSION['IDtag'] = mysql_fetch_row($result);

	// set cookies for 30 minutes
	setcookie("check_email", $email, time()+1800, "/", "", 0);
	setcookie("check_hash", md5($email.$hash_password), time()+1800, "/", "", 0);

	// set the "first login" tag to '0' to indicate that the user has logged in at least once
	$sql = "UPDATE members SET first_login=0 WHERE id='".$_SESSION['IDtag'][0]."'";
	$result = mysql_query($sql)
		or die ("Could not set first_login tag!");

	header("Location:members/index.php");
	exit;
}

?>
