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


// allows the superuser to retrieve a list of emailaddresses for use in a mailclient

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");




// validates if admin is logged-in

require_once("verify_login.php");




// clean up the users' input
// $addresses is an array, for that reason a little more action is needed

if (isset($_POST['addresses'])) {

	$i =0;
	
	foreach ($_POST['addresses'] as $subgroup) {
		$addresses[$i] = clean_input($subgroup);
		$i++;
	}
}

// defines the template variables

$t = new Template("../templates/admin", "remove");


$t->set_file(array("PAGE" => "addressdownload_index.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

//$t->set_block("PAGE", "TPL_ROW", "OUTPUT_ROW");





// make a list of all possible recipients

$sql = "SELECT * FROM members_subgroup WHERE 1";
$result = mysql_query($sql)
	or die ("Could not retrieve data from DB!");

$i = 0;
$recipients = '';
while ($row = mysql_fetch_array($result)) {
	if ($i == 0) {
		$recipients .= $recipients."<tr>";
	}

	$recipients .= $recipients."<td><input type=checkbox name='addresses[]' value=".$row['subgroup_id'].">&nbsp;".$row['subgroup']."</td>";
	$i++;

	if ($i == 2) {
		$recipients .= $recipients."</tr>";
		$i = 0;
	}
}

$t->set_var("RECIPIENTS", $recipients);


// get all required email-addresses from the members DB

if(isset($_POST['addresses'])) {
	$i = 0;
	$addresslist = $addresses;
	foreach ($addresses as $subgroup) {
		$sql = "SELECT email FROM members WHERE subgroup='".$subgroup."'";
		$result = mysql_query($sql)
			or die ("Could not retrieve data from DB!");

		while($row = mysql_fetch_array($result)) {
			$addresslist[$i] = $row['email'];
			$i++;
		}
	}

	if ($addresslist!="") {
		$addresslist = implode(", ", $addresslist);
	}
	
	$t->set_var("ADDRESSLIST", $addresslist);
}



// parses the templates

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
