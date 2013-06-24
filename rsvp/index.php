<?php // index.php (RSVP)
session_name('rsvp');
@session_start();
if(isset($_SESSION['invite_ID'])){
	header('location:rsvp.php');
	exit;
}

$showWarning = false;
if(isset($_POST['proceed'])){
	include_once('../res/connection.php');
    $db = new pdo_connection('jdenocco_wedding');
	$code = strtolower($_POST['invite_code']);
	$code = trim($code);
    $invites = $db->getRow("SELECT * FROM invites WHERE code=:code", array('code'=>$code));

    if(!empty($invites) && $code != ''){
        $id = $invites['invitee_id'];
        $details = $db->getRow("SELECT * FROM details WHERE id=:id", array('id'=>$id));
        $_SESSION['invite_ID'] = $id;
        unset($_POST['invite_code']);
        if(isset($details['coming']) && ($details['coming'] == 0 || $details['coming'] == 1)){
            header("Location:complete.php?x=bhjkasbgh");
            exit;
        }else{
            header("Location:rsvp.php");
            exit;
        }
    }else{
		$showWarning = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once "res/header_details.php" ?>
</head>
<body>
<div id="container">
	<header><?php include_once "res/page_header.php" ?></header>
	<div id="main">
        <form action="index.php" method="post">
        <table border="0" class="text">
		<tr>
			<th colspan="2">Welcome<br/><br/></th>
		</tr>
		<tr>
			<td colspan="2">
				If you're here, it means that you have received an invite to our wedding reception party and didn't want to send us your invite in the post.<br/><br/>
			</td>
		</tr>

		<?php if($showWarning){
			echo '<tr style="color:#F00; font-family:Tahoma, Geneva, sans-serif; font-size: 16px;">
				<th>ATTENTION!!!</th>';
			    echo (empty($code))? '<td>Please enter a value into the Invite code Field below</td>' : '<td>Invite code entry incorrect</td>';
			echo '</tr>';
            @session_destroy();
		} ?>
		<tr>
			<td style="text-align: right"><label for="invite_code">Please enter your invite code: </label></td>
			<td><input type="text" name="invite_code" id="invite_code" maxlength="6" /><br/></td>
		</tr>
		<tr>
			<td style="text-align: center" colspan="2"><input type="submit" name="proceed" class="button"/><br/><br/></td>
		</tr>

		<tr>
			<td style="vertical-align: top" colspan="2">This code can be found in your invitation here:</td>
        </tr><tr>
			<td style="text-align: center" colspan="2"><br/><img src="../imgs/find-code.png" alt="invite code" class="shadow"/></td>
		</tr>
	</table>
    </form>
    </div><br/><br/>
</div>
</body>
</html>