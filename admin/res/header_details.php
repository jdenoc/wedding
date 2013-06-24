<title>ADMIN | Denis & Britain's Wedding Reception</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Merienda+One'  type='text/css'/>
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Handlee' type='text/css'>
<link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>

<!-- FANCY BOX Setup -->
<script>
	!window.jQuery && document.write('<script src="../js/jquery-1.4.3.min.js"><\/script>');
</script>
<script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
//	inline pop-up for links in "foot" div
		$(".inline").fancybox();	//	#inline is the class of the link to pop-up
	});
</script>
<!-- END FANCY BOX Set-up -->


<?php
include_once('../res/Mobile_Detect.php');
$detect = new Mobile_Detect();
if($detect->isMobile()){ ?>

    <link rel="stylesheet" href="../css/mobile.css" type="text/css"/>
    <script type="text/javascript" src="../js/mobile_adjustments.js"></script>

<?php }else{ ?>

    <link rel="stylesheet" href="../css/wedding-css.css" type="text/css"/>
    <script type="text/javascript" src="../js/placeholder.js"></script>

    <!-- Compatibility for IE 7, 8, 9 -->
    <!--[if IE]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<?php } ?>