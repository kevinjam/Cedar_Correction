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


// displays all threads in a section

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if user is logged-in

require_once("verify_login.php");




// clean up the users' input

$title = clean_input($_POST['title']);
$message = clean_input($_POST['message']);
$section_id = clean_input($_GET['section_id']);





// stuff to connect correctly to the DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");
	
	

// inserts a new thread into the DB

if($_POST['title'] && $_POST['message'] && $_GET['section_id']) {
	$sql = "INSERT INTO forum_threads (section_id, title, message, author) VALUES ('".$section_id."', '".$title."', '".$message."', '".$_SESSION['IDtag'][0]."')";
	$result = mysql_query($sql)
	or die("INSERT of new thread did not work!");
}



// defines the template variables

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "forum_threads.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_block("PAGE", "TPL_ROW", "OUTPUT_ROW");



// get the name of the section

$sql = "SELECT title FROM forum_sections WHERE section_id='".$section_id."'";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");

$row = mysql_fetch_array($result);

$t->set_var(array("SECTION" => $row[title],
			"POST_ACTION" => "forum_threads.php?section_id	=".$section_id));



// get all threads in section

$sql = "SELECT thread_id, title, author, timestamp FROM forum_threads WHERE section_id='".$section_id."' ORDER BY timestamp DESC";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");



// constructs the table with the help of the "block" function of PHPLib

while ($row = mysql_fetch_array($result)) {

	// get the number of answers

	$sql = "SELECT message_id, timestamp FROM forum_messages WHERE thread_id=".$row[thread_id]." ORDER BY timestamp DESC";
	$sub_result = mysql_query($sql)
		or die ("Could not retrieve data from DB!");
	
	$answer_count = mysql_num_rows($sub_result);
	
	// get the date of the last message in this thread
	$last_message = mysql_fetch_array($sub_result);

	if (!$last_message[timestamp]) {
		$last_message = timestamp_to_form($row[timestamp], $date_format);
	} else {
		$last_message = timestamp_to_form($last_message[timestamp], $date_format);
	}
	
	// get the name of the author
	if ($row[author] == "0") {
		$author = "<span class=content_link>Administrator</span>";
	} else {
		$sql = "SELECT first_name, last_name FROM members WHERE id=".$row[author];
		$sub_result = mysql_query($sql)
			or die ("Could not get author name!");
		$author = mysql_fetch_array($sub_result);
		$author = "<a href=members_details.php?member=".$row[author]." class=content_link>".$author[first_name]." ".$author[last_name]."</a>";
	}

	$t->set_var(array("TITLE" => "<a href=forum_messages.php?thread_id=".$row[thread_id]." class=content_link>".$row[title]."</a>",
				"AUTHOR" => $author,
				"ANSWERS" => $answer_count,
				"LAST_MESSAGE" => $last_message));
	$t->parse("OUTPUT_ROW", "TPL_ROW", true);
}



// parses the templates

$t->set_var(array("FIRST_NAME_HEADER" => $_SESSION['IDtag'][1],
			"LAST_NAME_HEADER" => $_SESSION['IDtag'][2],
			"HTML_HEADER" => $html_header));


$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
