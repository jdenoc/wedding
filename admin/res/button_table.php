<?php // button_table.php (ADMIN) ?>
<style>
    .blank{
        width: 20px;
    }
</style>
<table style="float:right;padding-right: 30px;">
    <tr>
<!--        <td class="button" rowspan="3">-->
<!--            <a href="res/print.php" title="Print Invite" class="inline">Print Invite</a>-->
<!--        </td>-->
        <td class="blank">&nbsp;</td>
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
    <tr><td class="blank">&nbsp;</td></tr>
    <tr>
        <td class="blank">&nbsp;</td>
        <td class="button">
            <a href="res/info.php" title="Update Details" class="inline">Update Details</a>
        </td>
        <td class="blank">&nbsp;</td>
        <td class="button">
            <a href="res/stats.php" title="Statistics" class="inline">Stats</a>
        </td>
    </tr>
</table>