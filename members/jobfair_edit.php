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



// gives the "owner" of  a job offering the chance to edit the job details or delete the entry

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if user is logged-in

require_once("verify_login.php");




//clean up users' input

$job_id = clean_input($_GET['job_id']);





// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");




// get details from member

$sql = "SELECT * FROM jobfair WHERE job_id='".$job_id."' AND originator_id=".$_SESSION['IDtag'][0];
$result = mysql_query($sql)
	or die ("Could not run query on the DB!");

$row = mysql_fetch_array($result)
	or die ("Could not get result from query!");



// set the variables for the template

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "jobfair_edit.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));


$t->set_var(array("FIRST_NAME_HEADER" => $_SESSION['IDtag'][1],
			"LAST_NAME_HEADER" => $_SESSION['IDtag'][2],
			"COMPANY" => $row['company'],
			"JOB_INDUSTRY" => $row['job_industry'],
			"TITLE" => $row['title'],
			"SALARY" => $row['salary'],
			"CITY" => $row['city'],
			"COUNTRY" => $row['country'],
			"EXPERIENCE" => $row['experience'],
			"PREREQUISITES" => $row['prerequisites'],
			"DESCRIPTION" => $row['description'],
			"BENEFITS" => $row['benefits'],
			"CONTACT" => $row['contact'],
			"START_DATE_MONTH" => substr($row['start_date'], 5, 2),
			"START_DATE_YEAR" => substr($row['start_date'], 0, 4),
			"LAST_MODIFICATION" => timestamp_to_form($row['last_modification'], $date_format),
			"DELETE" => "<a href='jobfair_delete_confirm.php?job_id=".$_GET['job_id']."'><img src='../templates/images/delete.gif' border=0></a>",
			"FORM_LINK" => "jobfair_edit_ok.php?job_id=".$job_id,
			/*"HTML_HEADER" => $html_header*/));



// parse the templates

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
