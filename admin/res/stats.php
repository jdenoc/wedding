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
	<tr>
		<th colspan="2" style="text-decoration: underline;font-size:24px">Invites</th>
	</tr><tr>
        <th colspan="2"><em>Coming</em></th>
    </tr><tr>
        <th style="text-align: left">Ireland</th>
        <td style="text-align: center"><?php echo $coming_ie; ?></td>
    </tr><tr>
        <th style="text-align: left">Nebraska</th>
        <td style="text-align: center"><?php echo $coming_ne;?></td>
    </tr><tr>
        <th style="text-align: left">Total Coming</th>
        <td style="text-align: center"><?php echo $coming; ?></td>
	</tr><tr>
        <th style="text-align: left">Total Guests</th>
        <td style="text-align: center"><?php echo $guests; ?></td>
	</tr><tr>
        <th><br/>RSVP's</th>
        <th><br/>Total Invites</th>
    </tr><tr>
        <td style="text-align: center"><?php echo $rsvp; ?></td>
        <td style="text-align: center"><?php echo $total; ?></td>
	</tr><tr>
		<td colspan="6"><div class="sexy_line"></div></td>
	</tr><tr>
		<th colspan="2" style="text-align: center; text-decoration: underline; font-size: 24px;">Songs</th>
	</tr><tr>
		<th colspan="1" style="text-align: right;">Total:</th>
		<td style="text-align: center;"><?php echo $total_songs; ?><br/></td>
	</tr>
</table>
</body></html>
<?php $db->closeConnection(); ?>