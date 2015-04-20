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


// displays the terms of service and functionality to accept them if necessary

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if user is logged-in

require_once("verify_login.php");




// clean the users' input
if(isset($_GET['acceptance'])){
$acceptance = clean_input($_GET['acceptance']);
}else{
	$acceptance = 0;
}




// parse the templates

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE"=> "terms_of_service_index.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));



// check if the acceptance functionality has to be put on the page

if($acceptance == "0") {
	$acceptance_html = "<form action=index.php method=POST><input type=checkbox name=acceptance>&nbsp;&nbsp;I have read and accepted the terms of service of this network.<br><br>If you do not want to join this network, please hit \"Log-Out\" immediately and do not return to this website. Your account will be deleted automatically after some days.<br><br><p align=right><input type=image src=../templates/images/ok.gif border=0></p></form>";
	
	$t->set_var(array("FIRST_NAME_HEADER" => "Terms of service have not been accepted, yet!",
				"ACCEPTANCE_HTML" => $acceptance_html));

	$t->parse("HEADER", "HEADER");

	// there is no navigation to avoid user bypassing the acceptance of terms
	$t->parse("SPONSORS", "SPONSORS");
	$t->pparse("OUT", array("FOOTER", "PAGE"));

} else {
	$t->set_var(array("FIRST_NAME_HEADER" => $_SESSION['IDtag'][1],
				"LAST_NAME_HEADER" => $_SESSION['IDtag'][2]));

	$t->parse("HEADER", "HEADER");
	$t->parse("SPONSORS", "SPONSORS");
	$t->parse("NAVIGATION", "NAVIGATION");
	$t->pparse("OUT", array("FOOTER", "PAGE"));
}
?>
