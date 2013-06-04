<?php // print.php (ADMIN)
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user'])){
    header('location:../index.php');
}

require_once("../../res/connection.php");
$db = new pdo_connection("jdenocco_wedding");
$details = $db->getAllRows("SELECT * FROM details");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript">
    function checkAll() {
        var cbs = document.getElementsByName('invite_id[]');
        for(var i=0; i < cbs.length; i++) {
            cbs[i].checked = true;
        }
    }
</script>
</head>
<body>
<form method="post" action="res/create_invitation.php">
<table border="0" style="color:#111">
	<tr>
		<th colspan="4" style="font-size: 32px;">Print Invite</th>
	</tr><tr>
		<td colspan="4"><div class="sexy_line"></div></td>
	</tr><tr>
        <td colspan="4">
            <input type="button" onclick="checkAll()" value="Select All" class="alt_button">
            &nbsp;&nbsp;&nbsp;
            <input type="reset" value="Deselect All" class="alt_button">
            <br/><br/>
        </td>
	</tr><tr>
        <td><table border="1"><?php
            $i = 1;
            echo '<tr>';
            foreach($details as $invite){
                echo '<td><input type="checkbox" value="'.$invite['id'].'" name="invite_id[]"/>';
                echo $invite['invite_name']."</td>";
                echo ($i%4 == 0)? '</tr><tr>' : '';
                $i++;
            }
        ?></table></td>
	</tr><tr>
        <td colspan="4" style="text-align: center;">
            <input type="submit" value="Create Invitation" class="alt_button"/>
        </td>
	</tr>
</table>
</form>
<br>
</body></html>