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


// allows the superuser so write, edit and delete news for the member's frontpage


include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if admin is logged-in

require_once("verify_login.php");



// clean up the users' input
if(isset($_POST['headline'])){
$headline = clean_input($_POST['headline']);
$body = clean_input($_POST['body']);
}
if(isset($_GET['news_id'])){
	$action = clean_input($_GET['action']);
	$news_id = clean_input($_GET['news_id']);
}

if(isset($_GET['start_row'])){
	$start_row = clean_input($_GET['start_row']);
}else{
	$start_row = 0;
}




// stuff to connect correctly to the DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");
	
	

// insert or update a newsflash

if (isset($_POST['headline']) && isset($_POST['body']) && isset($_GET['action']) && $_GET['action'] == "new") {
	$sql = "INSERT INTO news (headline, body) VALUES ('".$headline."', '".$body."')";
	$result = mysql_query($sql)
		or die("INSERT of newsflash did not work!");

} elseif(isset($_POST['headline']) && isset($_POST['body']) && isset($_GET['action']) && $_GET['action'] == "update") {
	
	$sql = "UPDATE news SET headline='".$headline."', body='".$body."' WHERE news_id=".$news_id;
	$result = mysql_query($sql)
		or die("UPDATE of newsflash did not work!");
}



// defines the template variables

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "news_index.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_block("PAGE", "TPL_ROW", "OUTPUT_ROW");




// populates the form in case an article has to be edited

if (isset($_GET['action']) && $_GET['action'] == "edit") {
	$sql = "SELECT news_id, headline, body FROM news WHERE news_id=".$news_id;
	$result = mysql_query($sql)
		or die ("Could not retrieve data to populate the form!");
	$row = mysql_fetch_array($result);
	
	$t->set_var(array("EDIT_HEADLINE" => $row['headline'],
				"EDIT_BODY" => $row['body'],
				"POST_ACTION" => $_SERVER['PHP_SELF']."?action=update&news_id=".$row['news_id']));

} else $t->set_var("POST_ACTION", $_SERVER['PHP_SELF']."?action=new");




// define the startrow

if (!isset($_GET['start_row'])) {
	$start_row = "0";
}



// build the navigation elements for forward and backward browsing

$sql = "SELECT news_id FROM news WHERE 1";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB! (navigation)");
$news_count = mysql_num_rows($result);


// build '"<<" arrows for backward browsing
$target_row = $start_row - $news_per_page;

if ($target_row < "0") {
	$target_row = "0";
}

if ($start_row != "0") {
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





// get number of news to be displayed on one page (entry in config.inc.php)

$sql = "SELECT * FROM news WHERE 1 ORDER BY timestamp DESC LIMIT ".$start_row.",".$news_per_page;
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB! (number of news)");




// constructs the table with the help of the "block" function of PHPLib

while ($row = mysql_fetch_array($result)) {

	$t->set_var(array("DISPLAY_HEADLINE" => $row['headline'],
				"DISPLAY_BODY" => str_replace("\n", "<br>", $row['body']),
				"EDIT" =>"<a href=".$_SERVER['PHP_SELF']."?action=edit&news_id=".$row['news_id']."><img src='../templates/images/edit.gif' border=0></a>",
				"DELETE" => "<a href=news_delete_confirm.php?news_id=".$row['news_id']."><img src='../templates/images/delete.gif' border=0></a>",
				"DISPLAY_DATE" => timestamp_to_form($row['timestamp'], $date_format)));
	$t->parse("OUTPUT_ROW", "TPL_ROW", true);
}




// parses the templates

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
