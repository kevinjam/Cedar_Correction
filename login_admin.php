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


// checks the admin password and kicks the admin to the startpage


include("config.inc.php");
include("functions.inc.php");



// cleans up the users' input

$login = clean_input($_POST['login']);
$password = clean_input($_POST['password']);



// user verification

if(($password == $admin_password) && ($login == 'admin')) {		// saves information in the session for authentification on every page
	
	setcookie("check_password", $password, time()+1800, "/", "", 0);
	setcookie("check_hash", md5($password.$hash_password), time()+1800, "/", "", 0);
	header("Location: admin/index.php");
	exit;

} else die("Authentification failed!");	// authentification failed
?>
