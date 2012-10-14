<?php
session_start();
if(!isset($_SESSION['invite_ID'])){
	header('location:../index.php');
	exit;
}

function safty_check($posted){
	$posted = trim($posted);
	$posted = stripslashes($posted);
	$posted = mysql_real_escape_string($posted);
	return $posted;
}

// SONG 1
$s1 = safty_check($_POST['song_1']);
$a1 = safty_check($_POST['artist_1']);
$al1 = safty_check($_POST['album_1']);
$add_song1 = false;

// SONG 2
$s2 = safty_check($_POST['song_2']);
$a2 = safty_check($_POST['artist_2']);
$al2 = safty_check($_POST['album_2']);
$add_song2 = false;

// SONG 3
$s3 = safty_check($_POST['song_3']);
$a3 = safty_check($_POST['artist_3']);
$al3 = safty_check($_POST['album_3']);
$add_song3 = false;

if (empty($s1)){
	unset($s1, $a1, $al1);
	unset($_POST['song_1'], $_POST['artist_1'], $_POST['album_1']);
}else{
	$add_song1 = true;
}

if (empty($s2)){
	unset($s2, $a2, $al2);
	unset($_POST['song_2'], $_POST['artist_2'], $_POST['album_2']);
}else{
	$add_song2 = true;
}

if (empty($s3)){
	unset($s3, $a3, $al3);
	unset($_POST['song_3'], $_POST['artist_3'], $_POST['album_3']);
}else{
	$add_song3 = true;
}

if($add_song1 || $add_song2 || $add_song3){
	include_once('../../res/connection.php');
	$tbl_name="music";
	$sql="INSERT INTO $tbl_name (song_title, song_artist, song_album) VALUES";
	if($add_song1){
		$sql .= "('$s1', '$a1', '$al1')";
	}
	if($add_song2){
		if($add_song1){ $sql .= ", "; }
		$sql .= "('$s2', '$a2', '$al2')";
	}
	if($add_song3){
		if($add_song1 || $add_song2){ $sql .= ", "; }
		$sql .= "('$s3', '$a3', '$al3')";
	}
	//	echo $sql;		// TESTING
	mysql_query($sql);
	
	$tbl_name="details";
	$invite_ID = $_SESSION['invite_ID'];
	$sql="UPDATE $tbl_name SET musicSet = '1' WHERE id = $invite_ID";
	mysql_query($sql);
}

header("Location:../rsvp.php");
exit;
?>