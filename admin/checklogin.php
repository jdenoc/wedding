<?php
include_once '../res/connection.php';
session_name('wedding_admin');
session_start();
$tbl_name="admin";

// username and password sent from form 
$user=$_POST['myusername']; 
$pass=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$user = stripslashes($user);
$pass = stripslashes($pass);
$user = mysql_real_escape_string($user);
$pass = mysql_real_escape_string($pass);

$sql="SELECT * FROM $tbl_name WHERE user='$user' and pass='$pass'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $user and $pass, table row must be 1 row

if($count==1){
// Register $user, $pass and redirect to file "board.php"
	session_start();
	$_SESSION['user'] = $user;
	$_SESSION['pass'] = $pass;
	
	unset($_POST['myusername'], $_POST['mypassword'], $sql, $count);
	header("location:admin.php");
		
} else {
	echo $user.'and'.$pass.'<br/>';
	echo "<strong>Wrong Username or Password<br/> Note that both usernames and passwords are case sensitive</strong>";
	echo '<meta http-equiv="Refresh" content="3; URL=index.php">';
}

mysql_free_result($result);
?>