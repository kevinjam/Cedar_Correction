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



// verifies that every email address has a valid DNS entry - deletes the addresses where no entry can be found


include("config.inc.php");
include("functions.inc.php");



// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");



	
if ($action == "check") {
	$sql = "SELECT id, email FROM members WHERE 1";
	$result = mysql_query($sql)
		or die("Could not select addresses!");

	while ($row = mysql_fetch_array($result)) {
		if (check_email($row[email])) {
			$sql = "DELETE FROM members WHERE id=".$row[id];
			$result_2 = mysql_query($sql)
				or die("Could not delete invalid member address from database!");
		}
	}
	$sql ("OPTIMIZE TABLE members");
	$result = mysql_query($sql)
		or die("Could not optimize database!");

	echo ("Email check is complete!<p>");
}
?>

<html>
<header></header>
<body>
Older versions of phpAlumni did not check the validity of email addresses. People who signed up
could enter bogus addresses and flood the database with useless entries. phpAlumni V1.0 has a build in
email check that looks for a DNS entry for every address.<p>
This script checks the email addresses of all members for a corresponding DNS entry. If no entry is found
the script assumes the address is bogus and deletes the whole entry.<p>
<b>Please observer that you only need to run this script if you upgrade from version 0.9.5 or lower!</b><p>
<a href="email-cleaner.php?action=check">Click here to run the cleaner!</a><p>
<b>This script will take a looooong time. You will most probably get a server timeout, but this does not matter!</b>
</html>
