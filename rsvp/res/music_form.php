<?php
function fillRow($title, $name){
	echo '<td align="right" width="150px">'.$title.':&nbsp;&nbsp;&nbsp;</td>';
	echo '<td align="center"><input type="text" name="'.$name.'" maxlength="100" size="40" />';
}
?>
<style>
    #show_music1, #show_music2, #show_music3{
        width: 200px;
        text-align: center;
        vertical-align: middle;
    }
</style>
<div id="music_form" style="width:550px; height:350px; overflow:auto; padding-left:10px; font-family:'Merienda One', cursive;">
<form method="post" action="res/submit_music.php">
<table border="0" style="color: #111;">
	<tr>
		<td colspan="3">
            Enter a song title to have it considered for addition to our wedding playlist.<br/>
            Add "Artist" & "Album Title" to make sure we've got the right song.<br/>
            (Note: Artist & Album Title are optional)<br/><br/>
		</td>
	</tr>
<!-- SONG1 -->
	<tr>
		<?php fillRow("Song", "song_1"); ?>
		<td rowspan="3" id="show_music1">
			<input type="button" value="Add another song" class="button" onclick="hideStuff('show_music1');showRow('hr1');showRow('song2');showRow('art2');showRow('album2');showCell('show_music2')"/>
		</td>
	</tr><tr>
		<?php fillRow("Artist", "artist_1"); ?>
	</tr><tr>
		<?php fillRow("Album", "album_1"); ?>
	</tr>
	<!-- SONG2 -->
	<tr id="hr1" style="display:none"><td colspan="3"><hr/></td></tr>
	<tr id="song2" style="display:none">
		<?php fillRow("Song", "song_2"); ?>
		<td rowspan="3" id="show_music2">
			<input type="button" value="Add another song" class="button" onclick="hideStuff('show_music2');showRow('hr2');showRow('song3');showRow('art3');showRow('album3');"/>
		</td>
	</tr><tr id="art2" style="display:none">
		<?php fillRow("Artist", "artist_2"); ?>
	</tr><tr id="album2" style="display:none">
		<?php fillRow("Album", "album_2"); ?>
	</tr>
	<!-- SONG3 -->
	<tr id="hr2" style="display:none"><td colspan="3"><hr/></td></tr>
	<tr id="song3" style="display:none">
		<?php fillRow("Song", "song_3"); ?>
		<td id="show_music3">&nbsp;</td>
	</tr><tr id="art3" style="display:none">
		<?php fillRow("Artist", "artist_3"); ?>
	</tr><tr id="album3" style="display:none">
		<?php fillRow("Album", "album_3"); ?>
	</tr>
	
	<!-- SUBMIT -->
	<tr>
		<td colspan="3" style="text-align:center">
			<br/><input type="submit" class="button" value="Submit Song selection" />
			<input type="reset" class="button" value="Reset Music Selection" onclick="showCell('show_music1');hideStuff('hr1');hideStuff('song2');hideStuff('art2');hideStuff('album2');hideStuff('hr2');hideStuff('song3');hideStuff('art3');hideStuff('album3');"/><br/>
		</td>
	</tr>
</table>
</form>
</div>