<!DOCTYPE HTML>
<html class="no-js">
<head>
<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Cedar | Alumni Network</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<!-- CSS
  ================================================== -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="plugins/mediaelement/mediaelementplayer.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/icon.ico">
<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css" media="screen" /><![endif]-->
<!-- Color Style -->
<link class="alt" href="colors/color1.css" rel="stylesheet" type="text/css">
<link href="style-switcher/css/style-switcher.css" rel="stylesheet" type="text/css">
<!-- SCRIPTS
  ================================================== -->
<script src="js/modernizr.js"></script><!-- Modernizr -->
</head>
<body>
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<div class="body"> 
  <!-- Start Site Header -->
 <?php include('header.php'); ?>
  <!-- End Site Header --> 
  <!-- Start Hero Slider -->
  <?php
// the startpage where the user logs-in

session_start();

include("config.inc.php");
include("functions.inc.php");
include("template.inc.php");




// clean up the users' input

$email = clean_input($_POST['email']);



// connect to DB

$db = mysql_connect($dbhost,$dbuser,$dbpass)
	or die("Could not connect to DB!");

mysql_select_db($dbname,$db)
	or die ("Could not select DB!");



// check if email is registered

$sql = "SELECT id FROM members WHERE email='".$email."'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

if($row[0]) {
	// generate a random password and insert it into the DB

	$password = rand_pass();
	$sql = "UPDATE members SET password='".$password."' WHERE id='".$row[0]."'";
	$result = mysql_query($sql)
		or die ("Could not change password!");



	// replace placeholders from config.inc.php

	$mail_text_lostpw = str_replace("[PASSWORD]", $password, $mail_text_lostpw);
	$mail_header = str_replace("[ADMIN_EMAIL]", $admin_email, $mail_header);



	// mail password out to new user

	send_email($email, $mail_subject_lostpw, $mail_text_lostpw, $mail_header);
}



// if there is no such email registered in the system, the phreak will not be told. the output for valid/invalid email addresses is always the same



// parse the templates

$t = new Template("templates", "remove");

$t->set_file(array("PAGE" => "lost_password_ok.tpl",
			"HEADER" => "header.tpl",
			"SPONSORS" => "sponsors.tpl",
			"NAVIGATION" => "navigation.tpl",
			"FOOTER" => "footer.tpl"));

$t->parse("HEADER", "HEADER");
$t->parse("SPONSORS", "SPONSORS");
$t->parse("NAVIGATION", "NAVIGATION");
$t->parse("FOOTER", "FOOTER");
$t->pparse("OUT", "PAGE");
?>


        <!-- Start Footer Widgets -->
      
 
  <!-- End Footer --> 
</div>
 <?php include("footer.php");?>

<script src="js/jquery-2.0.0.min.js"></script> <!-- Jquery Library Call --> 
<script src="plugins/prettyphoto/js/prettyphoto.js"></script> <!-- PrettyPhoto Plugin --> 
<script src="js/helper-plugins.js"></script> <!-- Plugins --> 
<script src="js/bootstrap.js"></script> <!-- UI --> 
<script src="js/waypoints.js"></script> <!-- Waypoints --> 
<script src="plugins/mediaelement/mediaelement-and-player.min.js"></script> <!-- MediaElements --> 
<script src="js/init.js"></script> <!-- All Scripts --> 
<script src="plugins/flexslider/js/jquery.flexslider.js"></script> <!-- FlexSlider --> 
<script src="plugins/countdown/js/jquery.countdown.min.js"></script> <!-- Jquery Timer --> 
<script src="style-switcher/js/jquery_cookie.js"></script> 
<script src="style-switcher/js/script.js"></script> 
</body>
</html>