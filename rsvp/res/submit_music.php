<?php
session_name('rsvp');
session_start();
if(!isset($_SESSION['invite_ID'])){
	header('location:../index.php');
	exit;
}

// SONG 1
$s1 = (isset($_POST['song_1']) && $_POST['song_1']!='')? trim($_POST['song_1']) : '';
$a1 = (isset($_POST['artist_1']) && $_POST['artist_1']!='')? trim($_POST['artist_1']) : '';
$al1 = (isset($_POST['album_1']) && $_POST['album_1']!='')? trim($_POST['album_1']) : '';
$add_song1 = false;

// SONG 2
$s2 = (isset($_POST['song_2']) && $_POST['song_2']!='')? trim($_POST['song_2']) : '';
$a2 = (isset($_POST['artist_2']) && $_POST['artist_2']!='')? trim($_POST['artist_2']) : '';
$al2 = (isset($_POST['album_2']) && $_POST['album_2']!='')? trim($_POST['album_2']) : '';
$add_song2 = false;

// SONG 3
$s3 = (isset($_POST['song_3']) && $_POST['song_3']!='')? trim($_POST['song_3']) : '';
$a3 = (isset($_POST['artist_3']) && $_POST['artist_3']!='')? trim($_POST['artist_3']) : '';
$al3 = (isset($_POST['album_3']) && $_POST['album_3']!='')? trim($_POST['album_3']) : '';
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
    $db = new pdo_connection('jdenocco_wedding');

    $msg = '';
	if($add_song1){
        $db->insert('music', array(
            'song_title'=>$s1,
            'song_artist'=>$a1,
            'song_album'=>$al1)
        );
        $msg .= 'Song: '.$s1.'\nArtist: '.$a1.'\nAlbum: '.$al1.'\n';
	}
	if($add_song2){
        $db->insert('music', array(
                'song_title'=>$s2,
                'song_artist'=>$a2,
                'song_album'=>$al2)
        );
        $msg .= 'Song: '.$s2.'\nArtist: '.$a2.'\nAlbum: '.$al2.'\n';
	}
	if($add_song3){
        $db->insert('music', array(
                'song_title'=>$s3,
                'song_artist'=>$a3,
                'song_album'=>$al3)
        );
        $msg .= 'Song: '.$s3.'\nArtist: '.$a3.'\nAlbum: '.$al3.'\n';
	}

	$invite_ID = $_SESSION['invite_ID'];
    $db->update('details', array('musicSet'=>1), array('id'=>$invite_ID));

    mail('info@jdenoc.com', 'Music submission', $msg);
}
header("Location:../rsvp.php");
exit;
?>