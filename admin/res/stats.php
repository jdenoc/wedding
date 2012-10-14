<?php //stats.php
//	invite stats
$tbl_name = 'details';

$coming = mysql_num_rows(mysql_query("SELECT * FROM $tbl_name WHERE coming=1"));
$coming_ie = mysql_num_rows(mysql_query("SELECT * FROM $tbl_name WHERE coming=1 AND (location_ID=1 OR location_ID=0)"));
$coming_ne = mysql_num_rows(mysql_query("SELECT * FROM $tbl_name WHERE coming=1 AND (location_ID=2 OR location_ID=0)"));

$total = mysql_num_rows($invite_query);
$rsvp = mysql_num_rows(mysql_query("SELECT * FROM $tbl_name WHERE (coming=1 OR coming=0)"));
$guests = mysql_fetch_assoc(mysql_query("SELECT SUM(guest_number) AS g
FROM $tbl_name"));

//	music stats
$total_songs = mysql_num_rows($music_query);

echo '
<table border="0" id="stats" style="color:#111">
	<tr style="font-size:24px">
		<th colspan="2" align="center" style="text-decoration: underline;">Invites</th>
	</tr><tr>
        <th colspan="2"><em>Coming</em></th>
    </tr><tr>
        <th align="left">Ireland</th>
        <td align="center">'.$coming_ie.'</td>
    </tr><tr>
        <th align="left">Nebraska</th>
        <td align="center">'.$coming_ne.'</td>
    </tr><tr>
        <th align="left">Total Coming</th>
        <td align="center">'.$coming.'</td>
	</tr><tr>
        <th align="left">Total Guests</th>
        <td align="center">'.$guests['g'].'</td>
	</tr><tr>
        <th><br/>RSVP\'s</th>
        <th><br/>Total Invites</th>
    </tr><tr>
        <td align="center">'.$rsvp.'</td>
        <td align="center">'.$total.'</td>
	</tr><tr>
		<td colspan="6"><div class="sexy_line"></div></td>
	</tr><tr style="font-size:24px">
		<th colspan="2" align="center" style="text-decoration: underline;">Songs</th>
	<tr>
		<th colspan="1" align="right">Total:</th>
		<td align="center">'.$total_songs.'<br/></td>
	</tr>
</table>'; ?>