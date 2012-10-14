<?php // guests.php    (ADMIN)
$where = '';
if(isset($_GET['show']) && $_GET['show']=='irish'){       // Ireland = 1
    $where = "WHERE location_ID=1";
}elseif(isset($_GET['show']) && $_GET['show']=='usa'){      // Nebraska = 2
    $where = "WHERE location_ID=2";
}
$detail_rows = $db->getAllRows("SELECT * FROM details $where");

function update_invite_entry($ID, $set){
    echo '<td align="center">&nbsp;
        <span class="button"><a href="res/edit.php?id='.$ID.'" title="Edit Invite" class="inline">Edit</a></span>&nbsp;
        <span class="button"><a href="res/remove.php?id='.$ID.'" title="Remove Invite" class="inline">Remove</a></span>&nbsp;';
    if($set == 1){
        echo '<br/><span class="button"><a href="res/update.php?reset=ngsjkbgvdk&id='.$ID.'" title="Reset Music">Reset Music</a></span>';
    }
    echo '</td>';
}

$line = 0;
?>
<script type="text/javascript">
function reload(show){
    window.location='./admin.php'+show;
}
</script>
<p>Forgot about someone? Then <span class="button">
	<a href="res/add.php" class="inline" title="Add Invite">click here</a></span> to add them.
<ul>
	<li style="display:inline-block">
        <input type="radio" value="all" name="show" onclick="reload('')" <?php echo (!isset($_GET['show']) || !in_array($_GET['show'], array('usa', 'irish')))? 'checked' : '';?>/> ALL
    </li>
	<li style="display:inline-block">
        <input type="radio" value="roi" name="show" onclick="reload('?show=irish')" <?php echo (isset($_GET['show']) && $_GET['show']=='irish')? 'checked' : '';?> /> Ireland Only
    </li>
	<li style="display:inline-block">
        <input type="radio" value="usa" name="show" onclick="reload('?show=usa')" <?php echo (isset($_GET['show']) && $_GET['show']=='usa')? 'checked' : '';?>/> Nebraska Only
    </li>
</ul>
</p>
		
<table border="0">
	<tr>
		<th valign="bottom" align="right">ID</th>
		<td valign="bottom" width="10px">&nbsp;</td>
		<th valign="bottom" width="200px">Invitee</th>
		<th valign="bottom">Coming</th>
		<td valign="bottom" width="30px">&nbsp;</td>
		<th valign="bottom" align="left">No. of<br/>Guests</th>
		<th valign="bottom" width="50px">Contact<br/>Number</th>
		<th valign="bottom" width="200px">Address</th>
		<th valign="bottom" width="60px">Code</th>
	</tr>
	<tr><td colspan="10"><div class="sexy_line"></div></td></tr>
	<?php
    if(isset($detail_rows) && !empty($detail_rows)){
        foreach($detail_rows as $details){
            $line++;
            $code = $db->getValue("SELECT code FROM invites WHERE invitee_id=:id", array('id'=>$details['id']));
            $location = $db->getValue("SELECT location FROM location WHERE id=:id", array('id'=>$details['location_ID']));
            $class = ($line%2==1)? ' class="line"' : '';
            echo '<tr'.$class.'>
            <td align="right">'.$details['id'].'</td>
            <td>&nbsp;</td>
            <td>'.$details['invite_name'].'</td>
            <td align="center">';
                if($details['coming'] == -1){
                    echo '***';
                }else if($details['coming'] == 0){
                    echo 'No';
                }else if($details['coming'] == 1){
                    echo $location;
                }
            echo'</td>
            <td>&nbsp;</td>
            <td align="center" width="50px">'.$details['guest_number'].'</td>
            <td>'.$details['number'].'</td>
            <td>'.$details['address'].'</td>
            <td align="center"><em style="font-size:18px;">'.$code.'</em></td>';
            update_invite_entry($details['id'], $details['musicSet']);
            echo '</tr>';
        }
    }else{
        echo '<tr class="line">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center">***</td>
            <td align="center">***</td>
            <td>&nbsp;</td>
            <td>0</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center">***</td>
        </tr>';
    }
echo '</table><br/>'; ?>