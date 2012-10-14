<?php // locations.php (Wedding)
$wedding_date = "2013-08-20 UTC";

$ceremony_address = (date('Y-m-d e') < $wedding_date)?
    "Sorry, but you won't get to know this information till the day of the wedding itself.<br/>(Note It'll be in August.)" :
    "Apple Blossom Chapel and Gardens,<br/>2337 63rd Street,<br/>Fennville<br/>MI 49408";
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
        <h3>Ceremony</h3>
        <p style="padding-left: 10px;"><?php echo $ceremony_address; ?></p>
        <h3>Reception - Nebraska</h3>
        <p style="padding-left: 10px;">We haven't decided yet where we're going to have our Nebraska reception. Stay tuned to this spot for further information.<br/>(Note: It'll be in August.)</p>
        <h3>Reception - Ireland</h3>
        <p style="padding-left: 10px;">We haven't decided yet where we're going to have our Ireland reception. Stay tuned to this spot for further information.<br/>(Note: It'll be in August.)</p>
        <p></p>
    </div>
    <div id="foot">
        <?php include_once "res/page_footer.php" ?>
    </div>
</div>
</body>
<html>