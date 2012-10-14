<?php	// rsvp.php (rsvp)
session_name('rsvp');
session_start();
if(!isset($_SESSION['invite_ID'])){
    header('location:index.php');
    exit;
}

require_once("../res/connection.php");
$db = new pdo_connection("jdenocco_wedding");
$invite_ID = $_SESSION['invite_ID'];
$details = $db->getRow("SELECT * FROM details WHERE id=:id", array('id'=>$invite_ID));

if(isset($_POST['rsvp_submit'])){
    if(isset($_POST['rsvp'])){
        if($_POST['rsvp'] == 0){
            $db->update('details', array('coming'=>0, 'location_ID'=>-1, 'guest_number'=>0), array('id'=>$invite_ID));
        }elseif($_POST['rsvp'] == 1){
            $no_of_guests = (isset($_POST['guests']) && $_POST['guests'] > 0)? $_POST['guests'] : 1;
            $loc = (in_array($_POST['location'], array(0,1,2)))? $_POST['location'] : 0;
            $db->update('details', array('coming'=>1,
                'guest_number'=>$no_of_guests,
                'location_ID'=>$loc),
                array('id'=>$invite_ID)
            );
        }
        header("Location: complete.php");
        exit;
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><?php include_once "res/header_details.php" ?></head>
<body id="rsvp">
<div id="container">
    <div id="head"><?php include_once "res/page_header.php" ?></div>
    <div id="main"><form action="rsvp.php" method="post"><table border="0">
        <tr>
            <td colspan="4" class="text"><?php
                echo "Thank you <strong>".$details['invite_name']."</strong> for using this feature.<br/>Please fill in the following information to complete your RSVP.";
            ?></td>
        </tr><tr style="font-family:Tahoma, Geneva, sans-serif;">
            <td align="right" width="150px">Attending&nbsp;&nbsp;</td>
            <td width="20px"><input type="radio" name="rsvp" value="1" onclick="showRow('num_of_guests');showRow('guest_location')"/></td>
            <td align="right" width="250px">Not Attending&nbsp;&nbsp;</td>
            <td><input type="radio" name="rsvp" value="0" onclick="hideStuff('num_of_guests');hideStuff('guest_location')"/></td>
        </tr><tr id="num_of_guests" style="display:none;font-family:Tahoma, Geneva, sans-serif;">
            <td colspan="3" align="center">
                Number of guests attending:
                <input type="text" name="guests" value="<?php echo $details["guest_number"]; ?>" maxlength="1" size="3" />
            </td>
        </tr><tr id="guest_location" style="display:none;font-family:Tahoma, Geneva, sans-serif;">
            <td>&nbsp;</td>
            <td colspan="2" align="left">
                Location:
                <select name="location"><?php
                    $location = $db->getAllRows("SELECT * FROM location");
                    foreach($location as $item){
                        echo '<option value="'.$item['id'].'">'.$item['location'].'</option>';
                    }
                ?></select>
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;<hr/>&nbsp;</td>
        </tr>
        <?php if($details['musicSet']==0){
            echo '
        <tr>
            <td colspan="4" class="text">
                We are building a playlist of music to celebrate our wedding.<br/>
                What would you like to hear? Let us know and we\'ll put it on the play list.<br/>
                (Note: If we don\'t like the song, then we won\'t be playing it!).<br/>
            </td>
        </tr><tr>
            <td colspan="4" align="center">
                <span class="button"><a href="#music_form" class="inline" title="Select Music">Select Music</a></span>
            </td>
        </tr><tr>
            <td colspan="4">&nbsp;<hr/>&nbsp;</td>
        </tr>';}?>
        <tr>
            <td colspan="4" align="center">
                <input type="submit" class="button" name="rsvp_submit" />
                <span class="button"><a href="res/cancel.php">Cancel</a></span>
            </td>
        </tr>
    </table></form></div>
    <div id="foot">
        <div style="display:none">
        <?php if($details['musicSet']==0){
            include_once "res/music_form.php";
        }?>
        </div>
    </div>
</div>
</body>
</html>