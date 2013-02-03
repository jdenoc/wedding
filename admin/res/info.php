<?php  // info.php (ADMIN)
require_once('../../res/connection.php');
$db = new pdo_connection("jdenocco_wedding");
$info = $db->getAllRows("SELECT * FROM info");
$info_table = array('event', 'type', 'text');
?>
<html>
<head><style>
    .center_td{
        text-align: center;
    }
    .top_td{
        vertical-align: top;
    }
</style>
</head>
<body>
<form action="res/update_info.php" method="post">
    <table border="0" style="color: #111;">
        <tr>
            <td colspan="5" class="center_td"><h1>Update Info</h1></td>
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
              <td class="center_td"><?php echo $i['id']; ?></td>
              <td class="top_td"><input type="text" name="<?php echo $i['id'].'_'.$info_table[0]; ?>" value="<?php echo stripslashes($i['event']); ?>"/></td>
              <td class="top_td"><input type="text" name="<?php echo $i['id'].'_'.$info_table[1]; ?>" value="<?php echo stripslashes($i['type']); ?>"/></td>
              <td class="top_td"><textarea name="<?php echo $i['id'].'_'.$info_table[2]; ?>"><?php echo stripslashes($i['text']); ?></textarea></td>
              <td class="alt_button"><a href="res/update.php?x=hsjbvgdbgh&id=<?php echo $i['id']; ?>&info=bgsgbvfkb" title="Remove Invite" class="inline">Remove</a></td>
          </tr>
    <?php $i++; } ?>
    <tr><td>&nbsp;</td></tr>
    <tr><td colspan="5"><div class="sexy_line"></div></td></tr>
    <tr>
        <th class="top_td">New: </th>
        <td class="top_td"><input type="text" name="<?php echo 'new_'.$info_table[0]; ?>"/></td>
        <td class="top_td"><input type="text" name="<?php echo 'new_'.$info_table[1]; ?>"/></td>
        <td class="top_td"><textarea name="<?php echo 'new_'.$info_table[2]; ?>"></textarea></td>
    </tr><tr>
        <td colspan="5" class="center_td">
            <input type="submit" class="alt_button" />
        </td>
    </tr>
    </table>
</form>
</body></html><?php $db->closeConnection(); ?>