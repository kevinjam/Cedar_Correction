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


// allows the user to edit the preferences of phpAlumni (right now only subgroups)


include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if admin is logged-in

require_once("verify_login.php");



// clean up users' input
if(isset($_POST['subgroup'])){
	$subgroup = clean_input($_POST['subgroup']);
}
if(isset($_GET['subgroup_id'])){
$action = clean_input($_GET['action']);
$subgroup_id = clean_input($_GET['subgroup_id']);
}




// insert or update a subgroup

if (isset($_POST['subgroup']) && isset($_GET['action']) && $_GET['action'] == "new") {
	$sql = "INSERT INTO members_subgroup (subgroup) VALUES ('".$subgroup."')";
	$result = mysql_query($sql)
		or die("INSERT of subgroup did not work!");

} elseif(isset($_POST['subgroup']) && isset($_GET['action']) && $_GET['action'] == "update") {
	$sql = "UPDATE members_subgroup SET subgroup='".$subgroup."' WHERE subgroup_id='".$subgroup_id."'";
	$result = mysql_query($sql)
		or die("UPDATE of subgroup did not work!");
}



// defines the template variables

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "preferences_index.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_block("PAGE", "TPL_ROW", "OUTPUT_ROW");




// populates the form in case an subgroup has to be edited

if (isset($_GET['action']) && $_GET['action'] == "edit") {
	$sql = "SELECT * FROM members_subgroup WHERE subgroup_id='".$subgroup_id."'";
	$result = mysql_query($sql)
		or die ("Could not retrieve data to populate the form!");
	$row = mysql_fetch_array($result);

	$t->set_var(array("EDIT_SUBGROUP" => $row['subgroup'],
				"POST_ACTION" => $_SERVER['PHP_SELF']."?action=update&subgroup_id=".$row['subgroup_id']));

} else $t->set_var("POST_ACTION", $_SERVER['PHP_SELF']."?action=new");




// constructs the table with the help of the "block" function of PHPLib

$sql = "SELECT * FROM members_subgroup WHERE 1";
$result = mysql_query($sql)
	or die ("Could not retrieve data!");

while ($row = mysql_fetch_array($result)) {

	$t->set_var(array("DISPLAY_SUBGROUP" =>"<a href=".$_SERVER['PHP_SELF']."?action=edit&subgroup_id=".$row['subgroup_id']." class=content_link>".$row['subgroup']."</a>",
				"DELETE" => "<a href=preferences_delete_confirm.php?subgroup_id=".$row['subgroup_id']."><img src='../templates/images/delete.gif' border=0></a>"));
	$t->parse("OUTPUT_ROW", "TPL_ROW", true);
}




// parses the templates

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
