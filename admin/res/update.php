<?php // update.php
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user'])){
	header('location:../index.php');
    exit;
}
include_once '../../res/connection.php';
$tbl_name = (isset($_GET['music']))? "music" : "details";
$ID = (isset($_POST['id']))? safety_check($_POST['id']) : '';

function safety_check($posted){
	$posted = trim($posted);
	$posted = stripslashes($posted);
	$posted = mysql_real_escape_string($posted);
	return $posted;
}

if(isset($_GET['o'])){
	if(isset($_GET['music'])){
// *******************************music update*******************************
		$title = safety_check($_POST['title']);
		$artist = safety_check($_POST['artist']);
		$album = safety_check($_POST['album']);
		$sql = "UPDATE $tbl_name SET song_title='$title', ";
        $sql .= ($artist == '')? "song_artist=NULL, " : "song_artist='$artist', ";
        $sql .= ($album == '')? "song_album=NULL " : "song_album='$album' ";
		$sql .= "WHERE id=$ID";
		
	}else{
// *******************************invite update*******************************
		$invite = safety_check($_POST['name']);
		$coming = safety_check($_POST['coming']);
        $location = safety_check($_POST['location']);
		$guests = safety_check($_POST['guests']);
		$number = safety_check($_POST['number']);
		$address = safety_check($_POST['address']);

		$sql = "UPDATE $tbl_name SET invite_name='$invite', guest_number=$guests, ";
        $sql .= ($number == '')? "number=NULL, " : "number='$number', ";
		$sql .= ($address == '')? "address=NULL, " : "address='$address', ";
		$sql .= ($coming == '')? "coming=NULL" : "coming=$coming";
        $sql .= ($coming == 1)? ", location_ID=$location" : ", location_ID=-1";
		$sql .= " WHERE id=$ID";
	}
	$die = 'Update failed';

}else if(isset($_GET['x'])){
// *******************************invite & music removal*******************************
	$sql = "DELETE FROM $tbl_name WHERE id=$ID";
	$die = 'Delete failed';
	
}else if(isset($_GET['add'])){
	if(isset($_GET['music'])){
// *******************************music addition*******************************
		$title = safety_check($_POST['title']);
		$artist = safety_check($_POST['artist']);
		$album = safety_check($_POST['album']);
		
		$sql = "INSERT INTO $tbl_name (song_title, song_artist, song_album) VALUES ('$title', ";
        $sql .= ($artist == '')? "NULL, " : "'$artist', '";
		$sql .= ($album == '')? "NULL)" : "'$album')'";

	}else{
// *******************************invite addition*******************************
		$name = safety_check($_POST['name']);
		$location = safety_check($_POST['location']);
		$guests = safety_check($_POST['guests']);
		$address = safety_check($_POST['address']);
		$number = safety_check($_POST['number']);
		
		$sql = "INSERT INTO $tbl_name (invite_name, location_ID, guest_number, number, address) VALUES ('$name', '$location', '$guests', ";
		$sql .= ($number == '')? "NULL, " : "'$number', ";
		$sql .= ($address == '')? "NULL)" : "'$address')";
	}
	$die = 'Addition Failed';
	
}else if(isset($_GET['reset'])){
// *******************************reset music submission for invitee*******************************
    if($ID == ''){
        header('location:../admin.php');
        exit;
    }

	$sql = "UPDATE $tbl_name SET musicSet=0 WHERE id='$ID'";
	$die = 'Music reset failed';
	
}else{
	header('locatation:../admin.php');
}
//echo $sql;			// TESTING ONLY
mysql_query($sql) or die($die);
if(isset($_GET['music'])){
    mail("info@jdenoc.com", "Music Playlist Update", substr($die, -7));
}

// ******************************INVITE CODE******************************
if(!isset($_GET['music'])){
	$alt_tbl_name = 'invites';
	if(isset($_GET['add'])){
// *******************************invite code addition*******************************
		$sql = "SELECT * FROM $tbl_name ORDER BY id DESC"; // should produce the last entry in the table
		$details = mysql_fetch_assoc(mysql_query($sql));
		
		$new_id = $details['id'];
		$code = $_POST['invite_code'];
		$sql = "INSERT INTO $alt_tbl_name (code, invitee_id) VALUES ('$code', $new_id)";
	}else if(isset($_GET['o'])){
// *******************************invite code update*******************************

		$sql = "SELECT * FROM $alt_tbl_name WHERE invitee_id=$ID"; 
		$query = mysql_query($sql) or die('code retrieval failure');
		$result = mysql_fetch_assoc($query);

		$code = $_POST['invite_code'];
		if($result['id'] != null){
			$sql = "UPDATE $alt_tbl_name SET code='$code' WHERE invitee_id=$ID";
		}else{
			$sql = "INSERT INTO $alt_tbl_name (code, invitee_id) VALUES ('$code', $ID)";
		}
	}else if(isset($_GET['x'])){
// *******************************invite code delete*******************************
		$sql = "DELETE FROM $alt_tbl_name WHERE invitee_id=$ID";
	}
	//echo $sql;		// TESTING ONLY
	mysql_query($sql) or die('code input failure');
}
header('location:../admin.php');
?>