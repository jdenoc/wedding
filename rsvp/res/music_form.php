<?php
function fillRow($title, $name){
	echo '<td align="right" width="150px">'.$title.':&nbsp;&nbsp;&nbsp;</td>';
	echo '<td align="center"><input type="text" name="'.$name.'" maxlength="100" size="40" />';
}
?>
<style type="text/css">
    #show_music1, #show_music2, #show_music3{
        width: 200px;
        text-align: center;
        vertical-align: middle;
    }
</style>
<script type="text/javascript">
    function show_second_song(){
        $('#show_music1').hide();
        $('#hr1').show();
        $('#song2').show();
        $('#art2').show();
        $('#album2').show();
        $('#show_music2').show();
    }
    function show_third_song(){
        $('#show_music2').hide();
        $('#hr2').show();
        $('#song3').show();
        $('#art3').show();
        $('#album3').show();
    }
    function reset_music(){
        $('#show_music1').show();
        $('#hr1').hide();
        $('#song2').hide();
        $('#art2').hide();
        $('#album2').hide();
        $('#show_music2').hide();
        $('#hr2').hide();
        $('#song3').hide();
        $('#art3').hide();
        $('#album3').hide();
    }
</script>
<div id="music_form" style="width:575px; height:350px; overflow:auto; padding-left:10px; font-family:'Merienda One', cursive;">
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
			<input type="button" value="Add another song" class="alt_button" onclick="show_second_song()"/>
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
			<input type="button" value="Add another song" class="alt_button" onclick="show_third_song()"/>
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
			<br/><input type="submit" class="alt_button" value="Submit Song selection" />
			<input type="reset" class="alt_button" value="Reset Music Selection" onclick="reset_music()"/><br/>
		</td>
	</tr>
</table>
</form>
</div>