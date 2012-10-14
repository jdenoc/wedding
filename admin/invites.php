<?php
// Check if session is not registered , redirect back to main page. 
// Put this code in first line of web page. 
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
    header("location:index.php");
}

include_once '../res/connection.php';
$tbl_name = 'details';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once 'res/header_details.php'; ?>
</head>
<body>
<div id="container">
	<div id="head">
		<?php include_once 'res/page_header.php'; ?>
	</div>
	<div id="main">
		<h1>WELCOME <?php echo $_SESSION['user']; ?> !!!</h1>
		<p></p>
		<table border="1">
			<tr>
				<td></td>
			</tr>
		</table>
	</div>
	<div id="foot">
		<?php include_once 'res/page_footer.php'; ?>
	</div>
</body>
</html>