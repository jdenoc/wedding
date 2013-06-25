<?php // remove.php (ADMIN)
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user'])){
	header('location:../index.php');
}
include_once '../../res/connection.php';
$db = new pdo_connection("jdenocco_wedding");
$ID = $_GET['id'];

if(isset($_GET['music'])){
	$tbl_name = 'music';
	$url_ext = 'music=ngaskgb&';
	$type = 'Song';
}elseif(isset($_GET['info'])){
    $tbl_name = 'info';
    $url_ext = 'info_update=ngaskgb&';
    $type = 'Entry';
}elseif(isset($_GET['gift'])){
    $tbl_name = 'gifts';
    $url_ext = 'gift=ngaskgb&';
    $type = 'Gift';
}else{
	$tbl_name = 'details';
	$url_ext = '';
	$type = 'Invite';
}

$result = $db->getRow("SELECT * FROM $tbl_name WHERE id=:id", array('id'=>$ID));

if(isset($_GET['music'])){
    $display = '<strong><em>'.$result['song_title'].'</em></strong><br/>';
    if($result['song_artist'] != null){
        $display .= 'by <em>'.$result['song_artist'].'</em>';
    }
}elseif(isset($_GET['gift'])){
    $display = $result['gift'];
}else{
    $display = $result['invite_name'];
}
?>
<!DOCTYPE html>
<html><body>
<form action="res/update.php?<?php echo $url_ext; ?>x=njskbdjbsdjbsjk" method="post">
<table border="0" style="color:#111">
	<tr><th colspan="3" style="font-size: 34px;"><?php echo 'Delete '.$type.' '.$ID; ?></th></tr>
	<tr>
		<th colspan="3">Are you sure you want to delete this <?php echo $type; ?>?</th>
	</tr><tr>
		<td colspan="3"><div class="sexy_line"></div></td>
	</tr><tr>
        <td style="text-align:center"><?php echo $display ?></td>
		<td style="text-align:right">
			<input type="hidden" value="<?php echo $ID; ?>" name="id" />
			<input type="submit" value="Yes" class="alt_button" />
		</td>
		<td>&nbsp;</td>
	</tr>
</table>
</form>
	<br/>
</body></html>
<?php $db->closeConnection(); ?>