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


// confirmation page, if the user profile should really be deleted


include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if admin is logged-in

require_once("verify_login.php");



// clean up the users' input

$member = clean_input($_GET['member']);
if(isset($_GET['start_letter'])){
	$start_letter = clean_input($_GET['start_letter']);
}else{
	$start_letter = '';
}



// construct the DELETE button to be parsed in the template

$confirm_delete = '<a href="members_index.php?member='.$member.'&delete=yes&start_letter='.$start_letter.'"><img src="../templates/images/ok.gif" border="0"></a>';



// paste the data into the template

$t = new Template("../templates/admin", "remove");

$t->set_file(array("PAGE" => "members_delete_confirm.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_var("CONFIRM_DELETE", $confirm_delete);

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
