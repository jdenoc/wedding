<?php // index.php (ADMIN)
session_name('wedding_admin');
session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] != ''){
    header("location:admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once 'res/header_details.php'; ?>
    <script type="text/javascript">
        function reload(){
            window.location='../';
        }
    </script>
</head>
<body><div style="width:300px; margin: 0 auto;padding-top: 75px">
<form name="form1" method="post" action="checklogin.php">
<table border="0" style="color: #111;background-color: #CCC; text-align: center; border-spacing:0; border-collapse:collapse; padding: 1px">
    <tr>
        <th colspan="2">Welcome</th>
    </tr>
    <tr>
        <td colspan="2">
        <table border="0" style="width: 100%;background-color: #FFF;border-spacing:1; border-collapse:separate;padding: 3px">
			<tr>
				<th colspan="3" style="text-align:left">Member Login</th>
			</tr>
			<tr>
				<td style="width:78px"><label for="myusername">Username</label></td>
				<td style="width:6px">:</td>
				<td style="width:294px"><input name="myusername" type="text" id="myusername"></td>
			</tr>
			<tr>
				<td><label for="mypassword">Password</label></td>
				<td>:</td>
				<td><input name="mypassword" type="password" id="mypassword"></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
				<td>
                    <input type="submit" name="Submit" value="Login" class="alt_button"/>&nbsp;
				    <input type="button" value="Return" class="alt_button" onclick="reload()"/>
                </td>
			</tr>
		</table>
        </td>
    </tr>
</table>
</form>
    </div>
</body>
</html>