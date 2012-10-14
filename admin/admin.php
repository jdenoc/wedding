<?php
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
	header("location:index.php");
    exit;
}
include_once '../res/connection.php';
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
		<span style="float:right;padding-right: 30px;">
			<span class="button" style="display:block;">
                <a href="res/upload.php" title="Upload Image" class="inline">Upload Image</a>
            </span><br/>
            <span class="button" id="music_button" style="display:block">
				<a href="#" title="Change Display" onclick="showStuff('invite_button');showStuff('music_list');hideStuff('music_button');hideStuff('invite_list')">
				Display Music</a>
			</span>
			<span class="button" id="invite_button" style="display:none">
				<a href="#" title="Change Display" onclick="hideStuff('invite_button');hideStuff('music_list');showStuff('music_button');showStuff('invite_list')">
				Display Invites</a>
			</span><br/>
			<span class="button">
				<a href="#stats" title="Statistics" class="inline">Stats</a>
			</span>
		</span>
		<h1>WELCOME <?php echo strtoupper($_SESSION['user']); ?> !!!</h1>
		<?php 
		 echo '<div id="invite_list" style="display:block">';
		 include_once 'res/guests.php'; 
		 echo '</div><div id="music_list" style="display:none">';
		 include_once 'res/music.php';
		 echo '</div>';
		 ?>
	</div>
	<div id="foot"><?php 
		include_once 'res/page_footer.php'; 
		echo '<div style="display:none;">';
			include_once 'res/stats.php';
		echo '</div>';
	?></div>
</body>
</html>