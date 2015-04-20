<?php

/*
############################################################################
phpAlumni - A web-based, MySQL-backed alumni management program written in PHP4.
Copyright (C) 2014-2015 Ralf Hetzer

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



// This is the main phpAlumni configuration file




// MySQL information to connect correctly to the DB

$dbhost = "mysql6.000webhost.com";		// address of the DB host
$dbname = "a3130882_cedar";		// name of the DB to be used by phpAlumni
$dbuser = "a3130882_cedar";	// username to access the DB
$dbpass = "janvier570";	// password for the respective user

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");



// other configurations

$admin_password = "janvier570";		// password for the admin (login name is always: admin)
$admin_email = "kevin.janvier5@gmail.com";	// email of admin
$min_password_length = "8";		// the minimum length of a password
$hash_password = "nd7$9&snDE2+dq!2kd78{22nl9DdO";	// enter something really wierd like this: "nd7$9&snDE2+dq!2kd78{22nl9DdO" (But do not copy THIS string!)
$date_format = "us";				// can be "eu" for DD.MM.YYYY or "us" for MM/DD/YYYY
$mail_header = "From: [ADMIN_EMAIL]\nReply-To: [ADMIN_EMAIL]\nX-Mailer: PHP/";	// this is the header that is used when the system sends out emails
$mail_type = "1";				// "1" for servers that allow setting header information, "2" for servers that do not allow user-set header information 
$rows_per_page = "10";			// determines how many rows of members are displayed on the member overview (25 is a reasonable number)
$news_per_page = "5";			// determines the number of news to be displayed on the frontpage
$newsletters_per_page = "5";			// determines the number of newsletter to be displayed on the admin page
$birthday_look_ahead = "30";		// number of days the birthday calendar should look ahead


// mail settings for the signup procedure
// this is the message new members get after they signed up. [FIRST_NAME] and [LAST_NAME] refers to the person who is signing up. Linebreaks are done by inserting "\n"

$mail_subject_signup = "Welcome to Am a Cedar Alumni Network!";		// subject of email for new members
$mail_text_signup = "Hello [FIRST_NAME] [LAST_NAME]!\n\nYou signed up for Am a Cedar Alumni Network. With your login you can access all the services of a normal member. Look around, have fun!\n\nPlease use the following data to log in.\nUsername: [EMAIL]\nPassword: [PASSWORD]\n\nPlease note that your account will be deleted if you do not log in at least once within 30 days from now!\n\n
PATRICK KARUGABA.";



// mail settings for the "Tell a Friend" function
// this message is send out to people invited with the "Tell a Friend" function. [FIRST_NAME] and [LAST_NAME] refer to the person being invited.  Linebreaks are done by inserting "\n"

$mail_subject_tellafriend = "Invitation to Am a Cedar Alumni Network!";		// subject of message sent to invited persons
$mail_text_tellafriend = "Hello [FIRST_NAME] [LAST_NAME]!\n\n[USER_FIRST_NAME] [USER_LAST_NAME] (Email: [USER_EMAIL]) invited you to Am a CedarAlumni Network. You can log in to the plattform with the following data:\n\nUsername: [EMAIL]\nPassword: [PASSWORD]\n\nPlease note that your password will expire if you do not log in at least once within 30 days from now. If you are not interested in phpAlumni or think this mail was sent to you by accident, you can simply ignore it.\n\nBye.";



// mail settings for the "Lost password" function
// this is the message new members get after they requested a new password. Linebreaks are done by inserting "\n"

$mail_subject_lostpw = "New Password for Am a Cedar Alumni Network";		// subject of message
$mail_text_lostpw = "Hello.\n\nYou requested a new password for you account on Am a CedarAlumni Network.\n\nYour new password is: [PASSWORD]\n\nHave fun!";



// mail settings for the notification of new contacts
// this message is sent out to people who were invited to a user's contact list

$mail_subject_contactrequest = "New contact request on Am a Cedar Alumni Network";		// subject of message
$mail_text_contactrequest = "Hello [FIRST_NAME_1] [LAST_NAME_1].\n\n[FIRST_NAME_2] [LAST_NAME_2] (Email: [USER_EMAIL]) would like to put you on her/his contact list. Please log in to Am a CedarAlumni Network and decide about the request.\n\nBye.";



// mail message when a user removed a person from the contact list

$mail_subject_remove_contact = "Contact removed on Am a Cedar Alumni Network";		// subject of message
$mail_text_remove_contact = "Hello [FIRST_NAME_1] [LAST_NAME_1].\n\n[FIRST_NAME_2] [LAST_NAME_2]  (Email: [USER_EMAIL]) dropped you from her/his contact list. This was a decision by the respective user, the network is only the messenger.\n\nBye.";



// mail message when a user declines a person's contact request

$mail_subject_decline_contact = "Contact request on Am a Cedar Alumni Network declined.";		// subject of message
$mail_text_decline_contact = "Hello [FIRST_NAME_1] [LAST_NAME_1].\n\n[FIRST_NAME_2] [LAST_NAME_2]  (Email: [USER_EMAIL]) Declined your request to be put on your contact list.\n\nBye.";



// mail message when a user withdraws an outgoing contact request

$mail_subject_cancel_contact = "Contact request withdrawn on Am a Cedar Alumni Network";		// subject of message
$mail_text_cancel_contact = "Hello [FIRST_NAME_1] [LAST_NAME_1].\n\n[FIRST_NAME_2] [LAST_NAME_2]  (Email: [USER_EMAIL]) withdrew her/his request to put you on her/his contact list.\n\nBye.";



// mail message to persons in contact list when a user updates her/his profile

$mail_subject_profile_update = "Profile update on Am a Cedar Alumni Network";		// subject of message
$mail_text_profile_update = "Hello [FIRST_NAME_1] [LAST_NAME_1]\n\n[FIRST_NAME_2] [LAST_NAME_2] updated her/his profile on Am a CedarAlumni Network.\n\n
First name: [FIRST_NAME]
Last name: [LAST_NAME]
Email: [EMAIL]\n
Home details\n
Address: [HOME_ADDRESS]
Extra row: [HOME_ADDRESS_EXTRA]
ZIP: [HOME_ZIP]
City: [HOME_CITY]
State: [HOME_STATE]
Country: [HOME_COUNTRY]
Phone: [HOME_PHONE]
Cellphone: [HOME_CELLPHONE]
Birthday: [BIRTHDAY]
Homepage: [HOME_HOMEPAGE]\n
School info\n
Year of Graduation: [YEAR]
Term: [TERM]
Other Info: [HOME_OTHER_INFO]
Majors: [MAJORS]\n
Company Information\n
Position: [POSITION]
Industry: [INDUSTRY]
Address: [COMPANY_ADDRESS]
Extra row: [COMPANY_ADDRESS_EXTRA]
ZIP: [COMPANY_ZIP]
City: [COMPANY_CITY]
State: [COMPANY_STATE]
Country: [COMPANY_COUNTRY]
Phone: [COMPANY_PHONE]
Cellphone: [COMPANY_CELLPHONE]
Homepage: [COMPANY_HOMEPAGE]
Description: [COMPANY_DESCRIPTION]
Other Info: [COMPANY_OTHER_INFO]\n\nBye.";

?>
