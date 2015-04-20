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


// this is the first page displayed to members after successfull login

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if user is logged-in

require_once("verify_login.php");



// clean up the users' input

if(isset($_GET['start_row'])){
$start_row = clean_input($_GET['start_row']);
}




// records the acceptance of the terms of service in the DB

if (isset($_POST['acceptance']) && $_POST['acceptance'] == "on") {
	$sql = "UPDATE members SET terms_ok='1' WHERE id='".$_SESSION['IDtag'][0]."'";
	$result = mysql_query($sql)
		or die ("Could not set acceptance flag in DB!");
}



// checks if the user has aggreed to the terms of service

$sql = "SELECT terms_ok FROM members WHERE id='".$_SESSION['IDtag'][0]."'";
$result = mysql_query($sql)
	or die ("Could not get acceptance of terms!");
$row = mysql_fetch_array($result);

if($row['terms_ok'] == "0") {
	header("Location: terms_of_service_index.php?acceptance=0");
	exit;
}



// defines the template variables

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "index.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_block("PAGE", "TPL_ROW", "OUTPUT_ROW");
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


// define the startrow

if (!isset($_GET['start_row'])) {
	$start_row = "0";
}



// build the navigation elements for forward and backward browsing

$sql = "SELECT news_id FROM news WHERE 1";
$result = mysql_query($sql)
	or die ("Could not retrieve news from DB!");
$news_count = mysql_num_rows($result);


// build '"<<" arrows for backward browsing

$target_row = $start_row - $news_per_page;
if ($target_row < 0) {
	$target_row = 0;
}

if ($start_row != 0) {
	$browse_url = "<a href=".$PHP_SELF."?start_row=".$target_row." class=content_link>&lt;&lt;</a>&nbsp;";
}else{
	$browse_url = '';
}


// build links for direct access to the pages
$link_count = ceil($news_count/$news_per_page);
$i=1;
while ($i < $link_count) {
	$target_row = $i*$news_per_page;
	$i++;
	
	if ($start_row == $target_row) {
		$browse_url = $browse_url."&lt;".$i."&gt;&nbsp;";
	} else {
		$browse_url = $browse_url."<a href=".$PHP_SELF."?start_row=".$target_row." class=content_link>&lt;".$i."&gt;</a>&nbsp;";
	}
}


// build ">>" arrows for forward browsing
$target_row = $start_row + $news_per_page;
if ($news_count > $target_row) $browse_url = $browse_url."<a href=".$PHP_SELF."?start_row=".$target_row." class=content_link>&gt;&gt;</a>&nbsp;";


$t->set_var("BROWSE_URL", $browse_url);





// get the number of news to be displayed on one page (entry in config.inc.php)

$sql = "SELECT * FROM news WHERE 1 ORDER BY timestamp DESC LIMIT ".$start_row.",".$news_per_page;
$result = mysql_query($sql)
	or die ("Could not get count of news from DB!");




// constructs the table with the help of the "block" function of PHPLib

while ($row = mysql_fetch_array($result)) {

	$t->set_var(array("DISPLAY_HEADLINE" => $row['headline'],
				"DISPLAY_BODY" => str_replace("\n", "<br>", $row['body']),
				"DISPLAY_DATE" => timestamp_to_form($row['timestamp'], $date_format)));
	$t->parse("OUTPUT_ROW", "TPL_ROW", true);
}




// parses the templates

$t->set_var(array("FIRST_NAME_HEADER" => $_SESSION['IDtag'][1],
			"LAST_NAME_HEADER" => $_SESSION['IDtag'][2]));


$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
