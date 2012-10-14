<?php //stats.php  (ADMIN)
require_once('../../res/connection.php');
$db = new pdo_connection("jdenocco_wedding");

//	INVITE stats
$coming = count($db->getAllRows("SELECT * FROM details WHERE coming=1"));
$coming_ie = count($db->getAllRows("SELECT * FROM details WHERE coming=1 AND (location_ID=1 OR location_ID=0)"));
$coming_ne = count("SELECT * FROM details WHERE coming=1 AND (location_ID=2 OR location_ID=0)");

$total = count($db->getAllRows('SELECT * FROM details'));
$rsvp = count($db->getAllRows("SELECT * FROM details WHERE (coming=1 OR coming=0)"));
$guests = $db->getValue("SELECT SUM(guest_number) FROM details");

// MUSIC stats
$total_songs = count($db->getAllRows("SELECT * FROM music"));
?>
<html><body>
<table border="0" id="stats" style="color:#111">
	<tr style="font-size:24px">
		<th colspan="2" align="center" style="text-decoration: underline;">Invites</th>
	</tr><tr>
        <th colspan="2"><em>Coming</em></th>
    </tr><tr>
        <th align="left">Ireland</th>
        <td align="center"><?php echo $coming_ie; ?></td>
    </tr><tr>
        <th align="left">Nebraska</th>
        <td align="center"><?php echo $coming_ne;?></td>
    </tr><tr>
        <th align="left">Total Coming</th>
        <td align="center"><?php echo $coming; ?></td>
	</tr><tr>
        <th align="left">Total Guests</th>
        <td align="center"><?php echo $guests; ?></td>
	</tr><tr>
        <th><br/>RSVP's</th>
        <th><br/>Total Invites</th>
    </tr><tr>
        <td align="center"><?php echo $rsvp; ?></td>
        <td align="center"><?php echo $total; ?></td>
	</tr><tr>
		<td colspan="6"><div class="sexy_line"></div></td>
	</tr><tr style="font-size:24px">
		<th colspan="2" align="center" style="text-decoration: underline;">Songs</th>
	<tr>
		<th colspan="1" align="right">Total:</th>
		<td align="center"><?php echo $total_songs; ?><br/></td>
	</tr>
</table>
</body></html>
<?php $db->closeConnection(); ?>