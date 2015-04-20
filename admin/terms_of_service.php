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


// insert or update a file

if (isset($_POST['file_upload'])){
	$file_name = $_FILES['file']['name'];
	$file_tmp = $_FILES['file']['tmp_name'];
	
	
	$result = mysql_query("select * from terms_of_service") or die(mysql_error());
	if(mysql_num_rows($result) > 0){
		$record = mysql_fetch_object($result);
		$current_file = $record->file_name;
		if(file_exists('../'.$current_file)){
			unlink('../'.$current_file);
		}
		$upload = move_uploaded_file($file_tmp,'../'.$file_name);	
		if($upload){
			mysql_query("update terms_of_service set file_name='$file_name'");
		}
	}else{
		$upload = move_uploaded_file($file_tmp,'../'.$file_name);	
		if($upload){
			mysql_query("insert into terms_of_service(file_name) values ('$file_name')");
		}
	}
}

// defines the template variables


$t = new Template("../templates/admin", "remove");
$t->set_var("POST_ACTION", $_SERVER['PHP_SELF']);

$result = mysql_query("select * from terms_of_service") or die(mysql_error());
if(mysql_num_rows($result) > 0){
	$record = mysql_fetch_object($result);
	$current_file_name = $record->file_name;
}else{
	$current_file_name = 'No file uploaded on the server';
}

$t->set_var("CURRENT_FILE_NAME",$current_file_name);

$t->set_file(array("PAGE" => "terms_of_service.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->set_block("PAGE", "TPL_ROW", "OUTPUT_ROW");




// parses the templates

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->pparse("OUT", array("FOOTER", "PAGE"));
?>
