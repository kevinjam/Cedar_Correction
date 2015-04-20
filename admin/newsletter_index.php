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


// allows the superuser to send newsletters to all members


include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if admin is logged-in

require_once("verify_login.php");




// clean up the users' input
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
	
	

// defines the template variables

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "newsletter_index.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_block("PAGE", "TPL_ROW", "OUTPUT_ROW");




// make a list of all possible recipients

$sql = "SELECT * FROM members_subgroup WHERE 1";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");

$i=0;
$recipients = '';
while ($row = mysql_fetch_array($result)) {
	if ($i == 0) {
		$recipients .= $recipients."<tr>";
	}
	
	$recipients .= $recipients."<td><input type=checkbox name='recipients[]' value=".$row['subgroup_id']."><span class=content_text>&nbsp;".$row['subgroup']."</span></td>";
	$i++;

	if ($i == 2) {
		$recipients .= $recipients."</tr>";
		$i = 0;
	}
}

$t->set_var("RECIPIENTS", $recipients);



// define the startrow

if (!isset($_GET['start_row'])) {
	$start_row = 0;
}



// build the navigation elements for forward and backward browsing

$sql = "SELECT id FROM newsletters WHERE 1";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");
$newsletter_count = mysql_num_rows($result);


// build '"<<" arrows for backward browsing
$target_row = $start_row - $newsletters_per_page;
if ($target_row < "0") {
	$target_row = "0";
}

if ($start_row != "0") {
	$browse_url = "<a href=".$PHP_SELF."?start_row=".$target_row." class=content_link>&lt;&lt;</a>&nbsp;";
}else{
	$browse_url = '';
}


// build links for direct access to the pages
$link_count = ceil($newsletter_count/$newsletters_per_page);
$i = 1;
while ($i < $link_count) {
	$target_row = $i*$newsletters_per_page;
	$i++;
	
	if ($start_row == $target_row) {
		$browse_url = $browse_url."&lt;".$i."&gt;&nbsp;";
	} else {
		$browse_url = $browse_url."<a href=".$PHP_SELF."?start_row=".$target_row." class=content_link>&lt;".$i."&gt;</a>&nbsp;";
	}
}


// build ">>" arrows for forward browsing
$target_row = $start_row + $newsletters_per_page;
if ($newsletter_count > $target_row) $browse_url = $browse_url."<a href=".$PHP_SELF."?start_row=".$target_row." class=content_link>&gt;&gt;</a>&nbsp;";


$t->set_var("BROWSE_URL", $browse_url);





// get newsletters to be displayed on one page (entry in config.inc.php)

$sql = "SELECT * FROM newsletters WHERE 1 ORDER BY timestamp DESC LIMIT ".$start_row.",".$newsletters_per_page;
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");

// displays the newsletter history
while ($row = mysql_fetch_array($result)) {

	$recipients_array = explode(",", $row['recipients']);
	
	foreach ($recipients_array as $offset => $subgroup_id) {
		$sql = "SELECT subgroup FROM members_subgroup WHERE subgroup_id=".$subgroup_id;
		$sub_result = mysql_query($sql)
			or die ("Could not retrieve subgroup name from DB!");
		
		$sub_row = mysql_fetch_array($sub_result);
		$recipients_array[$offset] = $sub_row['subgroup'];
	}

	$recipients_list = implode (", ", $recipients_array);

	$t->set_var(array("SUBJECT" => $row['subject'],
				"BODY" => str_replace("\n", "<br>", $row['body']),
				"RECIPIENTS_LIST" => $recipients_list,
				"DATE" => timestamp_to_form($row['timestamp'], $date_format)));
	$t->parse("OUTPUT_ROW", "TPL_ROW", true);
}




// parses the templates

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
