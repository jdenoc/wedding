<?php // details.php (Wedding)
$wedding_date = "2013-08-20 UTC";
require_once('res/connection.php');
$db = new pdo_connection("jdenocco_wedding");


$ceremony_address = "Sorry, but you won't get to know this information till the day of the wedding itself.<br/>(Note It'll be in August.)";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include_once "res/header_details.php" ?>
</head>
<body>
<div id="container">
    <div id="head">
        <?php include_once "res/page_header.php" ?>
    </div>
    <div id="main" style="padding-left: 20px;" class="text">
        <p>Want to know all the places we'll be celebrating our wedding events, then this is the place to be.</p>
<?php
$events = $db->getAllRows("SELECT DISTINCT event FROM info");
foreach($events as $e){
    echo '<h2>'.$e['event'].'</h2>';
    $info = $db->getAllRows("SELECT `type`, `text` FROM `info` WHERE `event`=:event ORDER BY `type`",
        array('event'=>$e['event']));
    foreach($info as $i){
        echo '
        <h3 style="padding-left: 15px;">'.$i['type'].'</h3>
        <p style="padding-left: 25px; padding-bottom:10px" class="detail-entry">
            '.(($e['event']=='Ceremony' && date('Y-m-d e') < $wedding_date)? $ceremony_address : $i['text']).'
        </p>
        ';
    }
}?>
<!--//        <h3 style="padding-left: 5px;">Location</h3>-->
<!--//        <p style="padding-left: 10px;"></p>-->
<!--//        <h3 style="padding-left: 5px;">Florist</h3>-->

<!--//        <h3 style="padding-left: 5px;">Location</h3>-->
<!--//        <p style="padding-left: 10px;"></p>-->
<!--//        <h3 style="padding-left: 5px;">Florist</h3>-->
<!--//        <p style="padding-left: 10px;">&nbsp;</p>-->
</div>
</body>
</html>