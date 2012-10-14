<?php // update.php (ADMIN)
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user'])){
	header('location:../index.php');
    exit;
}
include_once '../../res/connection.php';
$db = new pdo_connection("jdenocco_wedding");
$tbl_name = (isset($_GET['music']))? "music" : "details";
$alt_tbl_name = 'invites';
$ID = (isset($_POST['id']))? addslashes($_POST['id']) : '';
$emails = 'jdenoc@gmail.com, brit.waid@yahoo.com';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Wedding Site <wedding@jdenoc.com>' . "\r\n";

if(isset($_GET['o'])){
	if(isset($_GET['music'])){
// *******************************music update*******************************
		$title = addslashes($_POST['title']);
		$artist = addslashes($_POST['artist']);
		$album = addslashes($_POST['album']);

        $values = array(
            'song_title'=>$title,
            'song_artist'=> (($artist == '')? NULL : $artist),
            'song_album'=> (($album == '')? NULL : $album)
        );
        $where = array('id'=>$ID);

        $subject = 'Music Update';
        $msg = 'A Song has been updated.<br/>Login to <a href="http://wedding.jdenoc.com/admin"/> and  click on the <strong>Display Music</strong> Button to view the change.';
		
	}else{
// *******************************invite update*******************************
		$invite = addslashes($_POST['name']);
		$coming = addslashes($_POST['coming']);
        $location = addslashes($_POST['location']);
		$guests = addslashes($_POST['guests']);
		$number = addslashes($_POST['number']);
		$address = addslashes($_POST['address']);

        $values = array(
            'invite_name'=>$invite,
            'guest_number'=>$guests,
            'number'=> (($number == '')? NULL : $number),
            'address'=> (($address == '')? NULL : $address),
            'coming'=> (($coming == '')? NULL : $coming),
            'location_ID'=> (($coming == 1)? $location : -1)
        );
        $where = array('id'=>$ID);
        print_r($values);

        $subject = 'Invite Update';
        $msg = 'An invite has been updated.<br/>Login to <a href="http://wedding.jdenoc.com/admin"/> to view the change.';
// *******************************invite code update*******************************
        $code = $_POST['invite_code'];
        $result = $db->getRow("SELECT * FROM $alt_tbl_name WHERE invitee_id=:id", array('id'=>$ID));
        if(!empty($result['id'])){
            $db->update($alt_tbl_name, array('code'=>$code), array('invitee_id'=>$ID));
        }else{
            $db->insert($alt_tbl_name, array('code'=>$code, 'invitee_id'=>$ID));
        }
	}
    $db->update($tbl_name, $values, $where);

}else if(isset($_GET['x'])){
// *******************************invite & music removal*******************************
    if(isset($_GET['info']) && isset($_GET['id'])){
        $tbl_name = 'info';
        $ID = $_GET['id'];
    }
    $db->delete($tbl_name, array('id'=>$ID));
    if(!isset($_GET['music']) && !isset($_GET['info'])){
// *******************************invite code delete*******************************
        $db->delete($alt_tbl_name, array('invitee_id'=>$ID));
    }
    $subject = (($tbl_name=='music')? 'Music' : 'Invite').' Delete';
    $msg = 'A'.(($tbl_name=='music')? ' Song' : 'n Invite').' has been deleted by '.$_SESSION['user'];



}else if(isset($_GET['add'])){
	if(isset($_GET['music'])){
// *******************************music addition*******************************
		$title = addslashes($_POST['title']);
		$artist = addslashes($_POST['artist']);
		$album = addslashes($_POST['album']);
		
        $values = array(
            'song_title'=> (($title == '')? NULL : $title),
            'song_artist'=> (($artist == '')? NULL : $artist),
            'song_album'=> (($album == '')? NULL : $album)
        );

        $subject = 'Music Addition';
        $msg = 'A Song has been added to the music playlist.<br/>Login to <a href="http://wedding.jdenoc.com/admin"/> and  click on the <strong>Display Music</strong> Button to view the new song.';

	}else{
// *******************************invite addition*******************************
		$name = addslashes($_POST['name']);
		$guests = addslashes($_POST['guests']);
		$address = addslashes($_POST['address']);
		$number = addslashes($_POST['number']);
		
        $values = array(
            'invite_name'=>$name,
            'location_ID'=>-1,
            'coming'=>-1,
            'guest_number'=>$guests,
            'number'=>(($number == '')? NULL : $number),
            'address'=>(($address == '')? NULL : $address)
        );

        $subject = 'Invite Addition';
        $msg = 'A new invite has been created.<br/>Login to <a href="http://wedding.jdenoc.com/admin"/> to view the new invitee.';
    }
    $db->insert($tbl_name, $values);
// *******************************invite code addition*******************************
    if(!isset($_GET['music'])){
        $new_id = $db->getValue("SELECT MAX(id) FROM details");
        echo $new_id;
        $code = ($_POST['invite_code'] != '')? addslashes($_POST['invite_code']) : '';
        $db->insert($alt_tbl_name, array('code'=>$code, 'invitee_id'=>$new_id));
    }

}else if(isset($_GET['reset'])){
// *******************************reset music submission for invitee*******************************
    if(!isset($_GET['id']) || $_GET['id'] == ''){
        header('location:../admin.php');
        exit;
    }

    $db->update($tbl_name, array('musicSet'=>0), array('id'=>$_GET['id']));
	$subject = 'Music reset';
    $msg = 'Invite ID:'.$_GET['id'].' was given the ability to add more songs to the wedding music playlist.';
	
}else{
	header('locatation:../admin.php');
}

$db->closeConnection();
mail($emails, $subject, $msg, $headers);
header('location:../admin.php'.((isset($_GET['music']))? '?display=music' : ''));
exit;
?>