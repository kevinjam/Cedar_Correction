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



// displays the jobs in the jobfair database and offers buttons to add new a new job

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if user is logged-in

require_once("verify_login.php");




// cleans up the users' input
if(isset($_GET['display'])){
	$display = clean_input($_GET['display']);
}else{
	$display = 'all';
}



// defines the template variables

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "jobfair_index.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_block("PAGE", "TPL_ROW", "OUTPUT_ROW");



// get the job data from the DB according to the display options (all or latest 10)

if ($display == "all") {
	$sql = "SELECT job_id, last_modification, job_industry, title, experience FROM jobfair ORDER BY last_modification DESC";
	$result = mysql_query($sql)
		or die("Could not retrieve job data (all) to display on webpage!");
} else {
	$sql = "SELECT job_id, last_modification, job_industry, title, experience FROM jobfair ORDER BY last_modification DESC LIMIT 10";
	$result = mysql_query($sql)
		or die("Could not retrieve job data (latest 10) to display on webpage!");
}



// constructs the table with the help of the "block" function of PHPLib

while ($row = mysql_fetch_array($result)) {
	$t->set_var(array("JOB_DATE" => "<a href=jobfair_details.php?job_id=".$row['job_id']." class='content_link'>".timestamp_to_form($row['last_modification'], $date_format)."</a>",
				"JOB_INDUSTRY" => $row['job_industry'],
				"JOB_TITLE" => $row['title'],
				"JOB_EXPERIENCE" => $row['experience']));
	
	$t->parse("OUTPUT_ROW", "TPL_ROW", true);
}



// parses the templates

$t->set_var(array("FIRST_NAME_HEADER" => $_SESSION['IDtag'][1],
			"LAST_NAME_HEADER" => $_SESSION['IDtag'][2],
			/*"HTML_HEADER" => $html_header*/));


$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
