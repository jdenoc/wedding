<?php // button_table.php (ADMIN) ?>
<style>
    td.blank{
        width: 20px;
    }
    td.button{
        width: 125px;
    }
</style>
<table border="0" style="float:right;padding: 20px 30px 10px 0;">
    <tr>
        <td class="button">
            <a href="res/upload.php" title="Upload Image" class="inline">Upload Image</a>
        </td>
        <td class="blank">&nbsp;</td>
        <td class="button">
        <?php if(!isset($_GET['display']) || $_GET['display']=='invites'){ ?>
            <a href="admin.php?display=music" title="Change Display">
            Display Music</a>
        <?php }else { ?>
            <a href="admin.php?display=invites" title="Change Display" >
            Display Invites</a>
        <?php } ?>
        </td>
    </tr>
    <tr><td class="blank" colspan="3">&nbsp;</td></tr>
    <tr>
        <td class="button">
            <a href="res/info.php" title="Update Details" class="inline">Update Details</a>
        </td>
        <td class="blank">&nbsp;</td>
        <td class="button">
            <a href="res/stats.php" title="Statistics" class="inline">Stats</a>
        </td>
    </tr>
    <tr><td class="blank" colspan="3">&nbsp;</td></tr>
    <tr>
        <td class="button">
            <a href="http://open.spotify.com/user/1232397745/playlist/3OIcw2VsPKDSKh4femqLRD" title="View Wedding Playlist" target="_blank">View Playlist</a>
        </td>
        <td class="blank" colspan="2">&nbsp;</td>
    </tr>
</table>