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


// deletes entries in the forum and displays a confirmation page


include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");




// validates if admin is logged-in

require_once("verify_login.php");




// cleans up the users' input

$id = clean_input($_GET['id']);
$action = clean_input($_GET['action']);





// stuff to connect correctly to the DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");



// delete the entry from the DB depending on the action passed into the script

if($action == "delete_section") {

	$sql = "SELECT forum_messages.message_id FROM forum_messages LEFT JOIN forum_threads ON forum_messages.thread_id=forum_threads.thread_id LEFT JOIN forum_sections ON forum_threads.section_id=forum_sections.section_id WHERE forum_sections.section_id='".$id."'";
	$result = mysql_query($sql)
		or die("Could not select messages to be deleted!");

	
	// avoids errors when there is no message in a new section

	if (mysql_num_rows($result)!="0") {
		$sql = "DELETE FROM forum_messages WHERE";
		$index = 0;

		while ($row = mysql_fetch_array($result)) {
			if ($index == 1) {
				$sql = $sql." OR";
			}
			$sql = $sql." message_id=".$row[message_id];
			$index = 1;
		}

		$result = mysql_query($sql)
			or die("Could not delete messages!");
	}

	$sql = "DELETE FROM forum_threads WHERE section_id='".$id."'";
	$result = mysql_query($sql)
		or die("Could not delete threads!");

	$sql = "DELETE FROM forum_sections WHERE section_id='".$id."'";
	$result = mysql_query($sql)
		or die("Could not delete section!");

} elseif ($action == "delete_thread") {
	$sql = "DELETE FROM forum_messages WHERE thread_id='".$id."'";
	$result = mysql_query($sql)
		or die("Could not delete messages!");

	$sql = "DELETE FROM forum_threads WHERE thread_id='".$id."'";
	$result = mysql_query($sql)
		or die("Could not delete threads!");

} elseif ($action == "delete_message") {
	$sql = "DELETE FROM forum_messages WHERE message_id='".$id."'";
	$result = mysql_query($sql)
		or die("Could not delete messages!");
}




// paste the data into the template

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "forum_delete_ok.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
