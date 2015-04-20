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


// displays all messages in a thread


include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if admin is logged-in

require_once("verify_login.php");



// cleans up the users' input

$title = clean_input($_POST['title']);
$message = clean_input($_POST['message']);
$thread_id = clean_input($_GET['thread_id']);




// stuff to connect correctly to the DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");
	
	

// inserts a new thread into the DB

if($_POST['title'] && $_POST['message'] && $_GET['thread_id']) {
	$sql = "INSERT INTO forum_messages (thread_id, title, message, author) VALUES (".$thread_id.", '".$title."', '".$message."', '0')";
	$result = mysql_query($sql)
		or die("INSERT of new message did not work!");
}



// defines the template variables

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "forum_messages.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_block("PAGE", "TPL_ROW", "OUTPUT_ROW");



// get the name of the section

$sql = "SELECT forum_sections.title, forum_sections.section_id FROM forum_sections LEFT JOIN forum_threads ON forum_sections.section_id=forum_threads.section_id WHERE forum_threads.thread_id='".$thread_id."'";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");

$row = mysql_fetch_array($result);

$t->set_var("SECTION", "<a href=forum_threads.php?section_id=".$row[section_id]." class=content_link>".$row[title]."</a>");




// get the starting message of this thread

$sql = "SELECT thread_id, title, message, author, timestamp FROM forum_threads WHERE thread_id='".$thread_id."'";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");
$row = mysql_fetch_array($result);

// get the name of the author
if ($row[author] == "0") {
	$author = "<span class=content_text><font color=#FFFFFF>Administrator</font></span>";
} else {
	$sql = "SELECT first_name, last_name FROM members WHERE id='".$row[author]."'";
	$sub_result = mysql_query($sql)
		or die ("Could not get author name!");
	$author = mysql_fetch_array($sub_result);
	$author = "<a href=members_details.php?member=".$row[author]." class=content_link><font color=#FFFFFF>".$author[first_name]." ".$author[last_name]."</font></a>";
}

// push the first line out
$t->set_var(array("TITLE" => $row[title],
			"AUTHOR" => $author,
			"MESSAGE" => str_replace("\n", "<br>", $row[message]),
			"THREAD_ID" => $_GET['thread_id'],
			"DELETE" => "<a href=forum_delete_confirm.php?action=delete_thread&id=".$row[thread_id]."><img src='../templates/images/delete.gif' border=0></a>",
			"DATE" => timestamp_to_form($row[timestamp], $date_format)));
$t->parse("OUTPUT_ROW", "TPL_ROW", true);




// get all messages in thread

$sql = "SELECT message_id, title, message, author, timestamp FROM forum_messages WHERE thread_id='".$thread_id."' ORDER BY timestamp";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");




// constructs the table with the help of the "block" function of PHPLib

while ($row = mysql_fetch_array($result)) {

	// get the name of the author
	if ($row[author] == "0") {
		$author = "<span class=content_text><font color=#FFFFFF>Administrator</font></span>";
	} else {
		$sql = "SELECT first_name, last_name FROM members WHERE id='".$row[author]."'";
		$sub_result = mysql_query($sql)
			or die ("Could not get author name!");
	$author = mysql_fetch_array($sub_result);
	$author = "<a href=members_details.php?member=".$row[author]." class=content_link><font color=#FFFFFF>".$author[first_name]." ".$author[last_name]."</font></a>";
	}

	$t->set_var(array("TITLE" => $row[title],
				"AUTHOR" => $author,
				"MESSAGE" => str_replace("\n", "<br>", $row[message]),
				"DELETE" => "<a href=forum_delete_confirm.php?action=delete_message&id=".$row[message_id]."><img src='../templates/images/delete.gif' border=0></a>",
				"DATE" => timestamp_to_form($row[timestamp], $date_format)));
	$t->parse("OUTPUT_ROW", "TPL_ROW", true);
	
	// preserver title for preloading below
	$form_title = $row[title];
}




// preload the title field for replies

if (!$form_title) {
	// do nothing

} elseif (substr($form_title, 0, 3) == "Re:") {
	$t->set_var("FORM_TITLE", $form_title);

} else {
	$t->set_var("FORM_TITLE", "Re: ".$form_title);
}



// parses the templates

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
