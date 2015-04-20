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


// the start page for forum administration, displaying the sections


include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if admin is logged-in

require_once("verify_login.php");



// cleans up the users' input




// inserts the new section into the DB

if(isset($_POST['title']) && isset($_POST['description'])) {
	$title = clean_input($_POST['title']);
	$description = clean_input($_POST['description']);
	$sql = "INSERT INTO forum_sections (title, description) VALUES ('".$title."', '".$description."')";
	$result = mysql_query($sql) or die("INSERT of new section info did not work!");
}



// defines the template variables

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "forum_index.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_block("PAGE", "TPL_ROW", "OUTPUT_ROW");



// runs the query on the DB

$sql = "SELECT * FROM forum_sections ORDER BY section_id";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");



// constructs the table with the help of the "block" function of PHPLib

while ($row = mysql_fetch_array($result)) {
	
	// count number of threads in section
	$sql = "SELECT thread_id FROM forum_threads WHERE section_id=".$row['section_id'];
	$sub_result = mysql_query($sql)
		or die ("Could not run query on DB!");
	$thread_count = mysql_num_rows($sub_result);

	// count number of messages in section
	$sql = "SELECT forum_messages.message_id FROM forum_messages LEFT JOIN forum_threads ON forum_messages.thread_id=forum_threads.thread_id LEFT JOIN forum_sections ON forum_threads.section_id=forum_sections.section_id WHERE forum_sections.section_id=".$row['section_id'];
	$sub_result = mysql_query($sql)
		or die ("Could not run query on DB!");
	$message_count = mysql_num_rows($sub_result);


	$t->set_var(array("TITLE" => "<a href=forum_threads.php?section_id=".$row['section_id']." class=content_link>".$row['title']."</a>",
				"THREAD_COUNT" => $thread_count,
				"MESSAGE_COUNT" => $message_count,
				"DELETE" => "<a href=forum_delete_confirm.php?action=delete_section&id=".$row['section_id']."><img src='../templates/images/delete.gif' border=0></a>",
				"DESCRIPTION" => $row['description']));
	$t->parse("OUTPUT_ROW", "TPL_ROW", true);
}



// parses the templates

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
