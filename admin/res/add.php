<?php // add.php (ADMIN)
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user'])){
	header('location:../index.php');
}

if(!isset($_GET['music'])){ ?>
<html>
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

</script></head>
<body>
    <form action="res/update.php?add=sbhjksvbdhk" method="post">
    <table border="0" style="color:#111">
	<tr>
		<th colspan="4" align="center" style="font-size: 32px;">Add Invite</th>
	</tr><tr>
		<td colspan="4"><div class="sexy_line"></div></td>
	</tr><tr>
		<td>Invitees:</td>
		<td colspan="3">
			<input type="text" name="name" maxlength="100" size="25" />
		</td>
	</tr><tr>
		<td>No. of Guests:</td>
		<td>
			<input type="text" name="guests" maxlength="1" size="1" />
		</td>
	</tr><tr>
		<td>Contact Number:</td>
		<td colspan="2">
			<input type="text" name="number" maxlength="20" />
		</td>
	</tr><tr>
		<td valign="top">Address:</td>
		<td colspan="3" align="center">
			<textarea name="address"></textarea>
		</td>
	</tr><tr>
		<td colspan="4"><div class="sexy_line"></div></td>
	</tr><tr>
		<td colspan="4" align="center">
			<span id="code" style="font-family:'Comic Sans MS', cursive;font-weight:bold;color:red;">
			<script>random_code()</script>
			</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" value="Refresh Code" class="button" onclick="random_code()" />
		</td>
	</tr><tr>
		<td>&nbsp;</td>
	</tr><tr>
		<td colspan="4" align="center">
			<input type="hidden" id="hidden-code" name="invite_code"/>
			<input type="submit" class="button" />
		</td>
	</tr>
    </table>
    </form>
	<br>
</body></html>
<?php }else{ ?>
<html><body>
    <form action="res/update.php?music=bvhjaskd&add=sbhjksvbdhk" method="post">
    <table border="0" style="color: #111;">
	<tr>
		<td colspan="2" align="center"><h1>Add Song</h1></td>
	</tr><tr>
		<td colspan="2"><div class="sexy_line"></div></td>
	</tr><tr>
		<td>Title:</td>
		<td><input type="text" name="title" maxlength="100" size="30" /></td>
	</tr><tr>
		<td>Artist:</td>
		<td><input type="text" name="artist" maxlength="100" size="30" /></td>
	</tr><tr>
		<td>Album:</td>
		<td><input type="text" name="album" maxlength="100" size="30" /></td>
	</tr><tr>
		<td>&nbsp;</td>
	</tr><tr>
		<td colspan="2" align="center">
			<input type="submit" class="button" />
		</td>
	</tr>
    </table>
    </form>
</body></html>
<?php } ?>