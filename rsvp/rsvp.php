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

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><?php include_once "res/header_details.php" ?></head>
<body id="rsvp">
<div id="container">
    <header><?php include_once "res/page_header.php" ?></header>
    <div id="main"><form action="rsvp.php" method="post"><table border="0">
        <tr>
            <td colspan="4" class="text"><?php
                echo "Thank you <strong>".$details['invite_name']."</strong> for using this feature.<br/>Please fill in the following information to complete your RSVP.";
            ?></td>
        </tr><tr style="font-family:Tahoma, Geneva, sans-serif;">
            <td style="text-align: right;width:150px"><label for="attending">Attending</label>&nbsp;&nbsp;</td>
            <td style="width:20px"><input type="radio" name="rsvp" id="attending" value="1" onclick="showRow('num_of_guests');showRow('guest_location')"/></td>
            <td style="text-align: right;width:250px"><label for="not_attending">Not Attending</label>&nbsp;&nbsp;</td>
            <td><input type="radio" name="rsvp" value="0" id="not_attending" onclick="hideStuff('num_of_guests');hideStuff('guest_location')"/></td>
        </tr><tr id="num_of_guests" style="display:none;font-family:Tahoma, Geneva, sans-serif;">
            <td colspan="3" style="text-align: center"><label>
                Number of guests attending:
                <select name="guests"><?php
                  for($i = 0; $i<=$details["invite_number"]; $i++){
                      echo '<option value="'.$i.'" '.(($i == $details["invite_number"])? 'SELECTED' : '').'>'.$i.'</option>';
                  }
                ?></select>
            </label></td>
        </tr><tr id="guest_location" style="display:none;font-family:Tahoma, Geneva, sans-serif;">
            <td>&nbsp;</td>
            <td colspan="2" style="text-align: left">
                Location: <?php echo $db->getValue("SELECT location FROM location WHERE id=:id", array('id'=>$details['location_ID'])) ?>
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
            <td colspan="4" style="text-align: center">
                <span class="button"><a href="#music_form" class="inline" title="Select Music">Select Music</a></span>
            </td>
        </tr><tr>
            <td colspan="4">&nbsp;<hr/>&nbsp;</td>
        </tr>';}?>
        <tr>
            <td colspan="4" style="text-align: center">
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