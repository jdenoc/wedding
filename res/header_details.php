<title>Denis & Britain's Wedding Reception</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="imgs/favicon.ico" type="image/x-icon"/>
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Merienda+One'  type='text/css'/>
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Handlee' type='text/css'>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<?php
include_once('res/Mobile_Detect.php');
$detect = new Mobile_Detect();
if($detect->isMobile()){ ?>

<link rel="stylesheet" href="css/mobile.css" type="text/css"/>
<script type="text/javascript" src="js/mobile_adjustments.js"></script>

<?php }else{ ?>

<link rel="stylesheet" href="css/wedding-css.css" type="text/css"/>
<script type="text/javascript" src="js/placeholder.js"></script>

<!-- Compatibility for IE 7, 8, 9 -->
<!--[if IE]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php } ?>