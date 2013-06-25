<?php   // index.php (gallery)
function engagement(){
    $x = count(glob('engagement/set*', GLOB_ONLYDIR));
    for($i=1; $i<=$x; $i++){
        $y = fileCount('engagement/set'.$i.'/');
        for($j=1; $j<=$y; $j++){
            echo '<li>
                <h3>Engagement Set '.$i.' - Image '.$j.'</h3>
                <span>engagement/set'.$i.'/0'.$j.'.png</span>
                <p>&nbsp;</p>
                <img src="engagement/thumbnails/set'.$i.'/0'.$j.'.png" alt="Engagement Set '.$i.' - Image '.$j.'" />
            </li>';
        }
    }
}

function other_events($dir, $title){
    $files = scandir($dir);
    $i = 1;
    foreach($files as $file){
        if(in_array(substr($file, -4), array('.jpg', '.png', 'jpeg', '.JPG', '.PNG', 'JPEG'))){
            echo '<li>
                <h3>'.$title.' - Image '.$i.'</h3>
                <span>'.$dir.$file.'</span>
                <p>&nbsp;</p>
                <img src="'.$dir.'thumbnails/'.$file.'" alt="'.$title.' - Image '.$i.'" />
            </li>';
            $i++;
        }
    }
}

function fileCount($dir){
    return count(glob($dir . "*.{jpg,png,jpeg,JPG,PNG,JPEG}", GLOB_BRACE));
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once('res/header_details.php');?>
</head>
<body>
<header><?php include_once('res/page_header.php'); ?></header>
<ul id="slideshow"><?php
if(isset($_GET['gallery'])){
    if($_GET['gallery'] == 'engagement' || !in_array($_GET['gallery'], array('engagement', 'wedding_feb', 'wedding_aug', 'usa', 'roi', 'misc'))){
        engagement();
    }elseif($_GET['gallery'] == 'wedding_feb'){
        $dir = (fileCount('wedding/feb/') > 0) ? 'wedding/feb/' : '404/';
        other_events($dir, 'Wedding Ceremony - Feb');
    }elseif($_GET['gallery'] == 'wedding_aug'){
        $dir = (fileCount('wedding/aug/') > 0) ? 'wedding/aug/' : '404/';
        other_events($dir, 'Wedding Ceremony - Aug');
    }elseif($_GET['gallery'] == 'usa'){
        $dir = (fileCount('reception/usa/') > 0) ? 'reception/usa/' : '404/';
        other_events($dir, 'Nebraska Reception');
    }elseif($_GET['gallery'] == 'roi'){
        $dir = (fileCount('reception/ireland/') > 0) ? 'reception/ireland/' : '404/';
        other_events($dir, 'Ireland Reception');
    }elseif($_GET['gallery'] == 'misc'){
        $dir = (fileCount('misc/') > 0) ? 'misc/' : '404/';
        other_events($dir, 'Misc.');
    }
}else{
    engagement();
}?>
</ul>
<div id="wrapper">
    <div id="fullsize">
        <div id="imgprev" class="imgnav" title="Previous Image"></div>
        <div id="imglink"></div>
        <div id="imgnext" class="imgnav" title="Next Image"></div>
        <div id="image"></div>
        <div id="information">
            <h3></h3>
            <p></p>
        </div>
    </div>
    <div id="thumbnails">
        <div id="slideleft" title="Slide Left"></div>
        <div id="slidearea">
            <div id="slider"></div>
        </div>
        <div id="slideright" title="Slide Right"></div>
    </div>
</div>
<script type="text/javascript" src="Slideshow/compressed.js"></script>
<script type="text/javascript">
    $('slideshow').style.display='none';
    $('wrapper').style.display='block';
    var slideshow=new TINY.slideshow("slideshow");
    window.onload=function(){
        slideshow.auto=true;
        slideshow.speed=5;
        slideshow.link="linkhover";
        slideshow.info="information";
        slideshow.thumbs="slider";
        slideshow.left="slideleft";
        slideshow.right="slideright";
        slideshow.scrollSpeed=4;
        slideshow.spacing=5;
        slideshow.active="#fff";
        slideshow.init("slideshow","image","imgprev","imgnext","imglink");
    }
</script>
<p>&nbsp;<br/>&nbsp;</p>
</body>
</html>