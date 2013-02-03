<?php // complete.php (rsvp)
session_name('rsvp');
session_start();
if(!isset($_SESSION['invite_ID'])){
	header('location:index.php');
    exit;
}

if(isset($_GET['x'])){
	$responce = "You've already RSVP'd. If you believe this is a mistake, then please send an email to this address:<br/>";
	$responce .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:wedding@jdenoc.com">wedding@jdenoc.com</a>';
}else{
	$responce = "Thanks for RSVP-ing";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once('res/header_details.php'); ?>
    <meta http-equiv="Refresh" content="20; URL=index.php">
</head>
<body>
<div id="container">
	<header><?php include_once('res/page_header.php'); ?></header>
	<div id="main" class="text"><?php
			session_destroy();
			echo $responce;
	?></div>
</div>
</body>
</html>