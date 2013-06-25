<?php // guests.php    (ADMIN)
$gift_rows = $db->getAllRows(
    "SELECT * FROM gifts ORDER BY id DESC"
);

function update_invite_entry($ID){
    echo '<td>
        <span class="button"><a href="res/edit.php?id='.$ID.'&gift=vnsbvldn" title="Edit Invite" class="inline">Edit</a></span><br/>
        <span class="button"><a href="res/remove.php?id='.$ID.'&gift=mkdslbnkl" title="Remove Gift" class="inline">Remove</a></span>';
    echo '</td>';
}

$line = 0;
?>
Forgot about someone? Then <span class="button">
<a href="res/add.php?gift=nsjkbnkdf" class="inline" title="Add Invite">click here</a></span> to add them.

    <table border="0" id="gifts">
        <tr>
            <th>ID</th>
            <td>&nbsp;</td>
            <th>Got From</th>
            <th>Gift</th>
            <td>&nbsp;</td>
            <th>Thanked</th>
            <th>Thank-You<br/>Sent</th>
        </tr>
        <tr><td colspan="8"><div class="sexy_line"></div></td></tr>
	<?php
    if(isset($gift_rows) && !empty($gift_rows)){
        foreach($gift_rows as $gifts){
            $line++;
            $class = ($line%2==1)? ' class="line"' : '';
            echo '<tr'.$class.'>
            <td style="text-align: right">'.$gifts['id'].'</td>
            <td>&nbsp;</td>
            <td>'.$gifts['gift_giver'].'</td>
            <td>'.$gifts['gift'].'</td>
            <td>&nbsp;</td>
            <td>';
            if($gifts['thanked'] == 0){
                echo 'No';
            }else if($gifts['thanked'] == 1){
                echo 'Yes';
            }
            echo'</td>
            <td>'.($gifts['thanked_stamp'] == '0000-00-00' ? '' : $gifts['thanked_stamp']).'</td>';

            update_invite_entry($gifts['id']);
            echo '</tr>';
        }
    }else{
        echo '<tr class="line">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>***</td>
            <td>***</td>
            <td>&nbsp;</td>
            <td>N/A</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>';
    }
echo '</table><br/>'; ?>