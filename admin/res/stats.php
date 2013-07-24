<?php //stats.php  (ADMIN)
require_once('../../res/connection.php');
$db = new pdo_connection("jdenocco_wedding");

//	INVITE stats
$invites = $db->getValue("SELECT SUM(invite_number) FROM details");
$invites_ie = $db->getValue("SELECT SUM(invite_number) FROM details WHERE location_ID IN (1,0)");
$invites_ne = $db->getValue("SELECT SUM(invite_number) FROM details WHERE location_ID IN (2,0)");

$coming = $db->getValue("SELECT SUM(guest_number) FROM details WHERE coming=1");
$coming_ie = $db->getValue("SELECT SUM(guest_number) FROM details WHERE coming=1 AND location_ID IN (1,0)");
$coming_ne = $db->getValue("SELECT SUM(guest_number) FROM details WHERE coming=1 AND location_ID IN (2,0)");

$of_invites = $db->getValue("SELECT SUM(invite_number) FROM details WHERE coming IN (0,1)");
$of_invites_ie = $db->getValue("SELECT SUM(invite_number) FROM details WHERE coming IN (0,1) AND location_ID IN (1,0)");
$of_invites_ne = $db->getValue("SELECT SUM(invite_number) FROM details WHERE coming IN (0,1) AND location_ID IN (2,0)");

$sent = $db->getValue('SELECT COUNT(*) FROM details');
$rsvp = $db->getValue("SELECT COUNT(*) FROM details WHERE coming IN (1,0)");

// MUSIC stats
$total_songs = count($db->getAllRows("SELECT * FROM music"));
?>
<!DOCTYPE html>
<html><body>
<table border="0" id="stats" style="color:#111">
	<tr>
		<th colspan="4" style="text-decoration: underline;font-size:24px">Invites</th>
	</tr><tr>
        <td>&nbsp;</td>
        <th><em>Invited</em></th>
        <th><em>Coming</em></th>
    </tr><tr>
        <th style="text-align: left">Ireland</th>
        <td style="text-align: center"><?php echo $invites_ie; ?></td>
        <td style="text-align: center"><?php echo ($coming_ie? $coming_ie : 0).' / '.($of_invites_ie? $of_invites_ie : 0); ?> </td>
    </tr><tr>
        <th style="text-align: left">Nebraska</th>
        <td style="text-align: center"><?php echo $invites_ne;?></td>
        <td style="text-align: center"><?php echo ($coming_ne? $coming_ne : 0).' / '.($of_invites_ne? $of_invites_ne : 0); ?></td>
    </tr><tr>
        <th style="text-align: left">Total Coming</th>
        <td style="text-align: center"><?php echo $invites; ?></td>
        <td style="text-align: center"><?php echo (($coming)? $coming : 0).' / '.($of_invites? $of_invites : 0); ?></td>
	</tr><tr>
        <th><br/>Invites sent</th>
        <td>&nbsp;</td>
        <th><br/>RSVP's</th>
    </tr><tr>
        <td style="text-align: center"><?php echo $sent; ?></td>
        <td>&nbsp;</td>
        <td style="text-align: center"><?php echo $rsvp; ?></td>
    </tr><tr>
		<td colspan="3"><div class="sexy_line"></div></td>
	</tr><tr>
		<th colspan="3" style="text-align: center; text-decoration: underline; font-size: 24px;">Songs</th>
	</tr><tr>
		<th style="text-align: right">Total:</th>
		<td colspan="2" style="text-align: center;"><?php echo $total_songs; ?><br/></td>
	</tr>
</table>
</body></html>
<?php $db->closeConnection(); ?>