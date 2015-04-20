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


// confirms that the job offering was added to the jobfair DB successfully

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if user is logged-in

require_once("verify_login.php");




// clean up the users' input

$start_date_year = clean_input($_POST['start_date_year']);
$start_date_month = clean_input($_POST['start_date_month']);
$company = clean_input($_POST['company']);
$job_industry = clean_input($_POST['job_industry']);
$title = clean_input($_POST['title']);
$salary = clean_input($_POST['salary']);
$city = clean_input($_POST['city']);
$country = clean_input($_POST['country']);
$experience = clean_input($_POST['experience']);
$prerequisites = clean_input($_POST['prerequisites']);
$benefits = clean_input($_POST['benefits']);
$contact = clean_input($_POST['contact']);
$description = clean_input($_POST['description']);




// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");



// construct the correct $start_date from the form data

$start_date = $start_date_year."-".$start_date_month."-01";



// enter the contact request into the DB

$sql = "INSERT INTO jobfair (originator_id, company, job_industry, title, salary, city, country, experience, prerequisites, benefits, contact, start_date, description) VALUES ('".$_SESSION['IDtag'][0]."', '".$company."', '".$job_industry."', '".$title."', '".$salary."', '".$city."', '".$country."', '".$experience."', '".$prerequisites."', '".$benefits."', '".$contact."', '".$start_date."', '".$description."')";
$result = mysql_query($sql)
	or die("INSERT into DB did not work!");



// paste the data into the template

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "jobfair_add_ok.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_var(array("FIRST_NAME_HEADER" => $_SESSION['IDtag'][1],
			"LAST_NAME_HEADER" => $_SESSION['IDtag'][2],
			/*"HTML_HEADER" => $html_header*/));

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
