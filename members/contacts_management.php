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

// deletes, accepts incoming ad outgoing contact requests, this file is the management logic behind contacts_index.php

session_start();

include("../template.inc.php");
include("../config.inc.php");
include("../functions.inc.php");



// validates if user is logged-in

require_once("verify_login.php");




// clean up the users' input

$member = clean_input($_GET['member']);
$decision = clean_input($_GET['decision']);



// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");




// user decides to remove a person from the contact list

if($decision == 'remove') {
	
	$sql = "DELETE FROM contacts WHERE (initiator='".$member."' AND recipient='".$_SESSION['IDtag'][0]."') OR (initiator='".$_SESSION['IDtag'][0]."' AND recipient='".$member."')";
	
	$result = mysql_query($sql)
		or die("Could not delete row from table contacts!");

	
	// get the data of the person to be removed
	
	$sql = "SELECT first_name, last_name, email FROM members WHERE id='".$member."'";
	
	$result = mysql_query($sql)
		or die("Could not get data from DB!");

	$row = mysql_fetch_row($result);
	
	
	
	// get the email address of the current user
	
	$sql = "SELECT email FROM members WHERE id='".$_SESSION['IDtag'][0]."'";
	
	$result = mysql_query($sql)
		or die("SELECT of recipient did not work!");
		
	$row2 = mysql_fetch_row($result);




	// replace placeholders from config.inc.php and send mail

	$mail_text_remove_contact = str_replace("[FIRST_NAME_1]", $row[0], $mail_text_remove_contact);
	$mail_text_remove_contact = str_replace("[LAST_NAME_1]", $row[1], $mail_text_remove_contact);
	$mail_text_remove_contact = str_replace("[FIRST_NAME_2]", $_SESSION['IDtag'][1], $mail_text_remove_contact);
	$mail_text_remove_contact = str_replace("[LAST_NAME_2]", $_SESSION['IDtag'][2], $mail_text_remove_contact);
	$mail_text_remove_contact = str_replace("[USER_EMAIL]", $row2[0], $mail_text_remove_contact);
	$mail_header = str_replace("[ADMIN_EMAIL]", $admin_email, $mail_header);

	send_email($row[2], $mail_subject_remove_contact, $mail_text_remove_contact, $mail_header);



	
// user decides to accept the incoming contact request

} elseif($decision == 'accept') {

	$sql = "UPDATE contacts SET acceptance='1' WHERE initiator='".$member."' AND recipient='".$_SESSION['IDtag'][0]."'";
	$result = mysql_query($sql)
		or die("Could not update acceptance!");


		
		
// user decides to decline an incoming contact request (unfriendly bastard!)

} elseif($decision == 'decline') {

	$sql = "DELETE FROM contacts WHERE initiator='".$member."' AND recipient='".$_SESSION['IDtag'][0]."'";
	
	$result = mysql_query($sql)
		or die("Could not delete contact request!");

	
	// get the data of the declined contact
	
	$sql = "SELECT first_name, last_name, email FROM members WHERE id='".$member."'";
	
	$result = mysql_query($sql)
		or die("Could not get data from DB!");

	$row = mysql_fetch_row($result);


	// get the email address of the current user
	
	$sql = "SELECT email FROM members WHERE id='".$_SESSION['IDtag'][0]."'";
	
	$result = mysql_query($sql)
		or die("SELECT of recipient did not work!");
		
	$row2 = mysql_fetch_row($result);


	// replace placeholders from config.inc.php and send mail

	$mail_text_decline_contact = str_replace("[FIRST_NAME_1]", $row[0], $mail_text_decline_contact);
	$mail_text_decline_contact = str_replace("[LAST_NAME_1]", $row[1], $mail_text_decline_contact);
	$mail_text_decline_contact = str_replace("[FIRST_NAME_2]", $_SESSION['IDtag'][1], $mail_text_decline_contact);
	$mail_text_decline_contact = str_replace("[LAST_NAME_2]", $_SESSION['IDtag'][2], $mail_text_decline_contact);
	$mail_text_decline_contact = str_replace("[USER_EMAIL]", $row2[0], $mail_text_decline_contact);
	$mail_header = str_replace("[ADMIN_EMAIL]", $admin_email, $mail_header);

	send_email($row[2], $mail_subject_decline_contact, $mail_text_decline_contact, $mail_header);


// user decides to cancel her/his request to be put on someone's contact list

} elseif($decision == 'cancel') {

	$sql = "DELETE FROM contacts WHERE initiator='".$_SESSION['IDtag'][0]."' AND recipient='".$member."'";
	
	$result = mysql_query($sql)
		or die("Could not delete contact request!");

		
	// get the canceled members contact details
	
	$sql = "SELECT first_name, last_name, email FROM members WHERE id='".$member."'";
	$result = mysql_query($sql)
		or die("Could not get data from DB!");

	$row = mysql_fetch_row($result);


	// get the email address of the current user
	
	$sql = "SELECT email FROM members WHERE id='".$_SESSION['IDtag'][0]."'";
	
	$result = mysql_query($sql)
		or die("SELECT of recipient did not work!");
		
	$row2 = mysql_fetch_row($result);

	
	// replace placeholders from config.inc.php and send mail

	$mail_text_cancel_contact = str_replace("[FIRST_NAME_1]", $row[0], $mail_text_cancel_contact);
	$mail_text_cancel_contact = str_replace("[LAST_NAME_1]", $row[1], $mail_text_cancel_contact);
	$mail_text_cancel_contact = str_replace("[FIRST_NAME_2]", $_SESSION['IDtag'][1], $mail_text_cancel_contact);
	$mail_text_cancel_contact = str_replace("[LAST_NAME_2]", $_SESSION['IDtag'][2], $mail_text_cancel_contact);
	$mail_text_cancel_contact = str_replace("[USER_EMAIL]", $row2[0], $mail_text_cancel_contact);
	$mail_header = str_replace("[ADMIN_EMAIL]", $admin_email, $mail_header);

	send_email($row[2], $mail_subject_cancel_contact, $mail_text_cancel_contact, $mail_header);
}



// paste the data into the template

$t = new Template("../templates/members", "remove");

$t->set_file(array("PAGE" => "contacts_management.tpl",
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
