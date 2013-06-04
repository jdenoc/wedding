<?php
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
    header("location:../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<body>
    <form action="res/upload_file.php" method="post" enctype="multipart/form-data">
    <table border="0" style="color:#111;font-family: tahoma;">
        <tr>
            <th colspan="4" style="font-size: 32px;text-align: center">Upload Image</th>
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
                <option selected disabled></option>
                <option value="wedding/feb/">Wedding Ceremony 23-Feb-2013</option>
                <option value="wedding/aug/">Wedding Ceremony 20-Aug-2013</option>
                <option value="reception/usa/">Nebraskan Reception</option>
                <option value="reception/ireland/">Irish Reception</option>
                <option value="misc/">Misc</option>
            </select></td>
        </tr><tr>
            <td>&nbsp;</td>
        </tr><tr>
            <td style="text-align: center" colspan="3"><input type="submit" value="Upload" class="button" /></td>
        </tr>
    </table>
    </form>
</body>
</html>