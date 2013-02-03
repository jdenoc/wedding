<?php   // index.php    (Wedding)
$pics = array();

// engagement pictures
$x = count(glob('gallery/engagement/set*', GLOB_ONLYDIR));
for($i=1; $i<=$x; $i++){
    $y = count(glob('gallery/engagement/set'.$i.'/*.{jpg,png}', GLOB_BRACE));
    for($j=1; $j<=$y; $j++){
        $pics[] = 'gallery/engagement/set'.$i.'/0'.$j.'.png';
    }
}

// Wedding Ceremony pictures
$pics = array_merge($pics, glob('gallery/ceremony/*.{jpg, png}', GLOB_BRACE));
// Nebraska Reception pictures
$pics = array_merge($pics, glob('gallery/reception_usa/*.{jpg, png}', GLOB_BRACE));
// Ireland Reception pictures
$pics = array_merge($pics, glob('gallery/reception_ireland/*.{jpg, png}', GLOB_BRACE));

$rand = rand(0, count($pics)-1);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include_once "res/header_details.php" ?>
</head>
<body>
<div id="container">
    <header>
        <?php include_once "res/page_header.php" ?>
    </header>
    <div id="main" class="text" style="padding: 10px;">
        <img src="<?php echo $pics[$rand] ?>" alt="Random image from the whole wedding seriers" style="float: right; padding: 15px;"/>
        <h3>Welcome</h3>
        <p style="padding-left: 5px;">It seems that you're interested in our <?php echo (date('Y-m-d e') < '2013-08-20 UTC')? 'upcoming' : ''; ?> wedding , if you have received an invite, click on the RSVP link in the Navigation bar above, or click <a href="rsvp">here</a> to RSVP. You can also select up to <span style="font-family:Tahoma, Geneva, sans-serif;">3</span> songs  to be added to the playlist that will be played at out wedding receptions.</p>
        <p style="padding-left: 5px;">If you want to see some pictures associated with our engagement, wedding or reception parties, then why not head over to the <a href="gallery">gallery</a> page.</p>
        <p style="padding-left: 5px;">Want to know where we<?php echo (date('Y-m-d e') < '2013-08-20 UTC')? "'re going to have" : "'ve had"; ?> our celebrations, then head on over to the <a href="details.php">details</a> page.</p>
        <br/><br/>
    </div>
</div>
</body>
</html>