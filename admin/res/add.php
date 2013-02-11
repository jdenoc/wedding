<?php // add.php (ADMIN)
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user'])){
	header('location:../index.php');
}
include_once '../../res/connection.php';
$db = new pdo_connection("jdenocco_wedding");

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
</script>
<style>
    .td_center{
        text-align: center;
    }
    .td_top{
        vertical-align: text-top;
    }
    th{
        text-align: center;
        font-size: 32px;
    }
    #add_invite input[type="text"],
    #add_invite input[type="tel"],
    #add_invite select,
    #add_invite textarea{
        width: 150px;
    }
    #add_invite input[type="number"]{
        width: 35px;
    }
    #add_song input[type="text"]{
        width: 150px;
    }
</style>
</head>
<body>
<?php if(!isset($_GET['music'])){ ?>
    <form action="res/update.php?add=sbhjksvbdhk" method="post">
    <table border="0" style="color:#111" id="add_invite">
	<tr>
		<th colspan="2">Add Invite</th>
	</tr><tr>
		<td colspan="2"><div class="sexy_line"></div></td>
	</tr><tr>
		<td><label for="name">Invitees:</label></td>
		<td>
			<input type="text" name="name" id="name" maxlength="100" />
		</td>
	</tr><tr>
		<td><label for="guests">No. of Guests:</label></td>
		<td>
			<input type="number" name="guests" id="guests" maxlength="1" max="9" min="0" />
		</td>
	</tr><tr>
		<td><label for="number">Contact Number:</label></td>
		<td>
			<input type="tel" name="number" id="number" maxlength="20" placeholder="+1 (555) 555-5555" />
		</td>
	</tr><tr>
		<td class="td_top"><label for="address">Address:</label></td>
		<td class="td_center">
			<textarea name="address" id="address"></textarea>
		</td>
	</tr><tr>
        <td class="td_top"><label for="reception">Reception:</label></td>
        <td><select name="reception" id="reception">
            <option value="-1" disabled selected></option>
            <?php
            foreach($db->getAllRows("SELECT * FROM location") as $location){
                echo '<option value="'.$location['id'].'">'.$location['location'].'</option>';
            } ?>
        </select></td>
	</tr><tr>
		<td colspan="2"><div class="sexy_line"></div></td>
	</tr><tr>
		<td colspan="2" class="td_center">
			<span id="code" style="font-family:'Comic Sans MS', cursive;font-weight:bold;color:red;">
			<script>random_code()</script>
			</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" value="Refresh Code" class="alt_button" onclick="random_code()" />
		</td>
	</tr><tr>
		<td colspan="2">&nbsp;</td>
	</tr><tr>
		<td colspan="2" class="td_center">
			<input type="hidden" id="hidden-code" name="invite_code"/>
			<input type="submit" class="alt_button" />
		</td>
	</tr>
    </table>
    </form>
	<br>
<?php }else{ ?>
    <form action="res/update.php?music=bvhjaskd&add=sbhjksvbdhk" method="post">
    <table border="0" style="color: #111;" id="add_song">
	<tr>
		<th colspan="2">Add Song</th>
	</tr><tr>
		<td colspan="2"><div class="sexy_line"></div></td>
	</tr><tr>
		<td><label for="title">Title:</td>
		<td><input type="text" name="title" id="title" maxlength="100" /></td>
	</tr><tr>
		<td><label for="artist">Artist:</label></td>
		<td><input type="text" name="artist" id="artist" maxlength="100" /></td>
	</tr><tr>
		<td><label for="album">Album:</label></td>
		<td><input type="text" name="album" id="album" maxlength="100" /></td>
	</tr><tr>
		<td>&nbsp;</td>
	</tr><tr>
		<td colspan="2" class="td_center">
			<input type="submit" class="alt_button" />
		</td>
	</tr>
    </table>
    </form>
<?php } ?>
</body></html>