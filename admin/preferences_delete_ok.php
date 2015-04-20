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


// deletes subgroups from the DB and displays a confirmation page


include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if admin is logged-in

require_once("verify_login.php");




// clean up the users' input

$subgroup_id = clean_input($_GET['subgroup_id']);





// stuff to connect correctly to the DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");


// check if data was given over to the page

if ($_GET['subgroup_id']) {

	// get all members from the DB which belong to the group to be deleted

	$sql = "SELECT id FROM members WHERE subgroup=".$subgroup_id;
	$result = mysql_query($sql)
		or die("Could not select members!");

	while ($row=mysql_fetch_array($result)) {
		$sql = "UPDATE members SET subgroup=0 WHERE id=".$row[id];
		$sub_result = mysql_query($sql)
			or die("Could not reset subgroup!");
	}

	// delete the entry from the DB

	$sql = "DELETE FROM members_subgroup WHERE subgroup_id=".$subgroup_id;
	$result = mysql_query($sql)
		or die("Could not delete subgroup!");
}




// paste the data into the template

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "preferences_delete_ok.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
