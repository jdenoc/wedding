<?php // guests.php    (ADMIN)
$where = '';
if(isset($_GET['show']) && $_GET['show']=='irish'){       // Ireland = 1
    $where = "WHERE location_ID=1";
}elseif(isset($_GET['show']) && $_GET['show']=='usa'){      // Nebraska = 2
    $where = "WHERE location_ID=2";
}
$detail_rows = $db->getAllRows(
    "SELECT d.*, i.code AS code, l.location AS location FROM details AS d
    INNER JOIN invites AS i ON d.id=i.invitee_id
    INNER JOIN location AS l on d.location_ID = l.id
    $where
    ORDER BY d.id"
);

function update_invite_entry($ID, $set){
    echo '<td style="text-align: center;width:50px">
        <span class="button"><a href="res/edit.php?id='.$ID.'" title="Edit Invite" class="inline">Edit</a></span><br/>
        <span class="button"><a href="res/remove.php?id='.$ID.'" title="Remove Invite" class="inline">Remove</a></span>';
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
Forgot about someone? Then <span class="button">
<a href="res/add.php" class="inline" title="Add Invite">click here</a></span> to add them.
<ul>
	<li style="display:inline-block"><label>
        <input type="radio" value="all" name="show" onclick="reload('')" <?php echo (!isset($_GET['show']) || !in_array($_GET['show'], array('usa', 'irish')))? 'checked' : '';?>/> ALL
    </label></li>
	<li style="display:inline-block"><label>
        <input type="radio" value="roi" name="show" onclick="reload('?show=irish')" <?php echo (isset($_GET['show']) && $_GET['show']=='irish')? 'checked' : '';?> /> Ireland Only
    </label></li>
	<li style="display:inline-block"><label>
        <input type="radio" value="usa" name="show" onclick="reload('?show=usa')" <?php echo (isset($_GET['show']) && $_GET['show']=='usa')? 'checked' : '';?>/> Nebraska Only
    </label></li>
</ul>

<table border="0" id="guests">
	<tr>
		<th style="vertical-align: bottom;text-align: right;width: 35px">ID</th>
		<td style="vertical-align: bottom;width:10px">&nbsp;</td>
		<th style="vertical-align: bottom;width:200px">Invitee</th>
		<th style="vertical-align: bottom;width: 100px">Coming</th>
		<td style="vertical-align: bottom;width:30px">&nbsp;</td>
		<th style="vertical-align: bottom;text-align: left;">No. of<br/>Guests</th>
		<th style="vertical-align: bottom;width:50px">Contact<br/>Number</th>
		<th style="vertical-align: bottom;width:200px">Address</th>
		<th style="vertical-align: bottom;width:60px">Code</th>
	</tr>
	<tr><td colspan="10"><div class="sexy_line"></div></td></tr>
	<?php
    if(isset($detail_rows) && !empty($detail_rows)){
        foreach($detail_rows as $details){
            $line++;
            $class = ($line%2==1)? ' class="line"' : '';
            echo '<tr'.$class.'>
            <td style="text-align: right">'.$details['id'].'</td>
            <td>&nbsp;</td>
            <td>'.$details['invite_name'].'</td>
            <td style="text-align: center;">';
                if($details['coming'] == -1){
                    echo '***';
                }else if($details['coming'] == 0){
                    echo 'No<br/>'.$details['rsvp_date'];
                }else if($details['coming'] == 1){
                    echo 'Yes<br/>'.$details['rsvp_date'];
                }
            echo'<br/>'.$details['location'].'</td>
            <td>&nbsp;</td>
            <td style="text-align: center;width:50px">'.$details['guest_number'].' / '.$details['invite_number'].'</td>
            <td>'.$details['number'].'</td>
            <td>'.$details['address'].'</td>
            <td style="text-align: center;font-size:18px;color: #F50000;'.(($details['coming'] == 0 || $details['coming'] == 1)? 'text-decoration: line-through;' : '').'"><em>'.$details['code'].'</em></td>';
            update_invite_entry($details['id'], $details['musicSet']);
            echo '</tr>';
        }
    }else{
        echo '<tr class="line">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align: center">***</td>
            <td style="text-align: center">***</td>
            <td>&nbsp;</td>
            <td>0</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align: center">***</td>
        </tr>';
    }
echo '</table><br/>'; ?>