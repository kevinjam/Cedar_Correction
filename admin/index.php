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


// the start page for the admin


include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");




// validates if admin is logged-in

require_once("verify_login.php");




// stuff to connect correctly to the DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");




// defines the template variables

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "index.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));
$t->set_block("PAGE", "BIRTHDAY_ROW", "BIRTHDAY_OUTPUT_ROW");




// builds the birthday table

if ($date_format == "us") {
	$sql = "SELECT id, first_name, last_name, DATE_FORMAT(birthday, '%m/%d') AS birthday FROM members WHERE first_login=0 AND terms_ok=1 AND TO_DAYS(DATE_ADD(birthday, INTERVAL (YEAR(CURDATE())-YEAR(birthday)) YEAR)) BETWEEN TO_DAYS(CURDATE()) AND (TO_DAYS(CURDATE())+".$birthday_look_ahead.") OR TO_DAYS(DATE_ADD(birthday, INTERVAL (YEAR(CURDATE())-YEAR(birthday)+1) YEAR)) BETWEEN TO_DAYS(CURDATE()) AND (TO_DAYS(CURDATE())+".$birthday_look_ahead.") ORDER BY MONTH(birthday) DESC, DAYOFMONTH(birthday)";

} elseif ($date_format == "eu") {
	$sql = "SELECT id, first_name, last_name, DATE_FORMAT(birthday, '%d.%m.') AS birthday FROM members WHERE first_login=0 AND terms_ok=1 AND TO_DAYS(DATE_ADD(birthday, INTERVAL (YEAR(CURDATE())-YEAR(birthday)) YEAR)) BETWEEN TO_DAYS(CURDATE()) AND (TO_DAYS(CURDATE())+".$birthday_look_ahead.") OR TO_DAYS(DATE_ADD(birthday, INTERVAL (YEAR(CURDATE())-YEAR(birthday)+1) YEAR)) BETWEEN TO_DAYS(CURDATE()) AND (TO_DAYS(CURDATE())+".$birthday_look_ahead.") ORDER BY MONTH(birthday) DESC, DAYOFMONTH(birthday)";

} else die("Please check the variable $date_format in config.inc.php!");

$result = mysql_query($sql)
	or die ("Could not retrieve birthdays from DB!");

while ($row = mysql_fetch_array($result)) {

	$t->set_var(array("BIRTHDAY_DATE" => $row[birthday],
				"BIRTHDAY_NAME" => "<a href=members_details.php?member=".$row[id]." class=content_link>".$row[last_name]."&nbsp;".$row[first_name]."</a>"));
	$t->parse("BIRTHDAY_OUTPUT_ROW", "BIRTHDAY_ROW", true);
}

$t->set_var("BIRTHDAY_LOOK_AHEAD", $birthday_look_ahead);




// count number of members in network

$sql = "SELECT id FROM members WHERE first_login=0 AND terms_ok=1";
$result = mysql_query($sql)
	or die ("Could not select id from DB!");
$count = mysql_num_rows($result);

$t->set_var("COUNT", $count);




// parse the templates

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
