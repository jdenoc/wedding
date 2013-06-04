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
$pics = array_merge($pics, glob('gallery/wedding/feb/*.{jpg, png}', GLOB_BRACE));
$pics = array_merge($pics, glob('gallery/wedding/aug/*.{jpg, png}', GLOB_BRACE));
// Nebraska Reception pictures
$pics = array_merge($pics, glob('gallery/reception/usa/*.{jpg, png}', GLOB_BRACE));
// Ireland Reception pictures
$pics = array_merge($pics, glob('gallery/reception/ireland/*.{jpg, png}', GLOB_BRACE));
// Misc pictures
$pics = array_merge($pics, glob('gallery/misc/*.{jpg, png}', GLOB_BRACE));
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include_once "res/header_details.php" ?>

    <script type="text/javascript">
        var pics = Array();
        function getRandNum(){
            return Math.ceil(Math.random()*<?php echo count($pics)-1; ?>);
        }

        function new_img(){
            $('#main_img').removeAttr('src').attr('src', pics[getRandNum()]);
        }

        $(document).ready(function() {
            //Finish loading the entire page before processing any javascript
            <?php foreach($pics as $pic){ echo "pics.push('".$pic."');\r\n"; } ?>
            new_img();
        });
    </script>
</head>
<body>
<div id="container">
    <header>
        <?php include_once "res/page_header.php" ?>
    </header>
    <div id="main" class="text" style="padding: 10px;">
        <div id="main_img_block">
            <img alt="Random image from the whole wedding series" id="main_img" /><br/>
            <input type="button" onclick="new_img()" value=" &#8635; image " class="button"/>
        </div>
        <h3>Welcome</h3>
        <p>It seems that you're interested in our <?php echo (date('Y-m-d e') < '2013-08-20 UTC')? 'upcoming' : ''; ?> wedding , if you have received an invite, click on the RSVP link in the Navigation bar above, or click <a href="rsvp">here</a> to RSVP. You can also select up to <span style="font-family:Tahoma, Geneva, sans-serif;">3</span> songs  to be added to the playlist that will be played at out wedding receptions.</p>
        <p>If you want to see some pictures associated with our engagement, wedding or reception parties, then why not head over to the <a href="gallery">gallery</a> page.</p>
        <p>Want to know where we<?php echo (date('Y-m-d e') < '2013-08-20 UTC')? "'re going to have" : "'ve had"; ?> our celebrations, then head on over to the <a href="details.php">details</a> page.</p>
        <br/><br/>
    </div>
</div>
</body>
</html>