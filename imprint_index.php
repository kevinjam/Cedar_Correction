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



// Redirects logged-in users to the member's section

include("template.inc.php");
include("config.inc.php");



// parse the templates

$t = new Template("templates", "remove");
$t->set_file(array("PAGE" => "imprint_index.tpl",
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
<!-- Style Switcher Start -->
<div class="styleswitcher visible-lg visible-md">
  <div class="arrow-box"><a class="switch-button"><span class="fa fa-cogs fa-lg"></span></a> </div>
  <h4>Color Skins</h4>
  <ul class="color-scheme">
    <li><a href="#" data-rel="colors/color1.css" class="color1" title="color1"></a></li>
    <li><a href="#" data-rel="colors/color2.css" class="color2" title="color2"></a></li>
    <li><a href="#" data-rel="colors/color3.css" class="color3" title="color3"></a></li>
    <li><a href="#" data-rel="colors/color4.css" class="color4" title="color4"></a></li>
    <li><a href="#" data-rel="colors/color5.css" class="color5" title="color5"></a></li>
    <li class="nomargin"><a href="#" data-rel="colors/color6.css" class="color6" title="color6"></a></li>
    <li class="nomargin"><a href="#" data-rel="colors/color7.css" class="color7" title="color7"></a></li>
    <li class="nomargin"><a href="#" data-rel="colors/color8.css" class="color8" title="color8"></a></li>
    <li class="nomargin"><a href="#" data-rel="colors/color9.css" class="color9" title="color9"></a></li>
    <li class="nomargin"><a href="#" data-rel="colors/color10.css" class="color10" title="color10"></a></li>
  </ul>
  <h4>Layout</h4>
  <ul class="layouts">
    <li class="wide-layout"><a href="#" title="Wide">Wide</a></li>
    <li class="boxed-layout"><a href="#" title="Boxed">Boxed</a></li>
  </ul>
  <h4>Background Pattern</h4>
  <ul class="background-selector">
    <li><img alt="" src="style-switcher/backgrounds/patterns/pt1.png" data-nr="0" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/patterns/pt2.png" data-nr="1" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/patterns/pt3.png" data-nr="2" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/patterns/pt4.png" data-nr="3" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/patterns/pt5.png" data-nr="4" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/patterns/pt6.png" data-nr="5" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/patterns/pt7.png" data-nr="6" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/patterns/pt8.png" data-nr="7" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/patterns/pt9.png" data-nr="8" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/patterns/pt10.png" data-nr="9" width="20" height="20"></li>
    <li class="nomargin"><img alt="" src="style-switcher/backgrounds/patterns/pt11.jpg" data-nr="10" width="20" height="20"></li>
    <li class="nomargin"><img alt="" src="style-switcher/backgrounds/patterns/pt12.jpg" data-nr="11" width="20" height="20"></li>
    <li class="nomargin"><img alt="" src="style-switcher/backgrounds/patterns/pt13.jpg" data-nr="12" width="20" height="20"></li>
    <li class="nomargin"><img alt="" src="style-switcher/backgrounds/patterns/pt14.jpg" data-nr="13" width="20" height="20"></li>
    <li class="nomargin"><img alt="" src="style-switcher/backgrounds/patterns/pt15.jpg" data-nr="14" width="20" height="20"></li>
  </ul>
  <small>*only for boxed layout</small>
  <h4>Background Image</h4>
  <ul class="background-selector1">
    <li><img alt="" src="style-switcher/backgrounds/images/img1-thumb.jpg" data-nr="0" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/images/img2-thumb.jpg" data-nr="1" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/images/img3-thumb.jpg" data-nr="2" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/images/img4-thumb.jpg" data-nr="3" width="20" height="20"></li>
    <li><img alt="" src="style-switcher/backgrounds/images/img5-thumb.jpg" data-nr="4" width="20" height="20"></li>
  </ul>
  <small>*only for boxed layout</small> </div>
</body>
</html>