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



// verifies the login data on every page in the member's section (this code has to be included on the top of every access-restricted page)

if(!isset($_SESSION['IDtag'])){
	header("Location:../login.php");
}

if(isset($_COOKIE['check_email'])){
	$hash = md5($_COOKIE['check_email'].$hash_password);
}else{
	$_COOKIE['check_hash'] = false;
	$hash = false;
}

if($_COOKIE['check_hash'] == false) {

	session_unset();

	setcookie(session_name(), "", time()-1800, "/", "", 0);
	setcookie("check_email", "", time()-1800, "/", "", 0);
	setcookie("check_hash", "", time()-1800, "/", "", 0);

	die("Your are not logged in!<br>Go to <a href=../index.php>Login</a> and authenticate yourself!");	// authentification failed
}
?>
