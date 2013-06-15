<?php // music.php (ADMIN)
$music_rows = $db->getAllRows("
    SELECT m.*, IF(d.id=0, 'admin', d.invite_name) AS invite_name
    FROM music AS m
    INNER JOIN details AS d ON m.uploader = d.id
");

function update_music_entry($ID){
	echo '
		<td style="text-align:center; width:50px">
		    <span class="button"><a href="res/edit.php?id='.$ID.'&music=bhsjvbshjes" title="Edit Song" class="inline">Edit</a></span>&nbsp;
		    <span class="button"><a href="res/remove.php?id='.$ID.'&music=bvshjdbvgehj" title="Remove Song" class="inline">Remove</a></span>
        </td>
		';
}

$line = 0;
?>
<p>Want to add a song yourself? Then <span class="button">
	<a href="res/add.php?music=vnsjkdv" class="inline" title="Add Invite">click here</a></span> to add it.
</p>
<table border="0">
	<tr>
		<th style="width: 35px; text-align: right;">ID</th>
		<td style="width: 10px;">&nbsp;</td>
		<th style="width: 200px; vertical-align: bottom">Song</th>
		<th style="width: 150px;">Artist</th>
		<th style="width: 150px;">Album</th>
		<th style="width: 100px;">By</th>
		<th style="width: 150px;">On</th>
	</tr>
	<tr><td colspan="9"><div class="sexy_line"></div></td></tr>
	<?php foreach($music_rows as $music){
        $line++;
		echo '<tr';
        echo ($line%2==0)? ' class="line"' : '';
		echo '>
		<td style="text-align: right">'.$music['id'].'</td>
		<td>&nbsp;</td>
		<td>'.$music['song_title'].'</td>
		<td style="text-align: center">';
            echo ($music['song_artist'] == null)? '***' : $music['song_artist'];
		echo'</td>
		<td style="text-align: center">';
			echo ($music['song_album'] == null)? '***' : $music['song_album'];
		echo '</td>';
        echo '<td style="text-align: center">'.$music['invite_name'].'</td>';
        echo '<td>'.$music['stamp'].'</td>';
		update_music_entry($music['id']);
        echo '<td style="text-align: center">';
        if($music['spotify'] !='')
            echo '<a href="'.$music['spotify'].'"><img src="../imgs/spotify_active.png" alt="Spotify Link" title=""/></a>';
        else
            echo '<img src="../imgs/spotify_invert.png" title="Song not yet set."/>';
        echo '</td></tr>';
	}
echo '</table>';?>