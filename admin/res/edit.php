<?php // edit.php
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user'])){
	header('location:../index.php');
}
include_once '../../res/connection.php';
$db = new pdo_connection("jdenocco_wedding");
$ID = $_GET['id'];
$spotify_link = 'http://ws.spotify.com/search/1/track.json?q=';

$details = $db->getRow("SELECT * FROM details WHERE id=:id", array('id'=>$ID));
$invites = $db->getRow("SELECT * FROM invites WHERE invitee_id=:id", array('id'=>$ID));

?>
<html xmlns="http://www.w3.org/1999/html">
<head>
<script type="text/javascript">
function random_code(){
	var chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
	var str = '';
	for (var i=0; i<5; i++) {
		str += chars[Math.floor(Math.random() * chars.length)];
	}
	document.getElementById("code").innerText = str;
	document.getElementById("hidden-code").value = str;
}

function change_song(){
    var songs = document.getElementById("song_choice");
    var href = songs.options[songs.selectedIndex].value;
    document.getElementById("listen").setAttribute('href', href);
}
</script>
<style>
    .td_center{
        text-align: center;
    }
    .td_top{
        vertical-align: text-top;
    }
    th{
        font-size: 32px;
    }
    table{
        color: #111;
    }
    #edit_song input[type="text"],
    #edit_song select{
        width: 150px;
    }
    #edit_guest input[type="text"],
    #edit_guest input[type="tel"],
    #edit_guest select,
    #edit_guest textarea{
        width: 150px;
    }
    #edit_guest input[type="number"]{
        width: 35px
    }
</style>
</head>
<body>
<?php if(!isset($_GET['music'])){ // ********** Guest UPDATE********** ?>
    <form action="res/update.php?o=fbahjkvgbkasdvbskdv" method="post" name="edit_guest">
	<table border="0" id="edit_guest">
	<tr>
		<th colspan="4">Edit Invite <?php echo $ID; ?></th>
	</tr><tr>
		<td colspan="4"><div class="sexy_line"></div></td>
	</tr><tr>
		<td colspan="2"><label for="name">Invitees:</label></td>
		<td colspan="2">
			<input type="text" name="name" id="name" value="<?php echo $details['invite_name']; ?>" maxlength="100" />
		</td>
	</tr><tr>
		<td colspan="2">Coming:&nbsp;&nbsp;</td>
		<td colspan="2">
            <label>N/A<input type="radio" name="coming" <?php if($details['coming']==-1) echo 'checked'; ?> value="-1" "/></label><!--/td-->
		    <label>Yes<input type="radio" name="coming" <?php if($details['coming']==1) echo 'checked'; ?> value="1" onclick="showRow('location');showRow('guests_num')"/></label>
		    <label>No<input type="radio" name="coming" <?php if($details['coming']==0) echo 'checked'; ?> value="0" /></label>
        </td>
	</tr><tr id="location">
        <td colspan="2"><label for="location_select">Location:</label></td>
        <td colspan="2"><select name="location" id="location_select">
            <option value="-1"></option>
            <?php
            foreach($db->getAllRows("SELECT * FROM location") as $location){
                $select = ($details['location_ID'] == $location['id']) ? 'selected' : '';
                echo '<option value="'.$location['id'].'" '.$select.'>'.$location['location'].'</option>';
            }
        ?></select></td>
    </tr><tr id="guests_num">
		<td colspan="2"><label for="guests">No. of Guests:</label></td>
		<td colspan="2">
			<input type="number" name="guests" id="guests" value="<?php echo $details['guest_number']; ?>" maxlength="1" min="0" max="9" />
            <span style="font-size: 21px; font-weight: bold"> / </span>
            <input type="number" name="invite_num" value="<?php echo $details['invite_number']; ?>" maxlength="1" min="0" max="9" />
        </td>
	</tr><tr>
		<td colspan="2"><label for="number">Contact Number:</label></td>
		<td colspan="2">
			<input type="tel" name="number" id="number" value="<?php echo $details['number']; ?>" maxlength="20" placeholder="+1 (555) 555-5555" />
		</td>
	</tr><tr>
		<td class="td_top" colspan="2"><label for="address">Address:</label></td>
		<td colspan="2">
			<textarea name="address" id="address"><?php echo $details['address']; ?></textarea>
		</td>
	</tr><tr>
		<td colspan="4"><div class="sexy_line"></div></td>
	</tr><tr>
		<td colspan="4" class="td_center">
			<span id="code" style="font-family:'Comic Sans MS', cursive;font-weight:bold;color:red;">
			<?php echo $invites['code']; ?>
			</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" value="Refresh Code" class="alt_button" onclick="random_code()" />
		</td>
	</tr><tr>
		<td>&nbsp;</td>
	</tr><tr>
		<td colspan="4" class="td_center">
			<input type="hidden" value="<?php echo $invites['code']; ?>" name="invite_code" id="hidden-code" />
			<input type="hidden" value="<?php echo $ID; ?>" name="id" />
			<input type="submit" class="alt_button" />
		</td>
	</tr>
    </table>
    </form>
	<br>

<?php }else{
// **************** Music Update ****************
$music = $db->getRow("SELECT * FROM music WHERE id=:id", array('id'=>$ID));
$music_choices = array();
$json_array = json_decode(file_get_contents($spotify_link.str_replace(' ', '+', $music['song_title'])));
$track_count = count($json_array->tracks);
if($track_count > 0){
//    $track_count = ($track_count > 10)? 10 : $track_count;
    for($i=0; $i<$track_count; $i++){
        $value = $json_array->tracks[$i]->href;
        $display = $json_array->tracks[$i]->name;
        $display .= ' - '.$json_array->tracks[$i]->artists[0]->name;
        $display .= ' ['.$json_array->tracks[$i]->album->name.']';
        $music_choices[$value] = $display;
    }
}else{
    $music_choices[''] = 'Song not found';
}

?>
<form action="res/update.php?music=bnjksbesk&o=fbahjkvgbkasdvbskdv" method="post" name="edit_song">
<table border="0" id="edit_song">
	<tr>
		<th colspan="2">Edit Song <?php echo $ID; ?></th>
	</tr><tr>
		<td colspan="2"><div class="sexy_line"></div></td>
	</tr><tr>
		<td><label for="title">Song:</label></td>
		<td>
			<input type="text" name="title" id="title" value="<?php echo $music['song_title']; ?>" maxlength="100" />
		</td>
	</tr><tr>
		<td><label for="artist">Artist:</label></td>
		<td>
			<input type="text" name="artist" id="artist" value="<?php echo $music['song_artist']; ?>" maxlength="100" />
		</td>
	</tr><tr>
		<td><label for="album">Album:</label></td>
		<td>
			<input type="text" name="album" id="album" value="<?php echo $music['song_album']; ?>" maxlength="100" />
		</td>
	</tr><tr>
    <td><label for="song_choice">Song Choice:</label></td>
    <td>
        <select id="song_choice" name="song_choice" onchange="change_song()">
            <option selected disabled></option>
            <?php foreach($music_choices as $key=>$value){
                $selected = ($key == $music['spotify'])? 'selected' : '';
                echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
            } ?>
        </select>
        <span class="alt_button"><a href="<?php echo $music['spotify'] ?>" id="listen">Listen</a></span>
    </td>
</tr><tr>
		<td>&nbsp;</td>
	</tr><tr>
		<td colspan="4" class="td_center">
			<input type="hidden" value="<?php echo $ID; ?>" name="id" />
			<input type="submit" class="alt_button" />
		</td>
	</tr>
</table>
</form>
<br>
<?php } $db->closeConnection(); ?>
</body></html>
