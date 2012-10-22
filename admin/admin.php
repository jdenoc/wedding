<?php
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
	header("location:index.php");
    exit;
}
include_once '../res/connection.php';
$db = new pdo_connection("jdenocco_wedding");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once 'res/header_details.php'; ?>
</head>
<body id="admin">
<div id="container">
	<div id="head"><?php include_once 'res/page_header.php'; ?></div>
	<div id="main">
        <?php include_once('res/button_table.php') ?>
		<h1>WELCOME <?php echo strtoupper($_SESSION['user']); ?> !!!</h1>
		<?php 
        if(!isset($_GET['display']) || $_GET['display']=='invites'){
            include_once 'res/guests.php';
        }else{
		    include_once 'res/music.php';
        }
		 ?>
        <br/><br/>
	</div>
</body>
</html>