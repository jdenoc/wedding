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
        if(in_array(substr($file, -4), array('.jpg', '.png'))){
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
    return count(glob($dir . "*.{jpg,png}", GLOB_BRACE));
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include_once('res/header_details.php');?>
</head>
<body>
<header><?php include_once('res/page_header.php'); ?></header>
<div style="float: left; padding-top: 30px;"><ul>
    <li class="gallery_nav"><a href="index.php?gallery=engagement">Engagement Photos (20)</a></li>
    <li class="gallery_nav"><a href="index.php?gallery=ceremony">Wedding Ceremony (<?php echo fileCount('ceremony/');?>)</a></li>
    <li class="gallery_nav"><a href="index.php?gallery=usa">Nebraskan Reception (<?php echo fileCount('reception_usa/');?>)</a></li>
    <li class="gallery_nav"><a href="index.php?gallery=roi">Irish Reception (<?php echo fileCount('reception_ireland/');?>)</a></li>
    <li class="gallery_nav"><a href="index.php?gallery=misc">Misc. (<?php echo fileCount('misc/');?>)</a></li>
</ul></div>
<ul id="slideshow"><?php
if(isset($_GET['gallery'])){
    if($_GET['gallery'] == 'engagement' || !in_array($_GET['gallery'], array('engagement', 'ceremony', 'usa', 'roi', 'misc'))){
        engagement();
    }elseif($_GET['gallery'] == 'ceremony'){
        $dir = (fileCount('ceremony/') > 0) ? 'ceremony/' : '404/';
        other_events($dir, 'Wedding Ceremony');
    }elseif($_GET['gallery'] == 'usa'){
        $dir = (fileCount('reception_usa/') > 0) ? 'reception_usa/' : '404/';
        other_events($dir, 'Nebraska Reception');
    }elseif($_GET['gallery'] == 'roi'){
        $dir = (fileCount('reception_ireland/') > 0) ? 'reception_ireland/' : '404/';
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
<p>&nbsp;<br/>&nbsp;</p>
<p>&nbsp;<br/>&nbsp;</p>
</body>
</html>