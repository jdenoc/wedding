<?php // edit.php
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user'])){
	header('location:../index.php');
}
include_once '../../res/connection.php';
$ID = $_GET['id'];

if(isset($_GET['music'])){
	$tbl_name = 'music';
	$url_ext = 'music=ngaskgb&';
	$type = 'Song';
}else{
	$tbl_name = 'details';
	$url_ext = '';
	$type = 'Invite';
}
$query = mysql_query("SELECT * FROM $tbl_name WHERE id='$ID'") or die("Entry not found!");
$result = mysql_fetch_assoc($query);

if(!isset($_GET['music'])){
	$display = $result['invite_name'];
}else{
	$display = '<strong><em>'.$result['song_title'].'</em></strong><br/>';
	if($result['song_artist'] != null){
		$display .= 'by <em>'.$result['song_artist'].'</em>';
	}
}
?>
<html><body>
<table border="0" style="color:#111"><form action="res/update.php?<?php echo $url_ext; ?>x=njskbdjbsdjbsjk" method="post">
	<tr><td colspan="3" align="center"><h1><?php echo 'Delete '.$type.' '.$ID; ?></h1></td></tr>
	<tr>
		<th colspan="3">Are you sure you want to delete this <?php echo $type; ?>?</th>
	</tr><tr>
		<td colspan="3"><div class="sexy_line"></div></td>
	</tr><tr>
        <td align="center"><?php echo $display ?></td>
		<td align="right">
			<input type="hidden" value="<?php echo $ID; ?>" name="id" />
			<input type="submit" value="Yes" class="button" /> 
		</td>
		<td>&nbsp;</td>
	</tr>
	</form></table>
	<br/>
</body></html>
<?php mysql_free_result($query); ?>