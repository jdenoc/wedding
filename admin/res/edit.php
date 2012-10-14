<?php // edit.php
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user'])){
	header('location:../index.php');
}
include_once '../../res/connection.php';
$ID = $_GET['id'];
$tbl_name = 'details';
$query = mysql_query("SELECT * FROM $tbl_name WHERE id='$ID'") or die("Entry not found!");
$details = mysql_fetch_assoc($query);

$tbl_name = 'invites';
$query = mysql_query("SELECT * FROM $tbl_name WHERE invitee_id='$ID'") or die("Invitee Entry not found!");
$invites = mysql_fetch_assoc($query);

if(!isset($_GET['music'])){
?>

<html xmlns="http://www.w3.org/1999/html">
<head><script type="text/javascript">
function random_code(){
	var chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
	var str = '';
	for (var i=0; i<5; i++) {
		str += chars[Math.floor(Math.random() * chars.length)];
	}
	document.getElementById("code").innerText = str;
	document.getElementById("hidden-code").value = str;
}
</script></head>
<body>
    <form action="res/update.php?o=fbahjkvgbkasdvbskdv" method="post">
	<table border="0" style="color:#111">
	<tr>
		<th colspan="4" align="center" style="font-size: 32px;">Edit Invite <?php echo $ID; ?></th>
	</tr><tr>
		<td colspan="4"><div class="sexy_line"></div></td>
	</tr><tr>
		<td>Invitees:</td>
		<td colspan="3">
			<input type="text" name="name" value="<?php echo $details['invite_name']; ?>" maxlength="100" size="25" />
		</td>
	</tr><tr>
		<td>Coming:&nbsp;&nbsp;</td>
		<td>N/A<input type="radio" name="coming" <?php if($details['coming']===null){ echo 'checked'; } ?> value="" onclick="hideStuff('location')"/></td>
		<td align="center">Yes<input type="radio" name="coming" <?php if($details['coming']==='1'){ echo 'checked'; } ?> value="1" onclick="showRow('location')"/></td>
		<td align="left">No<input type="radio" name="coming" <?php if($details['coming']==='0'){ echo 'checked'; } ?> value="0" onclick="hideStuff('location')"/></td>
	</tr><tr id="location" style="display: <?php echo ($details['coming']!='1') ? 'none' : 'table-row';?>;">
        <td>Location:</td>
        <td colspan="2"><select name="location"><?php
            $location_query = mysql_query("SELECT * FROM location");
            while($location = mysql_fetch_assoc($location_query)){
                $select = ($details['location_ID'] == $location['id']) ? 'selected' : '';
                echo '<option value="'.$location['id'].'" '.$select.'>'.$location['location'].'</option>';
            }
        ?></select></td>
    </tr><tr>
		<td colspan="2" align="right">No. of Guests:</td>
		<td>
			<input type="text" name="guests" value="<?php echo $details['guest_number']; ?>" maxlength="1" size="1" />
		</td>
	</tr><tr>
		<td colspan="2">Contact Number:</td>
		<td colspan="2">
			<input type="text" name="number" value="<?php echo $details['number']; ?>" maxlength="20" size="15" />
		</td>
	</tr><tr>
		<td valign="top">Address:</td>
		<td colspan="3" align="center">
			<textarea name="address"><?php echo $details['address']; ?></textarea>
		</td>
	</tr><tr>
		<td colspan="4"><div class="sexy_line"></div></td>
	</tr><tr>
		<td colspan="4" align="center">
			<span id="code" style="font-family:'Comic Sans MS', cursive;font-weight:bold;color:red;">
			<?php echo $invites['code']; ?>
			</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" value="Refresh Code" class="button" onclick="random_code()" />
		</td>
	</tr><tr>
		<td>&nbsp;</td>
	</tr><tr>
		<td colspan="4" align="center">
			<input type="hidden" value="<?php echo $invites['code']; ?>" name="invite_code" id="hidden-code" />
			<input type="hidden" value="<?php echo $ID; ?>" name="id" />
			<input type="submit" class="button" />
		</td>
	</tr>
    </table>
    </form>
	<br>
</body>
</html>

<?php }else{
$tbl_name = 'music';
$query = mysql_query("SELECT * FROM $tbl_name WHERE id='$ID'") or die("Entry not found!");
$music = mysql_fetch_assoc($query);
?>
<html>
<body>
	<table border="0"><form action="res/update.php?music=bnjksbesk&o=fbahjkvgbkasdvbskdv" method="post">
	<tr>
		<td colspan="2" align="center"><h1>Edit Song <?php echo $ID; ?></h1></td>
	</tr><tr>
		<td colspan="2"><div class="sexy_line"></div></td>
	</tr><tr>
		<td>Song:</td>
		<td>
			<input type="text" name="title" value="<?php echo $music['song_title']; ?>" maxlength="100" size="30" />
		</td>
	</tr><tr>
		<td>Artist:</td>
		<td>
			<input type="text" name="artist" value="<?php echo $music['song_artist']; ?>" maxlength="100" size="30" />
		</td>
	</tr><tr>
		<td>Album:</td>
		<td>
			<input type="text" name="album" value="<?php echo $music['song_album']; ?>" maxlength="100" size="30" />
		</td>
	</tr><tr>
		<td>&nbsp;</td>
	</tr><tr>
		<td colspan="4" align="center">
			<input type="hidden" value="<?php echo $ID; ?>" name="id" />
			<input type="submit" class="button" />
		</td>
	</tr>
	</form></table>
	<br>
</body>
</html>
<?php } 
mysql_free_result($query);?>