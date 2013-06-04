<?php
require_once '../res/connection.php';
session_name('wedding_admin');
session_start();

// username and password sent from form 
$user = (isset($_POST['myusername']))? $_POST['myusername'] : '';
$pass = (isset($_POST['mypassword']))? $_POST['mypassword'] : '';

$db = new pdo_connection('jdenocco_wedding');
$userInfo = $db->getAllRows("SELECT * FROM `admin` WHERE `user`=:user AND `pass`=:pass",
    array('user'=>$user, 'pass'=>$pass));

if(count($userInfo)==1){
// Register $user, $pass and redirect to file "admin.php"
	$_SESSION['user'] = $user;
	$_SESSION['pass'] = $pass;
	
	unset($_POST['myusername'], $_POST['mypassword'], $user, $pass);
	header("location:admin.php");
    exit;
		
} else {
	echo "<strong>Wrong Username or Password<br/> Note that both username and password are case sensitive</strong>";
	echo '<meta http-equiv="Refresh" content="3; URL=index.php">';
    session_destroy();
}
$db->closeConnection();
?>