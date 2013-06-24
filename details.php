<?php // details.php (Wedding)
$wedding_date = "2013-08-20 UTC";
require_once('res/connection.php');
$db = new pdo_connection("jdenocco_wedding");

?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once "res/header_details.php" ?>
</head>
<body>
<div id="container">
    <header>
        <?php include_once "res/page_header.php" ?>
    </header>
    <div id="main" style="padding-left: 20px;" class="text">
        <p>Want to know all the places we'll be celebrating our wedding events, then this is the place to be.</p>
<?php
$events = $db->getAllRows("SELECT DISTINCT event FROM info ORDER BY event ASC");
foreach($events as $e){
    echo '<h2>'.stripslashes($e['event']).'</h2>';
    $q = ($detect->isMobile()) ? "SELECT type, IF(mobile_content='', content, mobile_content) AS content FROM info WHERE event=:event ORDER BY type" : "SELECT type, content FROM info WHERE event=:event ORDER BY type";

    $info = $db->getAllRows($q, array('event'=>$e['event']));
    foreach($info as $i){
        echo '
        <h3 style="padding-left: 15px;">'.stripslashes($i['type']).'</h3>
        <p style="padding-left: 25px; padding-bottom:10px" class="detail-entry">
            '.stripslashes($i['content']).'
        </p>
        ';
    }
}?>
</div>
</body>
</html>