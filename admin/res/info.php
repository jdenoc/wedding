<?php  // info.php (ADMIN)
require_once('../../res/connection.php');
$db = new pdo_connection("jdenocco_wedding");
$info = $db->getAllRows("SELECT * FROM info");
$info_table = array('event', 'type', 'text');
?>
<html><body>
<form action="res/update_info.php" method="post">
    <table border="0" style="color: #111;">
        <tr>
            <td colspan="5" align="center"><h1>Update Info</h1></td>
        </tr><tr>
        <td colspan="5"><div class="sexy_line"></div></td>
    </tr><tr>
        <th>ID</th>
        <th>Event</th>
        <th>Type</th>
        <th>Text</th>
    </tr>

    <?php foreach($info as $i){ ?>
          <tr>
              <td valign="top"><?php echo $i['id']; ?></td>
              <td valign="top"><input type="input" name="<?php echo $i['id'].'_'.$info_table[0]; ?>" value="<?php echo $i['event']?>"/></td>
              <td valign="top"><input type="input" name="<?php echo $i['id'].'_'.$info_table[1]; ?>" value="<?php echo $i['type']?>"/></td>
              <td valign="top"><textarea name="<?php echo $i['id'].'_'.$info_table[2]; ?>"><?php echo $i['text']?></textarea></td>
              <td class="button"><a href="res/update.php?x=hsjbvgdbgh&id=<?php echo $i['id']; ?>&info=bgsgbvfkb" title="Remove Invite" class="inline">Remove</a></td>
          </tr>
    <?php $i++; } ?>
        <td>&nbsp;</td>
    </tr>
    <tr><td colspan="5"><div class="sexy_line"></div></td></tr>
    <tr>
        <th valign="top">New: </th>
        <td valign="top"><input type="input" name="<?php echo 'new_'.$info_table[0]; ?>"/></td>
        <td valign="top"><input type="input" name="<?php echo 'new_'.$info_table[1]; ?>"/></td>
        <td valign="top"><textarea name="<?php echo 'new_'.$info_table[2]; ?>"></textarea></td>
    </tr><tr>
        <td colspan="5" align="center">
            <input type="submit" class="button" />
        </td>
    </tr>
    </table>
</form>
</body></html>