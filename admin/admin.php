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
<!DOCTYPE html>
<html>
<head>
	<?php include_once 'res/header_details.php'; ?>
</head>
<body id="admin">
<div id="container">
	<header><?php include_once 'res/page_header.php'; ?></header>
	<div id="main">
        <?php include_once('res/button_table.php') ?><br/>
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