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



/*
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

This file contains all common functions used within phpAlumni

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

*/



// cleans up the users' input to prevent input of HTML and PHP code

function clean_input($input) {
		$output = trim(strip_tags($input));
		return $output;
}




// sends out mail according to the preferences set in config.inc.php

function send_email($email, $mail_subject_signup, $mail_text_signup, $mail_header) {

	// user-set email headers allowed by server
	
	if ($mail_type = "1") {
		mail($email, $mail_subject_signup, $mail_text_signup, $mail_header);
	}

	// user-set email headers NOT allowed by server
	
	elseif ($mail_type = "2") {
		mail($email, $mail_subject_signup, $mail_text_signup);
	}

	else die("Please check your mail setup in the configuration file!");
}




// checks an email address for invalid characters and for an existing MX

function check_email($email) {

	// check if there are any strange characters in the emailaddress

	if (!eregi("^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+"."@"."[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\."."[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$", $email)) {
		$return = ("Email address contains unallowed characters. Please check!");
		return $return;
	}

	list ($username, $domain) = split("@", $email);

	if (!checkdnsrr($domain.".", "MX")) {
		$return = ("Could not get DNS record for host. Please check emailadress!");
		return $return;
	}
}

function check_email2($email)
  {
  //filter_var() sanitizes the e-mail
  //address using FILTER_SANITIZE_EMAIL
  $email= filter_var($email, FILTER_SANITIZE_EMAIL);

  //filter_var() validates the e-mail
  //address using FILTER_VALIDATE_EMAIL
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
    	die("The emailadress is not valid! Please hit the BACK button and check it!");
    }
	
	/*list ($username, $domain) = split("@", $email);

	if (!checkdnsrr($domain.".", "MX")) {
		$return = ("Could not get DNS record for host. Please check emailadress!");
		return $return;
	}*/
  }

// db_to_form converts a MySQL "date" into a human readable form

function db_to_form($date, $date_format) {
	if ($date == "0000-00-00") return "";		// intercepts the ugly output of 0000-00-00 to the form
	$d = array();
	$d['day'] = substr($date, 8, 2);
	$d['month'] = substr($date, 5, 2);
	$d['year'] = substr($date, 0, 4);

	if ($date_format == "eu") {				// the user can choose between European or US format (done in config.inc.php)
		return $d['day'].'.'.$d['month'].'.'.$d['year'];
	} elseif ($date_format == "us") {
		return $d['month'].'/'.$d['day'].'/'.$d['year'];
	} else die ("Please check variable date_format in config.inc.php!");
}

function form_to_db($date, $date_format) {
	if ($date_format == "eu") {
		if (ereg("([0-9]{1,2}).([0-9]{1,2}).([0-9]{2,4})", $date, $regs)) {
			if(strlen($regs[1]) < 2) $regs[1]= "0$regs[1]";
			if(strlen($regs[2]) < 2) $regs[2] = "0$regs[2]";
			if(strlen($regs[3]) < 4) $regs[3] = "20$regs[3]";			// this will work for the next 998 years
			return "$regs[3]-$regs[2]-$regs[1]";
		} else {
			return FALSE;
		}
	} elseif ($date_format == "us") {
		if (ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $date, $regs)) {
			if(strlen($regs[1]) < 2) $regs[1]= "0$regs[1]";
			if(strlen($regs[2]) < 2) $regs[2] = "0$regs[2]";
			if(strlen($regs[3]) < 4) $regs[3] = "20$regs[3]";			// this will work for the next 998 years
			return "$regs[3]-$regs[1]-$regs[2]";
		} else {
			return FALSE;
		}
	} else die ("Please check variable date_format in config.inc.php!");
}



// converts TIMESTAMP(8) to a human readable format

function timestamp_to_form($date, $date_format) {
	if ($date == "00000000") return "";		// intercepts the ugly output of 00000000 to the form
	$d = array();
	$d['day'] = substr($date, 6, 2);
	$d['month'] = substr($date, 4, 2);
	$d['year'] = substr($date, 0, 4);

	if ($date_format == "eu") {				// the user can choose between European or US format (done in config.inc.php)
		return $d['day'].'.'.$d['month'].'.'.$d['year'];

	} elseif ($date_format == "us") {
		return $d['month'].'/'.$d['day'].'/'.$d['year'];

	} else die ("Please check variable date_format in config.inc.php!");
}



/* *
 *  Function : string rand_pass()
 *
 *  Purpose : Returns a random but pronounceable password.
 *  Note: You may edit the $num_letters and $array variables
 *
 *  Author: Sebastien Cevey <seb@cine7.net>
 *  Project: Web OpenScripts <http://wos.sourceforge.net>
 * */

function rand_pass() {
$pass = '';
// Pronounceable pieces of words
$array = array(
		 "ap","dus","tin","rog","sti","rev","pik","sty","lev","qot","rel","vid",
		 "kro","xo","pro","wia","axi","jer","foh","mu","ya","zol","gu","pli","cra",
		 "den","bi","sat","ry","qui","wip","fla","gro","tav","peh","gil","lot",
		 "kal","zan","noc","bat","tev","lun","pal","hom","cun","wos","vox"
		 );


// The number of letters
$num_letters = 8;


// Fraction of uppercased letters (randomized too...)
$uppercased = 3;

// Randomize on microseconds
mt_srand ((double)microtime()*1000000);


// Create random pass (too long for the moment)
for($i=0; $i<$num_letters; $i++) $pass .= $array[mt_rand(0, (count($array) - 1))];


// Make sure there is not twice the same letter one after the other
for($i=1; $i<strlen($pass); $i++) {
	if(substr($pass, $i, 1) == substr($pass, $i-1, 1)) $pass = substr($pass, 0, $i) . substr($pass, $i+1);
}


// Randomize the pass case [for each letter]
for($i=0; $i<strlen($pass); $i++) {
	if(mt_rand(0, $uppercased) == 0) $pass = substr($pass,0,$i) . strtoupper(substr($pass, $i,1)) . substr($pass, $i+1);
}


// Shorten it now
$pass = substr($pass, 0, $num_letters);

 
 //Return the password
return $pass;
}

?>
