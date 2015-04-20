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


// asks the user to confirm a contact request before sending it out

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if user is logged-in

require_once("verify_login.php");




// clean up the users' input

$member = clean_input($_GET['member']);
if(isset($_GET['start_letter'])){
	$start_letter = clean_input($_GET['start_letter']);
}else{
	$start_letter = '';
}
if(isset($_GET['start_row'])){
	$start_row = clean_input($_GET['start_row']);
}else{
	$start_row = 0;
}




// paste the data into the template

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "contacts_request_confirm.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_var(array("FIRST_NAME_HEADER" => $_SESSION['IDtag'][1],
			"LAST_NAME_HEADER" => $_SESSION['IDtag'][2],
			"OK_BUTTON" => "<a href=contacts_request_ok.php?member=".$member."&start_letter=".$start_letter."&start_row=".$start_row."><img src=../templates/images/ok.gif border=0></a>",
			/*"HTML_HEADER" => $html_header*/));

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
