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


// confirmation that the DB administration processes were successfull


include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");




// validates if admin is logged-in

require_once("verify_login.php");




// clean up the users' input

$action = clean_input($_GET['action']);




// stuff to connect correctly to the DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");




// optimize tables

if($action == "optimize") {
	$sql = "OPTIMIZE TABLE contacts, members, jobfair, forum_sections, forum_threads, forum_messages, members_subgroup, news, newsletters";
	$result = mysql_query($sql)
		or die ("Could not optimize database!");
}



// delete nominal members that were invited but did not login at least once (30 days and older)

if($action == "delete_nominal_members") {

	// create the cut-off date (30 days and older) - one day equals 86400 seconds

	$kill_date = strftime("%Y%m%d000000", time()-2592000);
//	echo $kill_date;

	// do the SQL thing ;-))

	$sql = "DELETE FROM members WHERE first_login=1 AND timestamp<".$kill_date;
	$result = mysql_query($sql)
		or die ("Could not delete nominal members!");
}



// defines the template variables

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "db_admin_ok.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));



// parse the templates

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
