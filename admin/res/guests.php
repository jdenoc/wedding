<?php // guests.php
$where = '';
if(isset($_GET['show']) && $_GET['show']=='irish'){       // Ireland = 1
    $where = "WHERE location_ID=1";
}elseif(isset($_GET['show']) && $_GET['show']=='usa'){      // Nebraska = 2
    $where = "WHERE location_ID=2";
}
$sql = "SELECT * FROM details $where";
$invite_query = mysql_query($sql);
$details = mysql_fetch_assoc($invite_query);

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
		<td width="10px">&nbsp;</td>
		<th width="200px" valign="bottom">Invitee</th>
		<th valign="bottom">Coming</th>
		<td width="30px">&nbsp;</td>
		<th align="left" valign="bottom">No. of<br/>Guests</th>
		<th width="50px" valign="bottom">Contact<br/>Number</th>
		<th width="200px" valign="bottom">Address</th>
		<th width="60px" valign="bottom">Code</th>
	</tr>
	<tr><td colspan="10"><div class="sexy_line"></div></td></tr>
	<?php
    if(isset($details) && !empty($details)){
        do{ $line++;
            $code_q = mysql_query("SELECT code FROM invites WHERE invitee_id=".$details['id']);
            $code = mysql_fetch_assoc($code_q);
            $location_q = mysql_query("SELECT location FROM location WHERE id=".$details['location_ID']);
            $location = mysql_fetch_assoc($location_q);
            $class = ($line%2==1)? ' class="line"' : '';
            echo '<tr'.$class.'>
            <td align="right">'.$details['id'].'</td>
            <td>&nbsp;</td>
            <td>'.$details['invite_name'].'</td>
            <td align="center">';
                if($details['coming'] == null){
                    echo '***';
                }else if($details['coming'] == 0){
                    echo 'No';
                }else if($details['coming'] == 1){
                    echo $location['location'];
                }
            echo'</td>
            <td>&nbsp;</td>
            <td align="center" width="50px">'.$details['guest_number'].'</td>
            <td>'.$details['number'].'</td>
            <td>'.$details['address'].'</td>
            <td align="center"><em style="font-size:18px;">'.$code['code'].'</em></td>';
            update_invite_entry($details['id'], $details['musicSet']);
            echo '</tr>';
        }while($details = mysql_fetch_assoc($invite_query));
    }else{
        echo '<tr class="line">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>***</td>
            <td>&nbsp;</td>
            <td>0</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>';
    }
echo '</table>'; ?>