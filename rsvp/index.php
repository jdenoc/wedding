<?php // index.php (RSVP)
session_name('rsvp');
session_start();
if(isset($_SESSION['invite_ID'])){
	header('location:rsvp.php');
	exit;
}

$showWarning = false;
if(isset($_POST['proceed'])){
	include_once('../res/connection.php');
	$tbl_name = 'invites';
	$code = strtolower($_POST['invite_code']);
	$code = trim($code);
	$code = stripslashes($code);
	$code = mysql_real_escape_string($code);
	$sql = "SELECT * FROM $tbl_name WHERE code='$code'";
	
	$result=mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count == 1){
		$result_details = mysql_fetch_assoc($result);
		$tbl_name = 'details';
		$id = $result_details['invitee_id'];
		$result = mysql_query("SELECT * FROM $tbl_name WHERE id='$id'");
		$result_details = mysql_fetch_assoc($result);
		
		$_SESSION['invite_ID'] = $id;
		unset($_POST['invite_code']);
		if($result_details['coming']!=1 || $result_details['coming']!=0){
//            echo 'success!!!';
            header("Location:rsvp.php");
			exit;
		}else{
//            echo 'failure'.$result_details['coming'];
			header("Location:complete.php?x=bhjkasbgh");
			exit;
		}
	}else{
		$showWarning = true;
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once "res/header_details.php" ?>
</head>
<body>
<div id="container">
	<div id="head">
		<?php include_once "res/page_header.php" ?>
	</div>
	<div id="main"><table border="0" class="text">
		<tr>
			<th colspan="2">Welcome<br/><br/></th>
		</tr>
		<tr>
			<td colspan="2" width="500px">
				If you're here, it means that you have received an invite to our wedding reception party and didn't want to send us your invite in the post.</br><br/>
			</td>
		</tr>
		<form action="index.php" method="post">
		<?php if($showWarning){
			echo '<tr style="color:#F00">
				<td><strong>*** ATTENTION!!! ***</strong></td>';
				if(empty($code)){
					echo '<td>Please enter a value into the Invite code Field below</td>';
				}else{
					echo '<td>Invite code entry incorrect</td>';
				}
			echo '</tr>';
		} ?>
		<tr>
			<td align="right">Please enter your invite code </td>
			<td><input type="text" name="invite_code" maxlength="6" /><br/></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><input type="submit" name="proceed" class="button"/><br/><br/></td>
		</tr>
		</form>
		<tr>
			<td valign="top" colspan="2">This code can be found in your invitation here:</td>
        </tr><tr>
			<td align="right" colspan="2"><br/><br/><img src="imgs/find-code.png" alt="invite code" class="shadow"/></td>
		</tr>
	</table></div><br/><br/>
<!--	<div id="foot">-->
<!--		--><?php //include_once "res/page_footer.php" ?>
<!--	</div>-->
</div>
</body>
<html>