<?php
/**
 * Created by: denis
 * Created on: 2013-06-15
 *
 * Error page that will be displayed for 400 and 500 errors
 */

$error = (isset($_GET['type'])) ? str_replace('+', ' ', $_GET['type']) : 'OOPS!';
$msg = 'Error type: '.$error."\r\n";
$msg .= "URI Accessed: ".$_SERVER['REQUEST_URI']."\r\n";
$msg .= "Error originated at IP: ".$_SERVER['REMOTE_ADDR']."\r\n";
mail('wedding@jdenoc.com', 'ERROR', $msg);


$root = realpath($_SERVER["DOCUMENT_ROOT"]).'/';
$pics = array();

// engagement pictures
$x = count(glob($root.'gallery/engagement/set*', GLOB_ONLYDIR));
for($i=1; $i<=$x; $i++){
    $y = count(glob($root.'gallery/engagement/set'.$i.'/*.{jpg,png}', GLOB_BRACE));
    for($j=1; $j<=$y; $j++){
        $pics[] = $root.'gallery/engagement/set'.$i.'/0'.$j.'.png';
    }
}

// Wedding Ceremony pictures
$pics = array_merge($pics, glob($root.'gallery/wedding/feb/*.{jpg, png}', GLOB_BRACE));
$pics = array_merge($pics, glob($root.'gallery/wedding/aug/*.{jpg, png}', GLOB_BRACE));
// Nebraska Reception pictures
$pics = array_merge($pics, glob($root.'gallery/reception/usa/*.{jpg, png}', GLOB_BRACE));
// Ireland Reception pictures
$pics = array_merge($pics, glob($root.'gallery/reception/ireland/*.{jpg, png}', GLOB_BRACE));
// Misc pictures
$pics = array_merge($pics, glob($root.'gallery/misc/*.{jpg, png}', GLOB_BRACE));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Denis & Britain's Wedding Reception</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo 'http://'.$_SERVER["HTTP_HOST"].'/imgs/favicon.ico'; ?>" type="image/x-icon"/>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Merienda+One' type='text/css'/>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Handlee' type='text/css'>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>

    <!-- Compatibility for IE 7, 8, 9 -->
    <!--[if IE]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script type="text/javascript">
        var pics = Array();
        function getRandNum(){
            // Generates a random number
            return Math.ceil(Math.random()*<?php echo count($pics)-1; ?>);
        }

        function new_img(){
            $('#main_img').fadeOut("slow", function(){
                console.log('Done fading out');
                $(this).removeAttr('src').attr('src', pics[getRandNum()]);
                console.log('img changed');
                $(this).fadeIn("slow");
            });
            setTimeout(new_img, 3000);
        }


        $(document).ready(function() {
            //Finish loading the entire page before processing any javascript here
            <?php foreach($pics as $pic){
                $pic = str_replace($root, 'http://'.$_SERVER['HTTP_HOST'].'/', $pic);
                echo "pics.push('".$pic."');\r\n";
            } ?>
            $('#main_img').attr('src', pics[getRandNum()]).fadeIn("slow");
            setTimeout(new_img, 5000);
        });
    </script>

    <style>
        #main{
            font-family: 'Merienda One', cursive;
            font-size: 14px;
            width: 510px;
            text-align: center;
            margin: auto;
            padding-top: 50px;
        }
        body{
            background: #222;
            color: #e9e9e9;
        }
        #main a:link,
        #main a:visited,
        #main a:hover{
            color: #3299bb;
        }
    </style>
</head>
<body>
<div id="container">
    <div id="main">
        <h1><?php echo $error; ?></h1>
        <p>It seems that you've encountered a problem.</p>
        <p>Click <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/index.php'; ?>">here</a> to return to the Home.</p>
        <p>In the mean time, enjoy this nice picture from the wedding event.</p>
        <br/><br/>
        <div id="main_img_block">
            <img alt="Random image from the whole wedding series" id="main_img" /><br/>
        </div>
    </div>
</div>
</body>
</html>