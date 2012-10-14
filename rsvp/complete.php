<?php // complete.php
session_name('rsvp');
session_start();
if(!isset($_SESSION['invite_ID'])){
	header('location:index.php');
    exit;
}

if(isset($_GET['x'])){
	$responce = "You've already RSVP'd. If you believe this is a mistake, then please send an email to this address:<br/>";
	$responce .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:info@jdenoc.com">info@jdenoc.com</a>';
}else{
	$responce = "Thanks for RSVP-ing";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<header>
	<?php include_once('res/header_details.php'); ?>
</header>
<body>
<div id="container">
	<div id="head">
		<?php include_once('res/page_header.php'); ?>
	</div>
	<div id="main" class="text"><?php
			session_destroy();
			echo $responce;
	?></div>
	<div id="foot">
		<?php include_once('res/page_footer.php'); ?>
	</div>
</div>
</body>
</html>