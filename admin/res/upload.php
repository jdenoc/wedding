<?php
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
    header("location:../index.php");
    exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<body>
    <form action="res/upload_file.php" method="post" enctype="multipart/form-data">
    <table border="0" style="color:#111;font-family: tahoma;">
        <tr>
            <th colspan="4" align="center" style="font-size: 32px;">Upload Image</th>
        </tr>
        <tr>
            <td colspan="4"><div class="sexy_line"></div></td>
        </tr>
        <tr>
            <td><label for="file">Choose an image to upload:</label></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><input type="file" name="file" id="file" class="button" /></td>
        </tr>
        <tr>
            <td><label for="folder">Where would like to upload the image</label></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><select name="folder" id="folder">
                <option value="ceremony/">Wedding Ceremony</option>
                <option value="reception_usa/">Nebraskan Reception</option>
                <option value="reception_ireland/">Irish Reception</option>
                <option value="misc/">Misc</option>
            </select></td>
        </tr><tr>
            <td>&nbsp;</td>
        </tr><tr>
            <td align="center" colspan="3"><input type="submit" value="Upload" class="button" /></td>
        </tr>
    </table>
    </form>
</body>
</html>