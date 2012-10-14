<?php // index.php (ADMIN)
session_name('wedding_admin');
session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] != ''){
    header("location:admin.php");
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once 'res/header_details.php'; ?>
    <script type="text/javascript">
        function reload(){
            window.location='../';
        }
    </script>
</head>
<body>
<form name="form1" method="post" action="checklogin.php">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1"  style="color: #111;background-color: #CCC;">
    <tr>
        <th colspan="2">Welcome</th>
    </tr>
    <tr>
        <td colspan="2">
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
			<tr>
				<th colspan="3" align="left">Member Login</th>
			</tr>
			<tr>
				<td width="78">Username</td>
				<td width="6">:</td>
				<td width="294"><input name="myusername" type="text" id="myusername"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td><input name="mypassword" type="password" id="mypassword"></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
				<td>
                    <input type="submit" name="Submit" value="Login" class="button"/>&nbsp;
				    <input type="button" value="Return" class="button" onclick="reload()"/>
                </td>
			</tr>
		</table>
        </td>
    </tr>
</table>
</form>
</html>